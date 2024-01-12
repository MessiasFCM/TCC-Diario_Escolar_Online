<?php
    session_start();
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: ../../php/sair.php");
        exit;
    }else{
        if($_SESSION['usuarioNivelDeAcesso'] != '4'){
            // Usuário sem acesso! Redireciona para a página anterior
            header("Location: ../tela_inicial/menu.php");
            exit;
        }
    }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Diário Escolar Online</title>

    <!-- Custom fonts for this template-->
    <link href="../../vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <!-- Custom styles for this template-->
    <link href="../../css/sb-admin-2.min.css" rel="stylesheet">

    <link rel="stylesheet" href="../../css/alertsCrud.css">

    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../tela_inicial/menu.php">
                <div class="sidebar-brand-icon">
                    <i class="mdi mdi-home"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Menu</div>
            </a>

            <?php
                if($_SESSION['usuarioNivelDeAcesso'] == '4'){
                    ?>
                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Interface Administrador
                    </div>

                    <!-- Nav Item - Charts -->
                    <li class="nav-item">
                        <a class="nav-link" href="administrador.php">
                        <i class="mdi mdi-lock"></i>
                        <span>Administração</span></a>
                    </li>
                    <!-- Divider -->
                    <hr class="sidebar-divider d-none d-md-block">
                    <?php
                }
            ?>

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->
    
        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <h5 class="text-gray-800">Diário escolar online</h5>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['usuarioNome']?></span>
                                <img class="img-profile rounded-circle"
                                    src="../../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="../tela_auxiliares/perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="../tela_auxiliares/configurações.php">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Configurações
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Sair
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Códigos de edição -->
                <div class="container-fluid">
                    <h1 class="h3 mb-2 text-gray-800">Dados Gerais</h1>
                    <p class="mb-4"></p>

                    <div class="card shadow mb-4">
                        <!-- <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-gray-800">Administrador</h6>
                        </div>
                        <div class="card-body">
                            <form action="../../php/php_crud_inserir/inserirAdministrador.php" method = "post">
                            <div class="form-group">
                                    <input type="text" class="form-control form-control-user" name="txtnomeAdministrador" id="nomeAdministrador" aria-describedby="nomeAdministrador" placeholder="Insira o nome completo">
                                </div>
                                <div class="form-group">
                                    <input type="email" class="form-control form-control-user" name="txtemailAdministrador" id="emailAdministrador" aria-describedby="emailAdministrador" placeholder="Insira o Email">
                                </div>
                                <div class="form-group">
                                    <input type="password" class="form-control form-control-user" name="txtsenhaAdministrador" id="senhaAdministrador" placeholder="Insira a senha">
                                </div>
                                
                                <input type="submit" value="Adicionar Administrador" class="btn btn-success btn-icon-split-user">
                                <a href="#" class="btn btn-warning btn-icon-split">
                                    <span class="text">Atualizar Administrador</span>
                                </a>
                                <a href="#" class="btn btn-danger btn-icon-split">
                                    <span class="text">Remover Administrador</span>
                                </a>
                                <a href="administradorListar.php" class="btn btn-info btn-icon-split">
                                    <span class="text">Listar todas os Administrador</span>
                                </a>
                            </form>  
                        </div> -->
                        <div>
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-gray-800">Funções de administrador</h6>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <a href="administradorInstituicao.php" class="col-sm-5 mb-3 mb-sm-0 btn btn-success btn-icon-split">
                                        <span class="text">Informações das Instituições</span>
                                    </a>
                                    <a>&nbsp;&nbsp;</a>
                                    <a href="administradorInstituicaoAprovar.php" class="col-sm-5 btn btn-secondary btn-icon-split">
                                        <span class="text">Aprovar Instituições</span>
                                    </a>
                                </div>  
                                <p></p>
                                <div class="form-group">
                                    <a href="administradorProfessor.php" class="col-sm-5 mb-3 mb-sm-0 btn btn-success btn-icon-split">
                                        <span class="text">Informações dos Professores</span>
                                    </a>
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <a href="administradorEstudante.php" class="col-sm-5 mb-3 mb-sm-0 btn btn-success btn-icon-split">
                                        <span class="text">Informações dos Estudantes</span>
                                    </a>
                                </div>
                                <p></p>
                                <div class="form-group">
                                    <a href="administradorAdministrador.php" class="col-sm-5 mb-3 mb-sm-0 btn btn-success btn-icon-split">
                                        <span class="text">Informações dos Administradores</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!-- End of Main Content -->


        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Certeza que deseja sair?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Selecione "Sair" abaixo se você estiver pronto para encerrar sua sessão atual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="../../php/sair.php">Sair</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="../../vendor/jquery/jquery.min.js"></script>
    <script src="../../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/chart-area-demo.js"></script>
    <script src="../../js/demo/chart-pie-demo.js"></script>

</body>

</html>