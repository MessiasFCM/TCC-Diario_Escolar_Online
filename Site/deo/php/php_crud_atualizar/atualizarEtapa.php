<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    $idEtapa = $_GET ["idEtapa"];
    $InicioEtapa = $_POST["txtinicioEtapa2"];
    $FinalEtapa = $_POST["txtfinalEtapa2"];
    $NomeEtapa = $_POST["txtnomeEtapa2"];
    $AnoEtapa = $_POST["txtanoEtapa2"];

    $sql = "UPDATE Etapa
            SET InicioEtapa = '$InicioEtapa', 
            FinalEtapa = '$FinalEtapa',
            NomeEtapa = '$NomeEtapa',
            AnoEtapa = '$AnoEtapa'
            WHERE idEtapa = $idEtapa";

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