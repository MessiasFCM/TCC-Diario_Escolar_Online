<?php
session_start();

    include_once("../conexao.php");

    if (isset($_GET["idMateria"])) {
        $idMateria = $_GET["idMateria"];

        $sql = "DELETE FROM Materia WHERE idMateria = $idMateria";

        if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoDeletadoComSucesso'] = "Sucesso";

?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaMateria.php";
        </script>

    <?php

    } else {
        $_SESSION['erroDeletar'] = "Erro";
    ?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaMateria.php";
        </script>
<?php

    }
}

?>