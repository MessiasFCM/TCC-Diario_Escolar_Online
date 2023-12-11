<?php
    //Incluindo arquivo de conexão com o banco de dados
    session_start();
    include_once("../conexao.php");
    $cont = 0;

    //receber os dados que veio do form via POST
    $CNPJInstituicao = $_POST["txtCNPJdaInstituicao"];
    $NomeInstituicao = $_POST["txtnomeInstituicao"];
    $EmailInstituicao = $_POST["txtemailInstituicao"];
    $SenhaInstituicao = $_POST["txtsenhaInstituicao"];
    $ContatoInstituicao = $_POST["txtcontatoInstituicao"];
    if(isset ($_POST["txtbairroInstituicao"])){
        $Bairro = $_POST["txtbairroInstituicao"];
    }
    if(isset ($_POST["txtruaInstituicao"])){
        $Rua = $_POST["txtruaInstituicao"];
    }
    if(isset ($_POST["txtestadoInstituicao"])){
        $Estado = $_POST["txtestadoInstituicao"];
    }
    if(isset ($_POST["txtcidadeInstituicao"])){
        $Cidade = $_POST["txtcidadeInstituicao"];
    }
    if(isset ($_POST["txtnumeroInstituicao"])){
        $NumeroResidencial = $_POST["txtnumeroInstituicao"];
    }
    if(isset ($_POST["txtCEPdaInstituicao"])){
        $CEP = $_POST["txtCEPdaInstituicao"];
    }else{
        $cont++;
    }

    $criptografada = md5($SenhaInstituicao);

    //criar o comando sql do insert
    if($cont == 0){
        $sql = "INSERT INTO `deo`.`Instituicao` (`CNPJInstituicao`, `NomeInstituicao`, `EmailInstituicao`, `SenhaInstituicao`, `ContatoInstituicao`, `Bairro`, `Rua`, `Estado`, `Cidade`, `NumeroResidencial`, `CEP`, `InstituicaoAprovada`) 
        VALUES ('$CNPJInstituicao', '$NomeInstituicao', '$EmailInstituicao', '$criptografada', '$ContatoInstituicao', '$Bairro', '$Rua', '$Estado', '$Cidade', '$NumeroResidencial', '$CEP', 0)";
    }else{
        $sql = "INSERT INTO `deo`.`Instituicao` (`CNPJInstituicao`, `NomeInstituicao`, `EmailInstituicao`, `SenhaInstituicao`, `ContatoInstituicao`, `Bairro`, `Rua`, `Estado`, `Cidade`, `NumeroResidencial`, `CEP`, `InstituicaoAprovada`) 
        VALUES ('$CNPJInstituicao', '$NomeInstituicao', '$EmailInstituicao', '$criptografada', '$ContatoInstituicao', null, null, null, null, null, null, 0)";
    }
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