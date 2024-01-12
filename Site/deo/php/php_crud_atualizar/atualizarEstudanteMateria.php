<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $Estudante_RegistroAcademico = $_GET["Estudante_RegistroAcademico"];
    $Materia_idMateria = $_GET["Materia_idMateria"];
    $AnoLetivo_EstudanteHasMateria = $_GET["AnoLetivo_EstudanteHasMateria"];
    $VerificacaoAprovacao =  $_POST["opSituacaoEscolar"];
    

    //criar o comando sql do UPDATE
    $sql = "UPDATE `deo`.`Estudante_has_Materia`
            SET VerificacaoAprovacao = '$VerificacaoAprovacao' 
            WHERE Estudante_RegistroAcademico = '$Estudante_RegistroAcademico'
            AND Materia_idMateria = '$Materia_idMateria'
            AND AnoLetivo_EstudanteHasMateria = '$AnoLetivo_EstudanteHasMateria'";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
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