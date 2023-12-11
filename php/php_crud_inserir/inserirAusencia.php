<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $DataAusencia = $_GET["DataAusencia"];
    $Etapa_idEtapa = $_GET["Etapa_idEtapa"];
    $Estudante_RegistroAcademico = $_GET["Estudante_RegistroAcademico"];
    $Materias_idMateria = $_GET["Materias_idMateria"];

    //criar o comando sql do insert
    $sql = "INSERT INTO `deo`.`Ausencia` (`DataAusencia`, `Etapa_idEtapa`, `Estudante_RegistroAcademico`, `Materias_idMateria`) 
    VALUES ('$DataAusencia', '$Etapa_idEtapa' , '$Estudante_RegistroAcademico', '$Materias_idMateria')";

    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        $_SESSION['registradoInseridoComSucesso'] = "Sucesso";
        ?>
        <script>
            window.location = "../../tela/tela_professor/gerenciaAusenciaEstudante.php?idEtapa=<?php echo $Etapa_idEtapa ?>&idMateria=<?php echo $Materias_idMateria ?>&data=<?php echo $DataAusencia ?>";
        </script>

        <?php
    }
    else{
        $_SESSION['erroInserir'] = "Erro";
        ?>
        <script>
            window.location = "../../tela/tela_professor/gerenciaAusenciaEstudante.php?idEtapa=<?php echo $Etapa_idEtapa ?>&idMateria=<?php echo $Materias_idMateria ?>&data=<?php echo $DataAusencia ?>";
        </script>
        
        <?php
    }

?>