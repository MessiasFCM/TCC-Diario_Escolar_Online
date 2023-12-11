<?php
    //Incluindo arquivo de conexão com o banco de dados
    session_start();
    include_once("../conexao.php");
    

    $idAdministrador = $_GET["idAdministrador"];
    $NomeAdministrador = $_POST["txtnomeAdministrador2"];
    $EmailAdministrador = $_POST["txtemailAdministrador2"];
    $SenhaAdministrador = $_POST["txtsenhaAdministrador2"];

    if ($SenhaAdministrador != ""){
        $criptografada = md5($SenhaAdministrador);
    }else{
        $sqlBuscarSenha = "SELECT SenhaAdministrador
        FROM Administrador
        WHERE idAdministrador = $idAdministrador";
        $buscarSenha = $conn->query($sqlBuscarSenha);
        $exibirBuscarSenha = $buscarSenha->fetch_assoc();
        $criptografada = $exibirBuscarSenha["SenhaAdministrador"];
    }

    $sql = "UPDATE Administrador
            SET NomeAdministrador = '$NomeAdministrador', 
            EmailAdministrador = '$EmailAdministrador', 
            SenhaAdministrador = '$criptografada' 
            WHERE idAdministrador = $idAdministrador";

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