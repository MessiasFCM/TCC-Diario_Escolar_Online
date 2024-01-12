<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    $idAusencia = $_GET ["idAusencia"];
    $DataAusencia = $_POST ["txtdataAusencia2"];
    

    $sql = "UPDATE Ausencia
            SET DataAusencia = '$Data' 
            WHERE idAusencia = $idAusencia";

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