<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    if (isset($_GET["Etapa_idEtapa"]) && isset($_GET["Materia_idMateria"])) {
        $NomeProva = $_POST["txtnomeProva"];
        $ValorProva = $_POST["txtvalorProva"];
        $DataProva = $_POST["txtdataProva"];
        $Etapa_idEtapa = $_GET ["Etapa_idEtapa"];
        $Materia_idMateria = $_GET ["Materia_idMateria"];
    

        //criar o comando sql do insert
        $sql = "INSERT INTO `deo`.`Prova` (`NomeProva`, `ValorProva`, `DataProva`, `Etapa_idEtapa`, `Materia_idMateria`)
        VALUES ('$NomeProva', '$ValorProva', '$DataProva', '$Etapa_idEtapa', '$Materia_idMateria')";


        //Executando o comando sql
        if($conn -> query($sql) === TRUE ){
            $_SESSION['registradoInseridoComSucesso'] = "Sucesso";
            ?>
            <script>
                window.location = "../../tela/tela_professor/gerenciaProvasEscolhidas.php?Etapa_idEtapa=<?php echo $Etapa_idEtapa ?>&Materia_idMateria=<?php echo $Materia_idMateria?>";
            </script>

            <?php
        }
        else{
            $_SESSION['erroInserir'] = "Erro";
            ?>
            <script>
                window.location = "../../tela/tela_professor/gerenciaProvasEscolhidas.php?Etapa_idEtapa=<?php echo $Etapa_idEtapa ?>&Materia_idMateria=<?php echo $Materia_idMateria?>";
            </script>
            
            <?php
        }
    }
?>