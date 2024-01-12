<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $NomeMateria = $_POST["txtnomeMateria"];
    $IdadeEscolarMateria = $_POST["opIdadeEscolar"];
    $Professor_idProfessor = $_POST["idProfessorSelect"];

    //criar o comando sql do insert
    $sql = "INSERT INTO `deo`.`Materia` (`NomeMateria`, `IdadeEscolarMateria`, `Professor_idProfessor`)
    VALUES ('$NomeMateria','$IdadeEscolarMateria', '$Professor_idProfessor')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        $_SESSION['registradoInseridoComSucesso'] = "Sucesso";
        ?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaMateria.php";
        </script>

        <?php
    }
    else{
        $_SESSION['erroInserir'] = "Erro";
        ?>
        <script>
            window.history.back(); 
        </script>
        
        <?php
    }

?>