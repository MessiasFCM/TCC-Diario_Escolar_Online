<?php
include_once("../conexao.php");
session_start();

if (isset($_GET["idProfessor"])) {
    $idProfessor = $_GET["idProfessor"];

    $sql = "DELETE FROM Professor WHERE idProfessor = $idProfessor";

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