<?php
    session_start();
    include_once("../../php/conexao.php");
    $_SESSION['logged'] = False;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Diário Escolar Online</title>

    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="../../fonts/icomoon/style.css">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- Custom styles for this template-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
</head>
<body class="bg-gradient-light">

    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                <br>
                <br>
                <br>
                <br>
                    <img src="../../img/Icon design-amico.png" alt="Image" class="img-fluid" >
                </div>
                <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-10 contents">
                            <div class="mb-4">
                                <br>
                                <br>
                                <br>
                                <br>
                                <h3><b>Sobre os desenvolvedores do site</b></h3>
                                <h7>&nbsp;&nbsp;&nbsp;O site "Diario Escolar Online" foi um projeto de final de curso (TCC) 
                                    criado por nós, os desenvolvedores do site. O site busca atingir uma demanda das escolas municipais de Minas Gerais 
                                    e ele foi idealizado e requisitado para nós pelos nosso professores do curso técnico de Informática. </h7><br><br>
                                <h3><b>Grupo de desenvolvedores</b></h3>
                                <h7>--->João Victor Barbosa de Souza Baêta do Amaral</h7><br>
                                <h7>--->Messias Feres Curi Melo</h7><br>
                                <h7>--->Victor Gabriel Rivera Malta Dias</h7><br><br>
                                <h3><b>Agradecimentos</b></h3>
                                <h7>&nbsp;&nbsp;&nbsp;Gostariamos de enviar agradecimentos especiais para nossos professores Carlos Eduardo Paulino Silva,
                                    Marcio Assis Miranda e Saulo Henrique Cabral Silva por nos ajudarem na implementação 
                                    de diversos recursos do site e aplicativo.</h7><br><br>
                                <h4><b>Para mais informações sobre o site</b></h4>
                                <span class="mdi mdi-instagram" aria-hidden="true"></span><h7> @diarioescolaronline</h7><br>
                                <span class="mdi mdi-gmail" aria-hidden="true"></span><h7> diarioescolaronline21@gmail.com</h7><br><br><br>
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                Voltar para a tela inicial&nbsp;<a href="login.php"  type="button" class="btn btn-success btn-xs dt-add">
                                    <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                                </a>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            
        </div>
    </div>
    


</body>
</html>