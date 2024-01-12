<?php
include_once("../conexao.php");
session_start();

if (isset($_GET["idAdministrador"])) {
    $idAdministrador = $_GET["idAdministrador"];

    $sql = "DELETE FROM Administrador WHERE idAdministrador = $idAdministrador";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoDeletadoComSucesso'] = "Sucesso";
?>
        <script>
            window.history.back(); 
        </script>

    <?php

    } else {
        $_SESSION['erroDeletar'] = "Erro";
    ?>
        <script>
            window.history.back(); 
        </script>
<?php

    }
}

?>