<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    $idMateria = $_GET ["idMateria"];
    $NomeMateria = $_POST["txtnomeMateria2"];
    $IdadeEscolarMateria = $_POST["opIdadeEscolar2"];
    $Professor_idProfessor = $_POST["idProfessorSelect2"];

    $sql = "UPDATE Materia
            SET NomeMateria = '$NomeMateria', 
            IdadeEscolarMateria = '$IdadeEscolarMateria', 
            Professor_idProfessor = '$Professor_idProfessor'
            WHERE idMateria = $idMateria";

    if ($conn->query($sql) === TRUE) {
        $_SESSION['registradoAtualizadoComSucesso'] = "Sucesso";
        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }
    else{
        $_SESSION['erroAtualizar'] = "Erro";
        ?>
        <script>
            window.history.back();
        </script>
        <?php
    }
    
?>