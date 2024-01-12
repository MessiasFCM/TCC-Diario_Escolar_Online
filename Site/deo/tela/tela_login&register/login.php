<?php
    session_start();
    include_once("../../php/conexao.php");
    $_SESSION['logged'] = False;
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Diário Escolar Online</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link rel="stylesheet" href="../../fonts/icomoon/style.css">
    <link rel="stylesheet" href="../../css/login-form/owl.carousel.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="../../css/login-form/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="../../css/login-form/style.css">
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.4.1.js"></script>
    <!-- Custom styles for this template-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />

    <link rel="stylesheet" href="../../css/alerts.css">


</head>

<body class="bg-gradient-light">
    <div>
        <?php
        $totalInstituicao = 0;
        $totalProfessor = 0;
        $totalEstudante = 0;

        $sql = "SELECT * 
            FROM Instituicao
            WHERE InstituicaoAprovada=1";
        //executar o comando
        $Instituicao = $conn->query($sql);
        while ($exibir = $Instituicao->fetch_assoc()){
            $totalInstituicao++;
        }

        $sql = "SELECT * 
            FROM Professor";
        //executar o comando
        $Professor = $conn->query($sql);
        while ($exibir = $Professor->fetch_assoc()){
            $totalProfessor++;
        }

        $sql = "SELECT * 
            FROM Estudante";
        //executar o comando
        $Estudante = $conn->query($sql);
        while ($exibir = $Estudante->fetch_assoc()){
            $totalEstudante++;
        }
    ?>
    </div>
        <!-- Outer Row -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                    <img src="../../img/FundoInicial.png" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                    <div class="row justify-content-center">
                        <div class="col-md-8 contents">
                        <div class="mb-4">
                        <h3>Bem vindo de volta!</h3>
                        <p class="mb-4">Insira seu RA / email e sua senha para acessar o site.</p>
                        </div>
                        <form action="../../php/valida.php" class="user" method="POST">
                            <div class="form-group first mb-2">
                                <label for="username"><i class="mdi mdi-account"></i>&nbsp;RA / Email</label>
                                <input type="text" class="form-control" style="height: 0%;" name="txtloginUsuario"
                                    id="txtloginUsuario" placeholder="" required>
                            </div>
                            <div class="form-group last mb-4">
                                <label for="password"><i class="mdi mdi-lock"></i>&nbsp;Senha</label>
                                <input type="password" class="form-control" style="height: 0%;" name="txtsenhaUsuario"
                                    id="txtsenhaUsuario" placeholder="" required>
                                
                            </div>
                            
                            <div class="d-flex mb-5 align-items-center">
                                <label class="control control--checkbox mb-0"><span class="caption">Lembrar de mim</span>
                                <input type="checkbox"/>
                                <div class="control__indicator"></div>
                                </label>
                                <span class="ml-auto "><a class="forgot-pass text-muted" data-toggle="modal" data-target="#myModal"  style="text-decoration:none">Esqueceu sua senha</a></span> 
                            </div>

                            <input type="submit" value="Login" class="btn btn-block btn-success ">

                            <div>
                                <a class="text-center d-block text-left my-2 text-muted"  style="text-decoration:none" href="register.php">&mdash;&mdash; Registrar uma nova instituição &mdash;&mdash;</a>
                            </div>

                            <div>
                                <a class="text-center d-block text-left my-2 text-muted"  style="text-decoration:none" href="sobre.php">&mdash;&mdash; Sobre os desenvolvedores &mdash;&mdash;</a>
                            </div>
                            

                            <!-- Atualizar Modal-->
                            <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="inserirModalLabel">Esqueceu a senha?</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">&nbsp;Contate a secretária de sua instituição, através do e-mail ou presencialmente, e peça ajuda para redefinir sua senha de usuário.</div>
                                    </div>
                                </div>
                            </div>
                            
                        <!--<div class="social-login">
                                <a href="#" class="facebook">
                                <span class="icon-facebook mr-3"></span> 
                                </a>
                                <a href="#" class="twitter">
                                <span class="icon-twitter mr-3"></span> 
                                </a>
                                <a href="#" class="google">
                                <span class="icon-google mr-3"></span> 
                                </a>
                            </div> -->
                        </form>
                        </div>
                        <div class="row">
                            <div class="card-body">
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Registrada</div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><i class="mdi mdi-bank"></i>&nbsp;<?php echo $totalInstituicao ?> instituições</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                        Registrado</div>
                                    <div class="h6 mb-0 mr-3 font-weight-bold text-gray-800"><i class="mdi mdi-school"></i>&nbsp;<?php echo $totalProfessor ?> professores</div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="col">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Registrado</div>
                                    <div class="h6 mb-0 font-weight-bold text-gray-800"><i class="mdi mdi-account"></i>&nbsp;<?php echo $totalEstudante ?> estudantes</div>
                                </div>
                            </div>
                        </div>
                        <div class="text-center">
                            <?php 
                                if(isset($_SESSION['loginErro'])){
                                ?>
                                <div class="alert hide alert-danger">
                                    <span class="fa fa-sign-out"></span>
                                    <span class="msg">Usuário ou senha inválido!</span>
                                    <div class="close-btn">
                                        <span class="fas fa-times"></span>
                                    </div>
                                </div>
                                <script>
                                    $('.alert').addClass("show");
                                    $('.alert').removeClass("hide");
                                    $('.alert').addClass("showAlert");
                                    setTimeout(function(){
                                        $('.alert').removeClass("show");
                                        $('.alert').addClass("hide");
                                    },5000);
                                    $('.close-btn').click(function(){
                                    $('.alert').removeClass("show");
                                    $('.alert').addClass("hide");
                                    });
                                </script>
                                <?php
                                unset($_SESSION['loginErro']);
                            }
                            ?>
                            <?php 
                                if(isset($_SESSION['logindeslogado'])){
                                    ?>
                                    <div class="alert hide alert-success">
                                        <span class="fa fa-sign-out"></span>
                                        <span class="msg">Deslogado com sucesso!</span>
                                        <div class="close-btn">
                                            <span class="fas fa-times"></span>
                                        </div>
                                    </div>
                                    <script>
                                        $('.alert').addClass("show");
                                        $('.alert').removeClass("hide");
                                        $('.alert').addClass("showAlert");
                                        setTimeout(function(){
                                            $('.alert').removeClass("show");
                                            $('.alert').addClass("hide");
                                        },5000);
                                        $('.close-btn').click(function(){
                                        $('.alert').removeClass("show");
                                        $('.alert').addClass("hide");
                                        });
                                    </script>
                                    <?php
                                    unset($_SESSION['logindeslogado']);
                                }
                            ?>
                            <?php 
                                if(isset($_SESSION['loginAndamento'])){
                                    ?>
                                    <div class="alert hide alert-success">
                                        <span class="fa fa-sign-out"></span>
                                        <span class="msg">Em espera de confirmação!</span>
                                        <div class="close-btn">
                                            <span class="fas fa-times"></span>
                                        </div>
                                    </div>
                                    <script>
                                        $('.alert').addClass("show");
                                        $('.alert').removeClass("hide");
                                        $('.alert').addClass("showAlert");
                                        setTimeout(function(){
                                            $('.alert').removeClass("show");
                                            $('.alert').addClass("hide");
                                        },5000);
                                        $('.close-btn').click(function(){
                                        $('.alert').removeClass("show");
                                        $('.alert').addClass("hide");
                                        });
                                    </script>
                                    <?php
                                    unset($_SESSION['loginAndamento']);
                                }
                            ?>
                        </div>
                    </div>
                    
                    </div>
                    
                </div>
            </div>
            <!-- <button>Show Alert</button>
            <div class="alert hide">
                <span class="fas fa-exclamation-circle"></span>
                <span class="msg">Warning: This is a warning alert!</span>
                <div class="close-btn">
                    <span class="fas fa-times"></span>
                </div>
            </div> -->
        </div>
    </div>

    <script src="../../js/login-form/jquery-3.3.1.min.js"></script>
    <script src="../../js/login-form/popper.min.js"></script>
    <script src="../../js/login-form/bootstrap.min.js"></script>
    <script src="../../js/login-form/main.js"></script>
    
    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

</body>

</html>