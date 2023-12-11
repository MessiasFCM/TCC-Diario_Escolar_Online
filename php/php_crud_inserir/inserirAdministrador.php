<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $NomeAdministrador = $_POST["txtnomeAdministrador"];
    $EmailAdministrador = $_POST["txtemailAdministrador"];
    $SenhaAdministrador = $_POST["txtsenhaAdministrador"];

    $criptografada = md5($SenhaAdministrador);

    //criar o comando sql do insert
    $sql = "INSERT INTO `deo`.`Administrador` (`NomeAdministrador`, `EmailAdministrador`, `SenhaAdministrador`)
    VALUES ('$NomeAdministrador', '$EmailAdministrador', '$criptografada')";

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