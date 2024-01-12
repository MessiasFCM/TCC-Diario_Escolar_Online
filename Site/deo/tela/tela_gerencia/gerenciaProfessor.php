<?php
    session_start();
    include_once("../../php/conexao.php");
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: ../../php/sair.php");
        exit;
    }else{
        if($_SESSION['usuarioNivelDeAcesso'] != '3'){
            // Usuário sem acesso! Redireciona para a página anterior
            header("Location: ../tela_inicial/menu.php");
            exit;
        }
    }
    
    //calcula o registro de inicio da visualização
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
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    
    <link rel="stylesheet" href="../../css/alertsCrud.css">
    

    <script>
        $(document).ready(function() {
            var pagina = 1; 
            var qtd_result_pg = 10;

            listar_registros(pagina, qtd_result_pg); 
            
            $("#form-pesquisa").submit(function(evento) {
                evento.preventDefault();
                listar_registros(pagina, qtd_result_pg); 
            });
        });

        //define a função listar_registross()
        function listar_registros(pagina, qtd_result_pg) {
            var pesquisa = $("#pesquisa").val();
            var dados = { //define o objeto com os dados a serem enviados
                pesquisa: pesquisa,
                pagina: pagina,
                qtd_result_pg: qtd_result_pg
            }
            //alert(dados.pesquisa);

            $.post('listar/listarProfessor.php', dados, function(retorna) { //envia os dados via post
                $(".resultados").html(retorna); //define onde o resultado será exibido
            });
        }
    </script>


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
                if($_SESSION['usuarioNivelDeAcesso'] == '3'){
                    ?>
                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Interface Instituição
                    </div>

                    <!-- Nav Item - Pages Collapse Menu -->

                    <li class="nav-item">
                        <a class="nav-link" href="gerenciaMateria.php">
                            <i class="mdi mdi-book"></i>
                            <span>Matérias</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="gerenciaProfessor.php">
                            <i class="mdi mdi-school"></i>
                            <span>Professores</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="gerenciaEstudante.php">
                            <i class="mdi mdi-book"></i>
                            <span>Estudantes</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="gerenciaEtapa.php">
                            <i class="mdi mdi-book"></i>
                            <span>Etapa</span></a>
                    </li>
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
                                <a class="dropdown-item" href="#perfil" data-toggle="modal" data-target="#logoutModal">
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
                    <h1 class="h3 mb-2 text-gray-800"> Gerenciar Professores</h1>
                    <p class="mb-4"></p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-gray-800">Dados dos professores</h6>
                        </div>
                        <div class="modal-body">
                            <form id="form-pesquisa" action="" method="post">
                                <div class="row">
                                    <div class="form-group col-sm-12">
                                        <div class="col-sm-12">
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <button class="btn btn-primary btn-border" type="submit" name="enviar" value="Pesquisar">Pesquisar:</button>
                                                </div>
                                                <input type="text" class="form-control form-control-user" name="pesquisa" id="pesquisa" placeholder="Buscar...">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="resultados card"></div>
                        </div>
                    </div>
                </div>
            <!-- End of Main Content -->
            </div>
        <!-- End of Content Wrapper -->
        </div>
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

    <!-- Inserir Modal-->

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

     <!-- Page level plugins -->
     <script src="../../vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="../../vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="../../js/demo/datatables-demo.js"></script>
</body>

</html>