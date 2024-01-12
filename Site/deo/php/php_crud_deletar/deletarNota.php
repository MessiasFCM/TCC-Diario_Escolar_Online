<?php
include_once("../conexao.php");
session_start();

if (isset($_GET["idNota"])) {
    $idNota = $_GET["idNota"];

    $sql = "DELETE FROM Nota WHERE idNota = $idNota";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoDeletadoComSucesso'] = "Sucesso";
?>
        <script>
            // window.location = "../../tela/tela_gerencia/gerenciaNota.php";
        </script>

    <?php

    } else {
        $_SESSION['erroDeletar'] = "Erro";
    ?>
        <script>
            // window.location = "../../tela/tela_gerencia/gerenciaNota.php";
        </script>
<?php

    }
}

?>