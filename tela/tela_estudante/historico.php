<?php
    session_start();
    include_once("../../php/conexao.php");
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: ../../php/sair.php");
        exit;
    }else{
        if($_SESSION['usuarioNivelDeAcesso'] != '1'){
            // Usuário sem acesso! Redireciona para a página anterior
            header("Location: ../tela_inicial/menu.php");
            exit;
        }
    }

    $sqlEstudante = "SELECT *
    FROM Estudante
    WHERE RegistroAcademico = '{$_SESSION['usuarioId']}'";
    $Estudante = $conn->query($sqlEstudante);
    $exibirEstudante = $Estudante->fetch_assoc();

    $RegistroAcademico = $exibirEstudante["RegistroAcademico"];
    $NomeEstudante = $exibirEstudante["NomeEstudante"];
    $EmailEstudante = $exibirEstudante["EmailEstudante"];
    $InstituicaoEstudante_IdInstituicao = $exibirEstudante["InstituicaoEstudante_IdInstituicao"];
    $AnoLetivoEstudante = $exibirEstudante["AnoLetivoEstudante"];
    $IdadeEscolarEstudante = $exibirEstudante["IdadeEscolarEstudante"];
    $DataInicioEstudante = date('Y', strtotime($exibirEstudante["DataInicioEstudante"]));
    $DataFinalEstudante = date('Y', strtotime($exibirEstudante["DataFinalEstudante"]));

    // VerificacaoEstudante
    $string = null;
    $array = null;
    $string = $exibirEstudante["VerificacaoEstudante"];
    $array = explode(' - ', $string);

    $total = 0;
    for($cont = 0; $cont < sizeof($array); $cont++){
        //echo $array[$total] . " / ";
        $total++;
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
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="../tela_inicial/menu.php">
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
                        <a class="nav-link" href="historico.php">
                            <i class="mdi mdi-file-document-box-outline "></i>
                            <span>Histórico</span></a>
                    </li>
                    <!-- Nav Item - Charts -->
                    <li class="nav-item">
                        <a class="nav-link" href="materias.php">
                            <i class="mdi mdi-file-document-outline"></i>
                            <span>Notas p/ Matérias</span></a>
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
                    <h1 class="h3 mb-2 text-gray-800"> Histórico Geral</h1>
                    <p class="mb-4"></p>

                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-gray-800">Visualizar Histórico</h6>
                        </div>
                        <div class="modal-body">
                            <form action="historicoAnoSelecionado.php" method="post">
                            <h6><b>Selecione o ano letivo</b>&nbsp;</h6>
                                <select class="custom-select custom-select-sm form-control form-control-sm mb-3" name="idAnoLetivoSelect" id="idAnoLetivoSelect">
                                    <option selected disabled hidden>Ano letivo</option>
                                    <?php
                                    //buscar dados do dropdown no BD (tbestcivil)
                                    //criar o comando sql

                                    for ($cont = 0; $cont <= $total; $cont++)  {
                                        if($cont==4){
                                            $anoEscolar = $array[0];
                                            $idadeEscolar = $array[1];
                                            $situacaoEscolarGeral = $array[2];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==7){
                                            $anoEscolar = $array[3];
                                            $idadeEscolar = $array[4];
                                            $situacaoEscolarGeral = $array[5];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==10){
                                            $anoEscolar = $array[6];
                                            $idadeEscolar = $array[7];
                                            $situacaoEscolarGeral = $array[8];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==13){
                                            $anoEscolar = $array[9];
                                            $idadeEscolar = $array[10];
                                            $situacaoEscolarGeral = $array[11];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==16){
                                            $anoEscolar = $array[12];
                                            $idadeEscolar = $array[13];
                                            $situacaoEscolarGeral = $array[14];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==19){
                                            $anoEscolar = $array[15];
                                            $idadeEscolar = $array[16];
                                            $situacaoEscolarGeral = $array[17];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==22){
                                            $anoEscolar = $array[18];
                                            $idadeEscolar = $array[19];
                                            $situacaoEscolarGeral = $array[20];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==25){
                                            $anoEscolar = $array[21];
                                            $idadeEscolar = $array[22];
                                            $situacaoEscolarGeral = $array[23];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==28){
                                            $anoEscolar = $array[24];
                                            $idadeEscolar = $array[25];
                                            $situacaoEscolarGeral = $array[26];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==31){
                                            $anoEscolar = $array[27];
                                            $idadeEscolar = $array[28];
                                            $situacaoEscolarGeral = $array[29];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==34){
                                            $anoEscolar = $array[30];
                                            $idadeEscolar = $array[31];
                                            $situacaoEscolarGeral = $array[32];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==37){
                                            $anoEscolar = $array[33];
                                            $idadeEscolar = $array[34];
                                            $situacaoEscolarGeral = $array[35];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==40){
                                            $anoEscolar = $array[36];
                                            $idadeEscolar = $array[37];
                                            $situacaoEscolarGeral = $array[38];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==43){
                                            $anoEscolar = $array[39];
                                            $idadeEscolar = $array[40];
                                            $situacaoEscolarGeral = $array[41];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }elseif($cont==46){
                                            $anoEscolar = $array[42];
                                            $idadeEscolar = $array[43];
                                            $situacaoEscolarGeral = $array[44];
                                            ?>
                                                <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                                <hr>
                                <input type="submit" value="Carregar dados" class="btn btn-success btn-icon-split-user">
                            </form>
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