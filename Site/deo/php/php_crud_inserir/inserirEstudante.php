<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $NomeEstudante = $_POST["txtnomeCompleto"];
    $EmailEstudante = $_POST["txtemailEstudante"];
    $SenhaEstudante = $_POST["txtsenhaEstudante"];
    $AnoLetivoEstudante = $_POST["txtanoLetivoEstudante"];
    $IdadeEscolarEstudante = $_POST["opIdadeEscolarEstudante"];
    $VerificacaoEstudante = $AnoLetivoEstudante . " - ". $IdadeEscolarEstudante ." - ". "Em andamento" . " - ";
    if (isset ($_POST["txttelefoneEstudante"])){
        $TelefoneEstudante = $_POST["txttelefoneEstudante"];
    }else{
        $TelefoneEstudante = "";
    }

    if (isset ($_POST["idInstituicaoSelect"])){
        $InstituicaoEstudante_IdInstituicao = $_POST["idInstituicaoSelect"];
    }else{
        $InstituicaoEstudante_IdInstituicao = $_SESSION['usuarioId'];
    }


    $criptografada = md5($SenhaEstudante);

    //criar o comando sql do insert
    $sql = "INSERT INTO `deo`.`Estudante` (`NomeEstudante`, `EmailEstudante`, `SenhaEstudante`, `AnoLetivoEstudante`, `IdadeEscolarEstudante`, `InstituicaoEstudante_IdInstituicao`, `VerificacaoEstudante`, `TelefoneEstudante`) 
    VALUES ('$NomeEstudante', '$EmailEstudante' , '$criptografada', '$AnoLetivoEstudante', '$IdadeEscolarEstudante', '$InstituicaoEstudante_IdInstituicao', '$VerificacaoEstudante',  '$TelefoneEstudante')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        $_SESSION['registradoInseridoComSucesso'] = "Sucesso";
        ?>
        <script>
            window.history.back(); 
        </script>

        <?php
    }
    else{
        $_SESSION['erroInserir'] = "Erro";
        ?>
        <script>
            window.history.back(); 
        </script>
        
        <?php
    }

?>