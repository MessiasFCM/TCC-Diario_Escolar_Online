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
                if($_SESSION['usuarioNivelDeAcesso'] == '1' || $_SESSION['usuarioNivelDeAcesso'] == '2'|| $_SESSION['usuarioNivelDeAcesso'] == '3'|| $_SESSION['usuarioNivelDeAcesso'] == '4'){
                    if(isset($_SESSION['registradoAtualizadoComSucesso'])){
                    ?>
                    <div class="alert hide alert-success">
                        <span class="fa fa-sign-out"></span>
                        <span class="msg">Perfil atualizado</span>
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
                    unset($_SESSION['registradoAtualizadoComSucesso']);
                }
                if(isset($_SESSION['erroAtualizar'])){
                    ?>
                    <div class="alert hide alert-danger">
                        <span class="fa fa-sign-out"></span>
                        <span class="msg">Erro ao atualizar perfil</span>
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
                    unset($_SESSION['erroAtualizar']);
                }
            }
            ?>

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
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $_SESSION['usuarioNome']?></span>
                                <img class="img-profile rounded-circle"
                                    src="../../img/undraw_profile.svg">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                <a class="dropdown-item" href="configurações.php">
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

                <!-- Verificar usuário -->
                <?php
                
                    if ($_SESSION['usuarioNivelDeAcesso'] == 1){

                        $sql = "SELECT *
                        FROM Estudante
                        WHERE RegistroAcademico = '{$_SESSION['usuarioId']}'";
                        $Estudante = $conn->query($sql);
                        $exibirEstudante = $Estudante->fetch_assoc();

                        ?>

                        <div class="content">
                            <div class="container-fluid">
                                <h1 class="h3 mb-2 text-gray-800"> Perfil Estudante</h1>
                                <p class="mb-4"></p>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="card">
                                            <div class="card-header">
                                                <h4 class="card-title">Editar Perfil</h4>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../php/php_crud_atualizar/atualizarEstudante.php?RegistroAcademico=<?php echo $exibirEstudante["RegistroAcademico"] ?>" method="post">
                                                    <h6><b>Nome completo</b></h6>
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $exibirEstudante["NomeEstudante"]?>"  class="form-control form-control-user" name="txtnomeCompleto2" id="txtnomeCompleto2" aria-describedby="nomeEstudante" required placeholder="">
                                                    </div>
                                                    <h6><b>E-mail</b></h6>
                                                    <div class="form-group">
                                                        <input type="email" value="<?php echo $exibirEstudante["EmailEstudante"]?>"  class="form-control form-control-user" name="txtemailEstudante2" id="txtemailEstudante2" aria-describedby="emailEstudante"  required placeholder="">
                                                    </div>
                                                    <h6><b>Registro Acadêmico</b></h6>
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $exibirEstudante["RegistroAcademico"]?>" disabled class="form-control form-control-user" name="txtregistroAcademico" id="txtregistroAcademico" aria-describedby="nomeEstudante" required placeholder="">
                                                    </div>
                                                    <hr>
                                                    <input type="submit" value="Atualizar Perfil" class="btn btn-primary btn-icon-split-user">
                                                    <button type="button" class="btn btn-info btn-xs dt-edit" data-toggle="modal" data-target="#myModalAtualizar" style="margin-right:16px;">
                                                        Atualizar senha
                                                    </button>

                                                </form>
                                                 <!-- Atualizar Modal-->
                                                 <div class="modal fade" id="myModalAtualizar" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="inserirModalLabel">Atualizar senha</h5>
                                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">×</span>
                                                                </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../../php/php_crud_atualizar/atualizarEstudante.php?RegistroAcademico=<?php echo $exibirEstudante["RegistroAcademico"] ?>" method="post">
                                                                    
                                                                    <div class="form-group">
                                                                        <h6><b>Insira uma nova senha</b></h6>
                                                                        <input type="password" class="form-control form-control-user"
                                                                        id="txtsenhaEstudante2" name="txtsenhaEstudante2" placeholder="Nova senha">
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <h6><b>Repita a senha inserida</b></h6>
                                                                        <input type="password" class="form-control form-control-user"
                                                                        id="txtrepetirsenhaEstudante2" name="txtrepetirsenhaEstudante2" placeholder="Repita a senha">
                                                                    </div>
                                                                    <hr>
                                                                    <input type="submit" value="Atualizar senha" class="btn btn-primary btn-icon-split-user">
                                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                                </form> 
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php

                    }elseif($_SESSION['usuarioNivelDeAcesso'] == 2) {


                        $sql = "SELECT *
                        FROM Professor
                        WHERE idProfessor = '{$_SESSION['usuarioId']}'";
                        $Professor = $conn->query($sql);
                        $exibirProfessor = $Professor->fetch_assoc();

                        ?>

                        <div class="container-fluid">
                            <h1 class="h3 mb-2 text-gray-800"> Perfil Professor</h1>
                            <p class="mb-4"></p>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Editar Perfil</h6>
                                </div>
                                <div class="modal-body">
                                    <form action="../../php/php_crud_atualizar/atualizarProfessor.php?idProfessor=<?php echo $exibirProfessor["idProfessor"] ?>" method="post">
                                        
                                        <h6><b>Nome completo</b></h6>
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $exibirProfessor["NomeProfessor"]?>" class="form-control form-control-user" name="txtNomeProfessor2" id="txtNomeProfessor2" aria-describedby="nomeProfessor" required placeholder="">
                                        </div>
                                        <h6><b>E-mail</b></h6>
                                        <div class="form-group">
                                            <input type="email" value="<?php echo $exibirProfessor["EmailProfessor"]?>" class="form-control form-control-user" name="txtEmailProfessor2" id="txtEmailProfessor2" aria-describedby="emailProfessor"  required placeholder="">
                                        </div>
                                        <h6><b>Número de telefone</b></h6>
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $exibirProfessor["ContatoProfessor"]?>" class="form-control form-control-user" name="txtContatoProfessor2" id="txtContatoProfessor2" aria-describedby="contatoProfessor" placeholder="">
                                        </div>
                                        <hr>
                                        <input type="submit" value="Atualizar professor" class="btn btn-primary btn-icon-split-user">
                                        <button type="button" class="btn btn-info btn-xs dt-edit" data-toggle="modal" data-target="#myModalAtualizarProfessor" style="margin-right:16px;">
                                            Atualizar senha
                                        </button>
                                    </form> 
                                    <!-- Atualizar Modal-->
                                    <div class="modal fade" id="myModalAtualizarProfessor" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="inserirModalLabel">Atualizar senha</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../../php/php_crud_atualizar/atualizarProfessor.php?idProfessor=<?php echo $exibirProfessor["idProfessor"] ?>" method="post">
                                                        
                                                        <div class="form-group">
                                                            <h6><b>Insira uma nova senha</b></h6>
                                                            <input type="password" class="form-control form-control-user"
                                                            id="txtSenhaProfessor2" name="txtSenhaProfessor2" placeholder="Nova senha">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6><b>Repita a senha inserida</b></h6>
                                                            <input type="password" class="form-control form-control-user"
                                                            id="txtrepetirsenhaProfessor2" name="txtrepetirsenhaProfessor2" placeholder="Repita a senha">
                                                        </div>
                                                        <hr>
                                                        <input type="submit" value="Atualizar senha" class="btn btn-primary btn-icon-split-user">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    </form> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <?php

                    }elseif($_SESSION['usuarioNivelDeAcesso'] == 3) {

                        $sql = "SELECT *
                        FROM Instituicao
                        WHERE IdInstituicao = '{$_SESSION['usuarioId']}'";
                        $Instituicao = $conn->query($sql);
                        $exibirInstituicao = $Instituicao->fetch_assoc();

                        ?>

                        <div class="container-fluid">
                            <h1 class="h3 mb-2 text-gray-800"> Perfil Instituição</h1>
                            <p class="mb-4"></p>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Editar Perfil</h6>
                                </div>
                                <div class="modal-body">
                                    <form action="../../php/php_crud_atualizar/atualizarInstituicao.php?IdInstituicao=<?php echo $exibirInstituicao["IdInstituicao"] ?>" method="post">
                                        <h6><b>Nome Instituição</b></h6>
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $exibirInstituicao["NomeInstituicao"]?>" class="form-control form-control-user" name="txtnomeInstituicao2" id="nomeInstituicao" required aria-describedby="nomeInstituicao"
                                                placeholder="">
                                        </div>
                                        <h6><b>CNPJ</b></h6>
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $exibirInstituicao["CNPJInstituicao"]?>" class="form-control form-control-user" name="txtCNPJdaInstituicao2" id="CNPJdaInstituicao" required aria-describedby="CNPJdaInstituicao"
                                                placeholder="">
                                        </div>
                                        <h6><b>E-mail</b></h6>
                                        <div class="form-group">
                                            <input type="email" value="<?php echo $exibirInstituicao["EmailInstituicao"]?>" class="form-control form-control-user" name="txtemailInstituicao2" id="emailInstituicao" required aria-describedby="emailInstituicao"
                                                placeholder="">
                                        </div>
                                        <hr>
                                        <h4><b>Endereço</b></h4>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <h6><b>Bairro</b></h6>
                                                <input type="text" value="<?php echo $exibirInstituicao["Bairro"]?>" class="form-control form-control-user" name="txtbairroInstituicao2" id="bairroInstituicao" aria-describedby="bairroInstituicao"
                                                placeholder="">
                                            </div>  
                                            <div class="col-sm-6">
                                                <h6><b>Rua</b></h6>
                                                <input type="text" value="<?php echo $exibirInstituicao["Rua"]?>" class="form-control form-control-user" name="txtruaInstituicao2" id="ruaInstituicao" aria-describedby="ruaInstituicao"
                                                placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <h6><b>Estado</b></h6>
                                                <input type="text" value="<?php echo $exibirInstituicao["Estado"]?>" class="form-control form-control-user" name="txtestadoInstituicao2" id="estadoInstituicao" aria-describedby="estadoInstituicao"
                                                placeholder="">
                                            </div> 
                                            <div class="col-sm-6">
                                                <h6><b>Cidade</b></h6>
                                                <input type="text" value="<?php echo $exibirInstituicao["Cidade"]?>" class="form-control form-control-user" name="txtcidadeInstituicao2" id="cidadeInstituicao" aria-describedby="cidadeInstituicao"
                                                placeholder="">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <div class="col-sm-6 mb-3 mb-sm-0">
                                                <h6><b>Número Residencial</b></h6>
                                                <input type="text" value="<?php echo $exibirInstituicao["NumeroResidencial"]?>" class="form-control form-control-user" name="txtnumeroInstituicao2"  id="numeroInstituicao" aria-describedby="numeroInstituicao"
                                                placeholder="">
                                            </div>
                                            <div class="col-sm-6">
                                                <h6><b>CEP</b></h6>
                                                <input type="text" value="<?php echo $exibirInstituicao["CEP"]?>" class="form-control form-control-user" name="txtCEPdaInstituicao2" id="CEPdaInstituicao" aria-describedby="CEPdaInstituicao"
                                                placeholder="">
                                            </div>
                                        </div>
                                        <hr>
                                        <h6><b>Telefone</b></h6>
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $exibirInstituicao["ContatoInstituicao"]?>" class="form-control form-control-user" name="txtcontatoInstituicao2" id="contatoInstituicao" required aria-describedby="contatoInstituicao"
                                                placeholder="">
                                        </div>
                                        <hr>
                                        <input type="submit" value="Atualizar instituição" class="btn btn-primary btn-icon-split-user">
                                        <button type="button" class="btn btn-info btn-xs dt-edit" data-toggle="modal" data-target="#myModalAtualizarInstituicao" style="margin-right:16px;">
                                            Atualizar senha
                                        </button>
                                    </form> 

                                    <!-- Atualizar Modal-->
                                    <div class="modal fade" id="myModalAtualizarInstituicao" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="inserirModalLabel">Atualizar senha</h5>
                                                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../../php/php_crud_atualizar/atualizarInstituicao.php?IdInstituicao=<?php echo $exibirInstituicao["IdInstituicao"] ?>" method="post">
                                                        
                                                        <div class="form-group">
                                                            <h6><b>Insira uma nova senha</b></h6>
                                                            <input type="password" value="" class="form-control form-control-user" name="txtsenhaInstituicao2" id="txtsenhaInstituicao2" aria-describedby="senhaInstituicao"
                                                            placeholder="Nova senha">
                                                        </div>
                                                        <div class="form-group">
                                                            <h6><b>Repita a senha inserida</b></h6>
                                                            <input type="password" value="" class="form-control form-control-user" name="txtrepetirsenhaInstituicao2" id="txtrepetirsenhaInstituicao2" aria-describedby="senhaInstituicao"
                                                            placeholder="Repita a senha">
                                                        </div>
                                                        <hr>
                                                        <input type="submit" value="Atualizar senha" class="btn btn-primary btn-icon-split-user">
                                                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                    </form> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <?php

                    }elseif($_SESSION['usuarioNivelDeAcesso'] == 4) {
                        $sql = "SELECT *
                        FROM Administrador
                        WHERE idAdministrador = '{$_SESSION['usuarioId']}'";
                        $Administrador = $conn->query($sql);
                        $exibirAdministrador = $Administrador->fetch_assoc();

                        ?>

                        <div class="container-fluid">
                            <h1 class="h3 mb-2 text-gray-800"> Perfil Administrador</h1>
                            <p class="mb-4"></p>

                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-gray-800">Editar Perfil</h6>
                                </div>
                                <div class="modal-body">
                                    <form action="../../php/php_crud_atualizar/atualizarAdministrador.php?idAdministrador=<?php echo $exibirAdministrador["idAdministrador"] ?>" method="post">
                                        
                                        <label>Nome completo</label>
                                        <div class="form-group">
                                            <input type="text" value="<?php echo $exibirAdministrador["NomeAdministrador"]?>" class="form-control form-control-user" name="txtnomeAdministrador2" id="txtnomeAdministrador" aria-describedby="nomeAdministrador" required placeholder="">
                                        </div>
                                        <label>E-mail Administrador</label>
                                        <div class="form-group">
                                            <input type="email" value="<?php echo $exibirAdministrador["EmailAdministrador"]?>" class="form-control form-control-user" name="txtemailAdministrador2" id="txtemailAdministrador" aria-describedby="emailAdministrador"  required placeholder="">
                                        </div>
                                        <label>Senha Administrador</label>
                                        <div class="form-group">
                                            <input type="password" value="" class="form-control form-control-user" name="txtsenhaAdministrador2" id="txtsenhaAdministrador" aria-describedby="senhaAdministrador" placeholder="Insira uma senha caso deseje alterá-la">
                                        </div>
                                        
                                        <hr>
                                        <input type="submit" value="Atualizar administrador" class="btn btn-primary btn-icon-split-user">
                                    </form> 
                                </div>
                            </div>
                        </div>

                        <?php

                    }else{
                        header("Location: ../../php/sair.php");
                        exit;
                    }
                ?>

                <!-- Códigos de edição -->
                <!-- <div class="content">
                    <div class="container-fluid">
                        <h1 class="h3 mb-2 text-gray-800"> Perfil</h1>
                        <p class="mb-4"></p>
                        <div class="row">
                            <div class="col-md-8">
                                <div class="card">
                                    <div class="card-header">
                                        <h4 class="card-title">Editar Perfil</h4>
                                    </div>
                                    <div class="card-body">
                                        <form>
                                            <div class="row">
                                                <div class="col-md-5 pr-1">
                                                    <div class="form-group">
                                                        <label>E-mail</label>
                                                        <input type="email" class="form-control" disabled="" placeholder="Company" value="<?php echo "{$_SESSION['usuarioEmail']}" ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3 px-1">
                                                    <div class="form-group">
                                                        <label>Username</label>
                                                        <input type="text" class="form-control" placeholder="Username" value="<?php echo "{$_SESSION['usuarioId']}" ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 pl-1">
                                                    <div class="form-group">
                                                        <label for="exampleInputEmail1">Email address</label>
                                                        <input type="email" class="form-control" placeholder="Email">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6 pr-1">
                                                    <div class="form-group">
                                                        <label>First Name</label>
                                                        <input type="text" class="form-control" placeholder="Company" value="<?php echo "{$_SESSION['usuarioNivelDeAcesso']}" ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 pl-1">
                                                    <div class="form-group">
                                                        <label>Last Name</label>
                                                        <input type="text" class="form-control" placeholder="Last Name" value="Andrew">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Address</label>
                                                        <input type="text" class="form-control" placeholder="Home Address" value="Bld Mihail Kogalniceanu, nr. 8 Bl 1, Sc 1, Ap 09">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4 pr-1">
                                                    <div class="form-group">
                                                        <label>City</label>
                                                        <input type="text" class="form-control" placeholder="City" value="Mike">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 px-1">
                                                    <div class="form-group">
                                                        <label>Country</label>
                                                        <input type="text" class="form-control" placeholder="Country" value="Andrew">
                                                    </div>
                                                </div>
                                                <div class="col-md-4 pl-1">
                                                    <div class="form-group">
                                                        <label>Postal Code</label>
                                                        <input type="number" class="form-control" placeholder="ZIP Code">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>About Me</label>
                                                        <textarea rows="4" cols="80" class="form-control" placeholder="Here can be your description" value="Mike">Lamborghini Mercy, Your chick she so thirsty, I'm in that two seat Lambo.</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-info btn-fill pull-right">Update Profile</button>
                                            <div class="clearfix"></div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card card-user">
                                    <div class="card-image">
                                        <img src="https://ununsplash.imgix.net/photo-1431578500526-4d9613015464?fit=crop&fm=jpg&h=300&q=75&w=400" alt="...">
                                    </div>
                                    <div class="card-body">
                                        <div class="author">
                                            <a href="#">
                                                <img class="avatar border-gray" src="../assets/img/faces/face-3.jpg" alt="...">
                                                <h5 class="title">Mike Andrew</h5>
                                            </a>
                                            <p class="description">
                                                michael24
                                            </p>
                                        </div>
                                        <p class="description text-center">
                                            "Lamborghini Mercy
                                            <br> Your chick she so thirsty
                                            <br> I'm in that two seat Lambo"
                                        </p>
                                    </div>
                                    <hr>
                                    <div class="button-container mr-auto ml-auto">
                                        <button href="#" class="btn btn-simple btn-link btn-icon">
                                            <i class="fa fa-facebook-square"></i>
                                        </button>
                                        <button href="#" class="btn btn-simple btn-link btn-icon">
                                            <i class="fa fa-twitter"></i>
                                        </button>
                                        <button href="#" class="btn btn-simple btn-link btn-icon">
                                            <i class="fa fa-google-plus-square"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <footer class="footer">
                    <div class="container-fluid">
                        <nav>
                            <ul class="footer-menu">
                                <li>
                                    <a href="#">
                                        Home
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Company
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Portfolio
                                    </a>
                                </li>
                                <li>
                                    <a href="#">
                                        Blog
                                    </a>
                                </li>
                            </ul>
                            <p class="copyright text-center">
                                ©
                                <script>
                                    document.write(new Date().getFullYear())
                                </script>
                                <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                            </p>
                        </nav>
                    </div>
                </footer>
            </div> -->
            <!-- End of Main Content -->

        </div>
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