<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    $idNota = $_POST ["txtIdNota"];
    $ValorObtido = $_POST["txtValorObtido"];

    $sql = "UPDATE Nota
            SET ValorObtido = '$ValorObtido'
            WHERE idNota = $idNota";

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