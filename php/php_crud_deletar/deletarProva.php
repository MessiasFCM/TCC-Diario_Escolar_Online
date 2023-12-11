<?php
include_once("../conexao.php");
session_start();

if (isset($_GET["idProva"])) {
    $idProva = $_GET["idProva"];

    $sql = "SELECT * 
    FROM Prova 
    WHERE idProva = $idProva";
    $Prova = $conn->query($sql);
    $exibirProva = $Prova->fetch_assoc();

    $idEtapa = $exibirProva["Etapa_idEtapa"];
    $idMateria =  $exibirProva["Materia_idMateria"];

    $sqlNota = "SELECT * FROM Nota WHERE Provas_idProvas = $idProva";
    $Nota = $conn->query($sqlNota);
    $exibirNota = $Nota->fetch_assoc();

    if (isset($exibirNota)){
        $sqlRemover = "DELETE FROM Nota WHERE Provas_idProvas = $idProva"; 
        $conn->query($sqlRemover);
    }

    $sql = "DELETE FROM Prova WHERE idProva = $idProva";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoDeletadoComSucesso'] = "Sucesso";
?>
        <script>
            window.location = "../../tela/tela_professor/gerenciaProvasEscolhidas.php?Etapa_idEtapa=<?php echo $idEtapa ?>&Materia_idMateria=<?php echo $idMateria?>";
        </script>

    <?php

    } else {
        $_SESSION['erroDeletar'] = "Erro";
    ?>
        <script>
            window.location = "../../tela/tela_professor/gerenciaProvasEscolhidas.php?Etapa_idEtapa=<?php echo $idEtapa ?>&Materia_idMateria=<?php echo $idMateria?>";
        </script>
<?php

    }
}

?>