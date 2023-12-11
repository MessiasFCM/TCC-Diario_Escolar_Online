<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $InicioEtapa = $_POST["txtinicioEtapa"];
    $FinalEtapa = $_POST["txtfinalEtapa"];
    $NomeEtapa = $_POST["txtnomeEtapa"];
    $AnoEtapa = $_POST["txtanoEtapa"];
    $InstituicaoEtapa_IdInstituicao = $_SESSION['usuarioId'];

    //criar o comando sql do insert
    $sql = "INSERT INTO `deo`.`Etapa` (`InicioEtapa`, `FinalEtapa`, `NomeEtapa`, `AnoEtapa`, `InstituicaoEtapa_IdInstituicao`)
    VALUES ('$InicioEtapa', '$FinalEtapa', '$NomeEtapa', '$AnoEtapa', '$InstituicaoEtapa_IdInstituicao')";


    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        $_SESSION['registradoInseridoComSucesso'] = "Sucesso";
        ?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaEtapa.php";
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