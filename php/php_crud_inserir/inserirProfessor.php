<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    //receber os dados que veio do form via POST
    $NomeProfessor = $_POST["txtnomeProfessor"];
    $EmailProfessor = $_POST["txtemailProfessor"];
    $SenhaProfessor = $_POST["txtsenhaProfessor"];
    $ContatoProfessor = $_POST["txtContatoProfessor"];

    if (isset ($_POST["idInstituicaoSelect"])){
        $InstituicaoProfessor_IdInstituicao = $_POST["idInstituicaoSelect"];
    }else{
        $InstituicaoProfessor_IdInstituicao = $_SESSION['usuarioId'];
    }

    $criptografada = md5($SenhaProfessor);

    //criar o comando sql do insert
    $sql = "INSERT INTO `deo`.`Professor` (`NomeProfessor`, `EmailProfessor`, `SenhaProfessor`, `ContatoProfessor`, `InstituicaoProfessor_IdInstituicao`)
    VALUES ('$NomeProfessor', '$EmailProfessor', '$criptografada', '$ContatoProfessor', '$InstituicaoProfessor_IdInstituicao')";

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