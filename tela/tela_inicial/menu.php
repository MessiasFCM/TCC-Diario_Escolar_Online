<?php
    session_start();
    include_once("../../php/conexao.php");
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: ../../php/sair.php");
        exit;
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
    
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-success sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="menu.php">
                <div class="sidebar-brand-icon">
                    <i class="mdi mdi-home"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Menu</div>
            </a>

            <?php
                if($_SESSION['usuarioNivelDeAcesso'] == '1'){
                    ?>
                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Interface Estudante
                    </div>
                    <!-- Nav Item - Charts -->
                    <li class="nav-item">
                        <a class="nav-link" href="../tela_estudante/historico.php">
                            <i class="mdi mdi-file-document-box-outline "></i>
                            <span>Histórico</span></a>
                    </li>
                    <!-- Nav Item - Charts -->
                    <li class="nav-item">
                        <a class="nav-link" href="../tela_estudante/materias.php">
                            <i class="mdi mdi-file-document-outline"></i>
                            <span>Notas p/ Matérias</span></a>
                    </li>
                    <?php
                }
            ?>

            <?php
                if($_SESSION['usuarioNivelDeAcesso'] == '2'){
                    ?>
                    <!-- Divider -->
                    <hr class="sidebar-divider">

                    <!-- Heading -->
                    <div class="sidebar-heading">
                        Interface Professor
                    </div>

                    <li class="nav-item">
                        <a class="nav-link" href="../tela_professor/gerenciaProvas.php">
                            <i class="mdi mdi-book"></i>
                            <span>Gerenciar provas</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tela_professor/gerenciaNotas.php">
                            <i class="mdi mdi-book"></i>
                            <span>Gerenciar notas</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tela_professor/gerenciaAusencia.php">
                            <i class="mdi mdi-book"></i>
                            <span>Gerenciar ausência</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tela_professor/gerenciaHistoricoMateria.php">
                            <i class="mdi mdi-book"></i>
                            <span>Gerenciar históricos</span></a>
                    </li>
                    <?php
                }
            ?>

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
                        <a class="nav-link" href="../tela_gerencia/gerenciaMateria.php">
                            <i class="mdi mdi-book"></i>
                            <span>Matérias</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tela_gerencia/gerenciaProfessor.php">
                            <i class="mdi mdi-school"></i>
                            <span>Professores</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tela_gerencia/gerenciaEstudante.php">
                            <i class="mdi mdi-book"></i>
                            <span>Estudantes</span></a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="../tela_gerencia/gerenciaEtapa.php">
                            <i class="mdi mdi-book"></i>
                            <span>Etapa</span></a>
                    </li>
                    <?php
                }
            ?>

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
                        <a class="nav-link" href="../tela_administrador/administrador.php">
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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> <?php echo $_SESSION['usuarioNome']?> </span>
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
                <?php
                if($_SESSION['usuarioNivelDeAcesso'] == '1'){
                    ?>
                    <div class="container-fluid">
                        <h1 class="h3 mb-2 text-gray-800">Página inicial</h1>
                        <p class="mb-4"></p>

                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <h6 class="m-0 font-weight-bold text-gray-800">Estudante</h6>
                                <img src="../../img/Education-bro.png" alt="Image" class="img-fluid" style="height=50px">
                                <!-- <img src="../../img/Devices-cuate.png" alt="Image" class="img-fluid" style="height=50px"> -->
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>

                <?php
                    if($_SESSION['usuarioNivelDeAcesso'] == '2'){
                        ?>
                        <div class="container-fluid">
                            <h1 class="h3 mb-2 text-gray-800">Página inicial</h1>
                            <p class="mb-4"></p>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Professor</h6>
                                    <img src="../../img/Education-pana.png" alt="Image" class="img-fluid" style="height=50px">
                                    <!-- <img src="../../img/Devices-cuate.png" alt="Image" class="img-fluid" style="height=50px"> -->
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>

                <?php
                    if($_SESSION['usuarioNivelDeAcesso'] == '3'){
                        $sql = "SELECT *
                        FROM Instituicao
                        WHERE IdInstituicao = '{$_SESSION['usuarioId']}'";
                        $Instituicao = $conn->query($sql);
                        $exibirInstituicao = $Instituicao->fetch_assoc();
                        $idInstituicao = $exibirInstituicao["IdInstituicao"];

                        $totalProfessor = 0;
                        $totalEstudante = 0;

                        $sql = "SELECT * 
                            FROM Professor
                            WHERE InstituicaoProfessor_IdInstituicao = $idInstituicao";
                        //executar o comando
                        $Professor = $conn->query($sql);
                        while ($exibir = $Professor->fetch_assoc()){
                            $totalProfessor++;
                        }

                        $sql = "SELECT * 
                            FROM Estudante
                            WHERE InstituicaoEstudante_IdInstituicao = $idInstituicao";
                        //executar o comando
                        $Estudante = $conn->query($sql);
                        while ($exibir = $Estudante->fetch_assoc()){
                            $totalEstudante++;
                        }

                        ?>
                        <div class="container-fluid">
                            <h1 class="h3 mb-2 text-gray-800">Página inicial</h1>
                            <p class="mb-4"></p>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-gray-800"><?php echo $exibirInstituicao["NomeInstituicao"]?></h6>
                                    <!-- <img src="../../img/Devices-cuate.png" alt="Image" class="img-fluid" style="height=50px"> -->
                                </div>
                                <div class="row">
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
                                <img src="../../img/Education-cuate.png" alt="Image" class="img-fluid" style="height=50px">  
                            </div>
                        </div>
                        <?php
                    }
                ?>

                <?php
                    if($_SESSION['usuarioNivelDeAcesso'] == '4'){
                        $totalInstituicao = 0;
                        $totalProfessor = 0;
                        $totalEstudante = 0;
                        $totalMateria = 0;
                        $totalAdministrador = 0;

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

                        $sql = "SELECT * 
                            FROM Materia";
                        //executar o comando
                        $Materia = $conn->query($sql);
                        while ($exibir = $Materia->fetch_assoc()){
                            $totalMateria++;
                        }

                        $sql = "SELECT * 
                            FROM Administrador";
                        //executar o comando
                        $Administrador = $conn->query($sql);
                        while ($exibir = $Administrador->fetch_assoc()){
                            $totalAdministrador++;
                        }
                        ?>
                        <div class="container-fluid">
                            <h1 class="h3 mb-2 text-gray-800">Página inicial</h1>
                            <p class="mb-4"></p>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Administração</h6>
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
                                    <div class="card-body">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Registrada</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800"><i class="mdi mdi-account"></i>&nbsp;<?php echo $totalMateria ?> matérias</div>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="col">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Registrado</div>
                                            <div class="h6 mb-0 font-weight-bold text-gray-800"><i class="mdi mdi-account"></i>&nbsp;<?php echo $totalAdministrador ?> administradores</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                    }
                ?>
                
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