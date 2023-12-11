<?php
include_once("../conexao.php");
session_start();

if (isset($_GET["RegistroAcademico"])) {
    $RegistroAcademico = $_GET["RegistroAcademico"];

    $sql = "DELETE FROM Estudante WHERE RegistroAcademico = $RegistroAcademico";

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