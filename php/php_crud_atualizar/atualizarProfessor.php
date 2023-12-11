<?php
    //Incluindo arquivo de conexão com o banco de dados
    include_once("../conexao.php");
    session_start();

    $idProfessor = $_GET ["idProfessor"];
    
    if (isset($_POST["txtSenhaProfessor2"]) && isset($_POST["txtrepetirsenhaProfessor2"])) {
        $SenhaProfessor = $_POST["txtSenhaProfessor2"];
        $SenhaProfessorRepetir = $_POST["txtrepetirsenhaProfessor2"];
        if(isset($_POST["txtNomeProfessor2"]) && isset($_POST["txtEmailProfessor2"]) && isset($_POST["txtContatoProfessor2"])){
            $NomeProfessor = $_POST ["txtNomeProfessor2"];
            $EmailProfessor = $_POST ["txtEmailProfessor2"];
            $ContatoProfessor = $_POST["txtContatoProfessor2"];

            if($SenhaProfessor != ""){
                $criptografada = md5($SenhaProfessor);
            }else{
                $sqlBuscarSenha = "SELECT SenhaProfessor
                FROM Professor
                WHERE idProfessor = $idProfessor";
                $buscarSenha = $conn->query($sqlBuscarSenha);
                $exibirBuscarSenha = $buscarSenha->fetch_assoc();
                $criptografada = $exibirBuscarSenha["SenhaProfessor"];
            }
            
            $sql = "UPDATE Professor
            SET NomeProfessor = '$NomeProfessor', 
            EmailProfessor = '$EmailProfessor',
            SenhaProfessor = '$criptografada',
            ContatoProfessor = '$ContatoProfessor'
            WHERE idProfessor = $idProfessor";

        }elseif($SenhaProfessor != "" && $SenhaProfessorRepetir != ""){
            if($SenhaProfessor == $SenhaProfessorRepetir){
                $criptografada = md5($SenhaProfessor);
                $sql = "UPDATE Professor
                SET SenhaProfessor = '$criptografada'
                WHERE idProfessor = $idProfessor";
            }else{
                $_SESSION['erroAtualizar'] = "Erro";
                ?>
                <script>
                window.history.back();
                </script>
                <?php
            }
        }else{
            $_SESSION['erroAtualizar'] = "Erro";
            ?>
            <script>
            window.history.back();
            </script>
            <?php
        }

    }else{
        $NomeProfessor = $_POST ["txtNomeProfessor2"];
        $EmailProfessor = $_POST ["txtEmailProfessor2"];
        $ContatoProfessor = $_POST["txtContatoProfessor2"];

        $sqlBuscarSenha = "SELECT SenhaProfessor
        FROM Professor
        WHERE idProfessor = $idProfessor";
        $buscarSenha = $conn->query($sqlBuscarSenha);
        $exibirBuscarSenha = $buscarSenha->fetch_assoc();
        $criptografada = $exibirBuscarSenha["SenhaProfessor"];

        $sql = "UPDATE Professor
            SET NomeProfessor = '$NomeProfessor', 
            EmailProfessor = '$EmailProfessor',
            SenhaProfessor = '$criptografada',
            ContatoProfessor = '$ContatoProfessor'
            WHERE idProfessor = $idProfessor";
    }
    

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