<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    $RegistroAcademico = $_GET ["RegistroAcademico"];

    if(isset($_GET["anoEscolar"]) && isset($_GET["idadeEscolar"]) && isset($_GET["situacaoEscolar"])){
        $anoEscolar = $_GET["anoEscolar"];
        $idadeEscolar = $_GET["idadeEscolar"];
        $situacaoEscolar = $_GET["situacaoEscolar"];

        $sqlEstudante = "SELECT *
        FROM Estudante
        WHERE RegistroAcademico = $RegistroAcademico";
        $Estudante = $conn->query($sqlEstudante);
        $exibirEstudante = $Estudante->fetch_assoc();

        $string = null;
        $array = null;
        $string = $exibirEstudante["VerificacaoEstudante"];
        $array = explode(' - ', $string);

        $total = 0;
        $VerificacaoEstudante = "";
        for($cont = 0; $cont < sizeof($array) - 1; $cont++){
            if($array[$cont] == $anoEscolar){
                $total=1;
                //echo $array[$cont] . "checagem 1 - ";
            }elseif($total==1){
                if($array[$cont] == $idadeEscolar){
                    $total=2;
                    //echo $array[$cont] . "checagem 2 - ";
                }else{
                    $total=0;
                    //echo $array[$cont] . "checagem 0 - ";
                }
            }elseif($total==2){
                $array[$cont] = $situacaoEscolar;
                $total=0;
                //echo $array[$cont] . "checagem certa - ";
            }
            if( $array[$cont] == ""){

            }else{
                $VerificacaoEstudante = $VerificacaoEstudante . $array[$cont] . " - ";
            }
        }
        if($idadeEscolar == "1 fundamental"){
            $idadeEscolarAdicional = "2 fundamental";
        }elseif($idadeEscolar == "2 fundamental"){
            $idadeEscolarAdicional = "3 fundamental";
        }elseif($idadeEscolar == "3 fundamental"){
            $idadeEscolarAdicional = "4 fundamental";
        }elseif($idadeEscolar == "4 fundamental"){
            $idadeEscolarAdicional = "5 fundamental";
        }elseif($idadeEscolar == "5 fundamental"){
            $idadeEscolarAdicional = "6 fundamental";
        }elseif($idadeEscolar == "6 fundamental"){
            $idadeEscolarAdicional = "7 fundamental";
        }elseif($idadeEscolar == "7 fundamental"){
            $idadeEscolarAdicional = "8 fundamental";
        }elseif($idadeEscolar == "8 fundamental"){
            $idadeEscolarAdicional = "9 fundamental";
        }elseif($idadeEscolar == "9 fundamental"){
            $idadeEscolarAdicional = "1 médio";
        }elseif($idadeEscolar == "1 médio"){
            $idadeEscolarAdicional = "2 médio";
        }elseif($idadeEscolar == "2 médio"){
            $idadeEscolarAdicional = "3 médio";
        }elseif($idadeEscolar == "3 médio"){
            $idadeEscolarAdicional = "Formado";
        }
        $anoEscolarAdicional = $anoEscolar+1;
        if($situacaoEscolar == "Reprovado"){
            $VerificacaoEstudante = $VerificacaoEstudante . $anoEscolarAdicional . " - " . $idadeEscolar . " - " . "Em andamento" . " - ";
            
            $sql21 = "UPDATE Estudante
            SET AnoLetivoEstudante = '$anoEscolarAdicional',
            IdadeEscolarEstudante = '$idadeEscolar'
            WHERE RegistroAcademico = $RegistroAcademico";
            $conn->query($sql21);
        }elseif($situacaoEscolar == "Aprovado"){
            if($idadeEscolarAdicional == "Formado"){
                $VerificacaoEstudante = $VerificacaoEstudante;
            }else{
                $VerificacaoEstudante = $VerificacaoEstudante . $anoEscolarAdicional . " - " . $idadeEscolarAdicional . " - " . "Em andamento" . " - ";
                
                $sql22 = "UPDATE Estudante
                SET AnoLetivoEstudante = '$anoEscolarAdicional',
                IdadeEscolarEstudante = '$idadeEscolarAdicional'
                WHERE RegistroAcademico = $RegistroAcademico";
                $conn->query($sql22);
            }
        }
        
        $sql = "UPDATE Estudante
        SET VerificacaoEstudante = '$VerificacaoEstudante'
        WHERE RegistroAcademico = $RegistroAcademico";

    }elseif(isset($_POST["txtsenhaEstudante2"]) && isset($_POST["txtrepetirsenhaEstudante2"])){
        $SenhaEstudante = $_POST ["txtsenhaEstudante2"];
        $SenhaEstudanteRepetir = $_POST ["txtrepetirsenhaEstudante2"];
        if(isset($_POST["txtnomeCompleto2"]) && isset($_POST["txtemailEstudante2"]) && isset($_POST["txtanoLetivoEstudante2"]) && isset($_POST["opIdadeEscolarEstudante2"])){
            $NomeEstudante = $_POST ["txtnomeCompleto2"];
            $EmailEstudante = $_POST ["txtemailEstudante2"];
            $AnoLetivoEstudante = $_POST["txtanoLetivoEstudante2"];
            $IdadeEscolarEstudante = $_POST["opIdadeEscolarEstudante2"];

            if ($SenhaEstudante != ""){
                $criptografada = md5($SenhaEstudante);
            }else{
                $sqlBuscarSenha = "SELECT SenhaEstudante
                FROM Estudante
                WHERE RegistroAcademico = $RegistroAcademico";
                $buscarSenha = $conn->query($sqlBuscarSenha);
                $exibirBuscarSenha = $buscarSenha->fetch_assoc();
                $criptografada = $exibirBuscarSenha["SenhaEstudante"];
            }
            
            $sql = "UPDATE Estudante
            SET NomeEstudante = '$NomeEstudante', 
            EmailEstudante = '$EmailEstudante',
            SenhaEstudante = '$criptografada',
            AnoLetivoEstudante = '$AnoLetivoEstudante',
            IdadeEscolarEstudante = '$IdadeEscolarEstudante'
            WHERE RegistroAcademico = $RegistroAcademico";

        }elseif ($SenhaEstudante != "" && $SenhaEstudanteRepetir != "" ){
            if($SenhaEstudante == $SenhaEstudanteRepetir){
                $criptografada = md5($SenhaEstudante);
                $sql = "UPDATE Estudante
                SET SenhaEstudante = '$criptografada'
                WHERE RegistroAcademico = $RegistroAcademico";
            }else{
                $_SESSION['erroAtualizar'] = "Erro";
                ?>
                <script>
                window.history.back();
                </script>
                <?php
            }
        }else{
            $_SESSION['erroAtualizar'] = "Erro";
            ?>
            <script>
            window.history.back();
            </script>
            <?php
        }

    }else{
        $NomeEstudante = $_POST ["txtnomeCompleto2"];
        $EmailEstudante = $_POST ["txtemailEstudante2"];

        $sqlBuscarSenha = "SELECT *
        FROM Estudante
        WHERE RegistroAcademico = $RegistroAcademico";
        $buscarSenha = $conn->query($sqlBuscarSenha);
        $exibirBuscarSenha = $buscarSenha->fetch_assoc();
        $criptografada = $exibirBuscarSenha["SenhaEstudante"];

        if(isset($_POST["txtanoLetivoEstudante2"])){
            $AnoLetivoEstudante = $_POST["txtanoLetivoEstudante2"];
        }else{
            $AnoLetivoEstudante = $exibirBuscarSenha["AnoLetivoEstudante"];
        }
        if(isset($_POST["opIdadeEscolarEstudante2"])){
            $IdadeEscolarEstudante = $_POST["opIdadeEscolarEstudante2"];
        }else{
            $IdadeEscolarEstudante = $exibirBuscarSenha["IdadeEscolarEstudante"];
        }
        if(isset($_POST["txttelefoneEstudante2"])){
            $TelefoneEstudante = $_POST["txttelefoneEstudante2"];
        }else{
            $TelefoneEstudante = $exibirBuscarSenha["TelefoneEstudante"];
        }

        $sql = "UPDATE Estudante
        SET NomeEstudante = '$NomeEstudante', 
        EmailEstudante = '$EmailEstudante',
        SenhaEstudante = '$criptografada',
        AnoLetivoEstudante = '$AnoLetivoEstudante',
        IdadeEscolarEstudante = '$IdadeEscolarEstudante',
        TelefoneEstudante = '$TelefoneEstudante'
        WHERE RegistroAcademico = $RegistroAcademico";
    }

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoAtualizadoComSucesso'] = "Sucesso";
        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }
    else{
        $_SESSION['erroAtualizar'] = "Erro";
        ?>
        <script>
           window.history.back();
        </script>
        <?php
    }
    
?>