<?php
include_once("../conexao.php");
session_start();

if (isset ($_GET["Estudante_RegistroAcademico"], $_GET["Materia_idMateria"], $_GET["AnoLetivo_EstudanteHasMateria"])) {
    $Estudante_RegistroAcademico = $_GET["Estudante_RegistroAcademico"];
    $Materia_idMateria = $_GET["Materia_idMateria"];
    $AnoLetivo_EstudanteHasMateria = $_GET["AnoLetivo_EstudanteHasMateria"];

    $sql = "DELETE FROM Estudante_has_Materia WHERE Estudante_RegistroAcademico = $Estudante_RegistroAcademico AND Materia_idMateria = $Materia_idMateria AND AnoLetivo_EstudanteHasMateria = $AnoLetivo_EstudanteHasMateria";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoDeletadoComSucesso'] = "Sucesso";
?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaEstudanteMateria.php?RegistroAcademico=<?php echo $Estudante_RegistroAcademico ?>";
        </script>

    <?php

    } else {
        $_SESSION['erroDeletar'] = "Erro";
    ?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaEstudanteMateria.php?RegistroAcademico=<?php echo $Estudante_RegistroAcademico ?>";
        </script>
<?php

    }
}

?>