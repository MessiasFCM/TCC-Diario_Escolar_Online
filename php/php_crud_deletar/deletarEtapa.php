<?php
include_once("../conexao.php");
session_start();

if (isset($_GET["idEtapa"])) {
    $idEtapa = $_GET["idEtapa"];

    $sql = "DELETE FROM Etapa WHERE idEtapa = $idEtapa";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoDeletadoComSucesso'] = "Sucesso";
?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaEtapa.php";
        </script>

    <?php

    } else {
        $_SESSION['erroDeletar'] = "Erro";
    ?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaEtapa.php";
        </script>
<?php

    }
}

?>