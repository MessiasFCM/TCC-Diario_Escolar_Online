<?php
include_once("../conexao.php");
session_start();

if (isset($_GET["IdInstituicao"])) {
    $IdInstituicao = $_GET["IdInstituicao"];

    $sql = "DELETE FROM Instituicao WHERE IdInstituicao = $IdInstituicao";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoDeletadoComSucesso'] = "Sucesso";
?>
        <script>
            window.location = "../../tela/tela_administrador/administradorInstituicao.php";
        </script>

    <?php

    } else {
        $_SESSION['erroDeletar'] = "Erro";
    ?>
        <script>
            window.location = "../../tela/tela_administrador/administradorInstituicao.php";
        </script>
<?php

    }
}

?>