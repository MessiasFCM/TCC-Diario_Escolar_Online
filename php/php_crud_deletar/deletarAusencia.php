<?php
include_once("../conexao.php");
session_start();

if (isset($_GET["idAusencia"])) {
    $idAusencia = $_GET["idAusencia"];
    $Etapa_idEtapa = $_GET["Etapa_idEtapa"];
    $Materias_idMateria = $_GET["Materias_idMateria"];
    $DataAusencia = $_GET["DataAusencia"];


    $sql = "DELETE FROM Ausencia WHERE idAusencia = $idAusencia";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoDeletadoComSucesso'] = "Sucesso";
?>
        <script>
            window.location = "../../tela/tela_professor/gerenciaAusenciaEstudante.php?idEtapa=<?php echo $Etapa_idEtapa ?>&idMateria=<?php echo $Materias_idMateria ?>&data=<?php echo $DataAusencia ?>";
        </script>

    <?php

    } else {
        $_SESSION['erroDeletar'] = "Erro";
    ?>
        <script>
            window.location = "../../tela/tela_professor/gerenciaAusenciaEstudante.php?idEtapa=<?php echo $Etapa_idEtapa ?>&idMateria=<?php echo $Materias_idMateria ?>&data=<?php echo $DataAusencia ?>";
        </script>
<?php

    }
}

?>