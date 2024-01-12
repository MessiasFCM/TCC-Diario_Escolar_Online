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

</head>

<body class="bg-gradient-light">

</div>
        <!-- Outer Row -->
        <div class="content">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                    <img src="../../img/FundoInicial.png" alt="Image" class="img-fluid">
                    </div>
                    <div class="col-md-6 ">
                    <div class="row justify-content-center">
                        <div class="col-md-8 contents">
                        <div class="mb-4">
                        <h3>Registre uma nova instituição!</h3>
                        <p class="mb-4">Insira os dados básicos e após a confirmação, preencha as outras informações</p>
                        </div>
                        <form action="../../php/php_crud_inserir/inserirInstituicao.php" method="post" class="user">
                            <div class="form-group first mb-2">
                                <label for="username">Nome da instituição</label>        
                                <input type="text" class="form-control" style="height: 0%;" name="txtnomeInstituicao" id="nomeInstituicao" aria-describedby="nomeInstituicao"
                                    placeholder="" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="username">CNPJ da instituição</label>
                                <input type="text" class="form-control" style="height: 0%;" name="txtCNPJdaInstituicao" id="CNPJdaInstituicao" aria-describedby="CNPJdaInstituicao"
                                    placeholder="" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="username">Email da instituição</label>
                                <input type="email" class="form-control" style="height: 0%;" name="txtemailInstituicao" id="emailInstituicao" aria-describedby="emailInstituicao"
                                    placeholder="" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="username">Insira uma senha</label>
                                <input type="password" class="form-control" style="height: 0%;"
                                    id="senhaInstituicao" name="txtsenhaInstituicao" placeholder="" required>
                            </div>
                            <div class="form-group mb-2">
                                <label for="username">Repita a senha</label>
                                <input type="password" class="form-control" style="height: 0%;"
                                    id="repetirSenhaInstituicao" name="txtrepetirSenhaInstituicao" placeholder="" required>
                            </div>
                            <div class="form-group last mb-5">
                                <label for="username" >Contato da instituição</label>
                                <input type="text" class="form-control" style="height: 0%;" name="txtcontatoInstituicao" id="contatoInstituicao" aria-describedby="contatoInstituicao"
                                    placeholder="" required>
                            </div>
                            <input type="submit" value="Registrar Instituição" class="btn btn-block btn-success ">

                            <div>
                                <a class="text-center d-block text-left my-2 text-muted"  style="text-decoration:none" href="login.php">&mdash;&mdash; Já se registrou? Clique aqui para logar! &mdash;&mdash;</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
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