<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $Estudante_RegistroAcademico = $_GET["Estudante_RegistroAcademico"];
    $Materia_idMateria = $_GET["Materia_idMateria"];
    $AnoLetivo_EstudanteHasMateria = $_GET["AnoLetivo_EstudanteHasMateria"];
    $VerificacaoAprovacao = "Em andamento";

    //criar o comando sql do insert
    $sql = "INSERT INTO `deo`.`Estudante_has_Materia` (`Estudante_RegistroAcademico`, `Materia_idMateria`, `AnoLetivo_EstudanteHasMateria`, `VerificacaoAprovacao`) 
    VALUES ('$Estudante_RegistroAcademico', '$Materia_idMateria', '$AnoLetivo_EstudanteHasMateria', '$VerificacaoAprovacao')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        $_SESSION['registradoInseridoComSucesso'] = "Sucesso";
        ?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaEstudanteMateria.php?RegistroAcademico=<?php echo $Estudante_RegistroAcademico ?>";
        </script>

        <?php
    }
    else{
        $_SESSION['erroInserir'] = "Erro";
        ?>
        <script>
            window.location = "../../tela/tela_gerencia/gerenciaEstudanteMateria.php?RegistroAcademico=<?php echo $Estudante_RegistroAcademico ?>";
        </script>
        
        <?php
    }
    

?>