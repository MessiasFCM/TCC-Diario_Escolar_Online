<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $ValorObtido = $_POST["txtValorObtido"];
    $Provas_idProvas = $_POST["txtIdProva"];
    $Estudante_RegistroAcademico = $_POST["txtRegistroAcademico"];
    

    //criar o comando sql do insert
    $sql = "INSERT INTO `deo`.`Nota` (`ValorObtido`, `Provas_idProvas`, `Estudante_RegistroAcademico`)
    VALUES ('$ValorObtido', '$Provas_idProvas', '$Estudante_RegistroAcademico')";


    //Executando o comando sql
    if($conn -> query($sql) === TRUE ){
        $_SESSION['registradoInseridoComSucesso'] = "Sucesso";
        ?>
        <script>
            window.history.back(); 
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