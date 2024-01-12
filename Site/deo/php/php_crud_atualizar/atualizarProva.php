<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    if (isset($_GET["Etapa_idEtapa"]) && isset($_GET["Materia_idMateria"]) && isset($_GET["idProva"])) {
        $idProva = $_GET ["idProva"];
        $NomeProva = $_POST["txtnomeProva2"];
        $ValorProva = $_POST["txtvalorProva2"];
        $DataProva = $_POST["txtdataProva2"];

        $idEtapa = $_GET["Etapa_idEtapa"];
        $idMateria =  $_GET["Materia_idMateria"];

        $sql = "UPDATE Prova
                SET NomeProva = '$NomeProva', 
                ValorProva = '$ValorProva',
                DataProva = '$DataProva'
                WHERE idProva = $idProva";

        if ($conn->query($sql) === TRUE) {
            $_SESSION['registradoAtualizadoComSucesso'] = "Sucesso";
            ?>
            <script>
                window.location = "../../tela/tela_professor/gerenciaProvasEscolhidas.php?Etapa_idEtapa=<?php echo $idEtapa ?>&Materia_idMateria=<?php echo $idMateria?>";
            </script>
            <?php
        }
        else{
            $_SESSION['erroAtualizar'] = "Erro";
            ?>
            <script>
                window.location = "../../tela/tela_professor/gerenciaProvasEscolhidas.php?Etapa_idEtapa=<?php echo $idEtapa ?>&Materia_idMateria=<?php echo $idMateria?>";
            </script>
            <?php
        }
    }
?>