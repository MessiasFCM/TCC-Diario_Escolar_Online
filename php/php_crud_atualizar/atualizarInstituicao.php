<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    if (isset($_GET["InstituicaoAprovada"])) {
        $InstituicaoAprovada = $_GET["InstituicaoAprovada"];
        $IdInstituicao = $_GET ["IdInstituicao"];

        $sql = "UPDATE Instituicao
                SET InstituicaoAprovada = '$InstituicaoAprovada'
                WHERE IdInstituicao = $IdInstituicao";
    }elseif(isset($_POST["txtsenhaInstituicao2"]) && isset($_POST["txtrepetirsenhaInstituicao2"])){
        $SenhaInstituicao = $_POST["txtsenhaInstituicao2"];
        $SenhaInstituicaoRepetir = $_POST["txtrepetirsenhaInstituicao2"];
        $IdInstituicao = $_GET ["IdInstituicao"];

        if ($SenhaInstituicao != "" && $SenhaInstituicaoRepetir != ""){
            if($SenhaInstituicao == $SenhaInstituicaoRepetir){
                $criptografada = md5($SenhaInstituicao);
                $sql = "UPDATE Instituicao
                SET SenhaInstituicao = '$criptografada'
                WHERE IdInstituicao = $IdInstituicao";
            }else{
                $_SESSION['erroAtualizar'] = "Erro";
                ?>
                <script>
                window.history.back();
                </script>
                <?php
            }
        }else{
            $sqlBuscarSenha = "SELECT SenhaInstituicao
            FROM Instituicao
            WHERE IdInstituicao = $IdInstituicao";
            $buscarSenha = $conn->query($sqlBuscarSenha);
            $exibirBuscarSenha = $buscarSenha->fetch_assoc();
            $criptografada = $exibirBuscarSenha["SenhaInstituicao"];
        }

        $sql = "UPDATE Instituicao
            SET SenhaInstituicao = '$criptografada'
            WHERE IdInstituicao = $IdInstituicao";
    }else{
        $IdInstituicao = $_GET ["IdInstituicao"];
        $CNPJInstituicao = $_POST["txtCNPJdaInstituicao2"];
        $NomeInstituicao = $_POST["txtnomeInstituicao2"];
        $EmailInstituicao = $_POST["txtemailInstituicao2"];
        $ContatoInstituicao = $_POST["txtcontatoInstituicao2"];
        $Bairro = $_POST["txtbairroInstituicao2"];
        $Rua = $_POST["txtruaInstituicao2"];
        $Estado = $_POST["txtestadoInstituicao2"];
        $Cidade = $_POST["txtcidadeInstituicao2"];
        $NumeroResidencial = $_POST["txtnumeroInstituicao2"];
        $CEP = $_POST["txtCEPdaInstituicao2"];

        $sql = "UPDATE Instituicao
            SET CNPJInstituicao = '$CNPJInstituicao', 
            NomeInstituicao = '$NomeInstituicao',
            EmailInstituicao = '$EmailInstituicao',
            ContatoInstituicao = '$ContatoInstituicao',
            Bairro = '$Bairro',
            Rua = '$Rua',
            Estado = '$Estado',
            Cidade = '$Cidade',
            NumeroResidencial = '$NumeroResidencial',
            CEP = '$CEP'
            WHERE IdInstituicao = $IdInstituicao";
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