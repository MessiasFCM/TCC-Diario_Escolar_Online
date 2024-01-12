<?php
    session_start();
    include_once("../../../php/conexao.php");
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: ../../../php/sair.php");
        exit;
    }else{
        if($_SESSION['usuarioNivelDeAcesso'] != '3'){
            // Usuário sem acesso! Redireciona para a página anterior
            header("Location: ../../tela_inicial/menu.php");
            exit;
        }
    }
    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];
    $qtd_result_pg = $_POST["qtd_result_pg"];

    $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;

    if(isset($_SESSION['registradoInseridoComSucesso'])){
        ?>
        <div class="alert hide alert-success">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Etapa registrada</span>
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
        unset($_SESSION['registradoInseridoComSucesso']);
    }
    if(isset($_SESSION['registradoAtualizadoComSucesso'])){
        ?>
        <div class="alert hide alert-success">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Etapa atualizada</span>
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
    if(isset($_SESSION['registradoDeletadoComSucesso'])){
        ?>
        <div class="alert hide alert-success">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Etapa deletada</span>
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
        unset($_SESSION['registradoDeletadoComSucesso']);
    }
    if(isset($_SESSION['erroInserir'])){
        ?>
        <div class="alert hide alert-danger">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Erro ao inserir etapa</span>
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
        unset($_SESSION['erroInserir']);
    }
    if(isset($_SESSION['erroAtualizar'])){
        ?>
        <div class="alert hide alert-danger">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Erro ao atualizar etapa</span>
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
    if(isset($_SESSION['erroDeletar'])){
        ?>
        <div class="alert hide alert-danger">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Erro ao deletar etapa</span>
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
        unset($_SESSION['erroDeletar']);
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
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="modal-body">
            <?php
            $sql = "SELECT * 
                FROM Etapa
                WHERE InstituicaoEtapa_IdInstituicao = '{$_SESSION['usuarioId']}'
                AND AnoEtapa like '%$pesquisa%'
                order by AnoEtapa
                LIMIT $inicio, $qtd_result_pg";
            //executar o comando
            $Etapa = $conn->query($sql);

            if ($Etapa->num_rows >= 0) {
            ?>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>Nome da Etapa</th>
                    <th>Ano da Etapa</th>
                    <th>Início da Etapa</th>
                    <th>Final da Etapa</th>
                    <th>Editar &nbsp;&nbsp;&nbsp; Deletar</th>
                    </tr>
                </thead>
                <tfoot>
                    <th colspan="5" style="text-align:center;width:100px;">Adicionar etapa <button type="button" data-toggle="modal" data-target="#inserirModal" class="btn btn-success btn-xs dt-add">
                        <span class="mdi mdi-account-plus" aria-hidden="true"></span>
                        </button></th>
                </tfoot>
                <?php
                    while ($exibir = $Etapa->fetch_assoc()){
                        $dataFormatadaInicio = date('d/m/Y', strtotime($exibir["InicioEtapa"]));
                        $dataFormatadaFinal = date('d/m/Y', strtotime($exibir["FinalEtapa"]));
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $exibir["NomeEtapa"] ?></td>
                            <td><?php echo $exibir["AnoEtapa"] ?> </td>
                            <td><?php echo $dataFormatadaInicio ?> </td>
                            <td><?php echo $dataFormatadaFinal ?> </td>
                            <td>
                            <?php $idEtapa =  $exibir["idEtapa"]; ?>
                                <button type="button" class="btn btn-primary btn-xs dt-edit" data-toggle="modal" data-target="#myModal<?php echo $exibir["idEtapa"] ?>" style="margin-right:16px;">
                                    <span class="mdi mdi-account-edit"  aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs dt-delete" data-toggle="modal" data-target="#deletarModal<?php echo $exibir["idEtapa"] ?>" >
                                <span class="mdi mdi-delete" aria-hidden="true"></span>
                                </button>

                                <!-- Atualizar Modal-->
                                <div class="modal fade" id="myModal<?php echo $exibir["idEtapa"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Atualizar etapa</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../php/php_crud_atualizar/atualizarEtapa.php?idEtapa=<?php echo $exibir["idEtapa"] ?>" method="post">
                                                    <h6><b>Nome da etapa</b></h6>
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $exibir["NomeEtapa"]?>" class="form-control form-control-user" name="txtnomeEtapa2" id="txtnomeEtapa2" aria-describedby="nomeEtapa" placeholder="Nome da etapa">
                                                    </div>
                                                    <h6><b>Ano da etapa</b></h6>
                                                    <div class="form-group">
                                                        <input type="number" value="<?php echo $exibir["AnoEtapa"]?>" class="form-control form-control-user" name="txtanoEtapa2" id="txtanoEtapa2" aria-describedby="anoEtapa" placeholder="Ano da etapa">
                                                    </div>
                                                    <h6><b>Período inicial</b></h6>
                                                    <div class="form-group">
                                                        <input type="date" value="<?php echo $exibir["InicioEtapa"]?>" class="form-control form-control-user" name="txtinicioEtapa2" id="txtinicioEtapa2" aria-describedby="inicioEtapa" placeholder="Período inicial">
                                                    </div>
                                                    <h6><b>Período final</b></h6>
                                                    <div class="form-group">
                                                        <input type="date" value="<?php echo $exibir["FinalEtapa"]?>" class="form-control form-control-user" name="txtfinalEtapa2" id="txtfinalEtapa2" aria-describedby="finalEtapa" placeholder="Período final">
                                                    </div>
                                                    <hr>
                                                    <input type="submit" value="Atualizar etapa" class="btn btn-primary btn-icon-split-user">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deletar Modal-->
                                <div class="modal fade" id="deletarModal<?php echo $exibir["idEtapa"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Deletar etapa</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="../../php/php_crud_deletar/deletarEtapa.php?idEtapa=<?php echo $exibir["idEtapa"] ?>" method="post">
                                                <div>
                                                    <h5 class="modal-text">Você confirma que deseja deletar a etapa <b><?php echo $exibir["NomeEtapa"] ?></b> do ano <b><?php echo $exibir["AnoEtapa"] ?></b> ?</h5>
                                                </div>
                                                <hr>
                                                <input type="submit" value="Confirmar" class="btn btn-danger btn-icon-split-user">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    }
                ?>
            </table>
            <?php
                //codigo da paginação
                $sql_qtd_registros = "SELECT count(idEtapa) as num_registros
                FROM Etapa
                WHERE InstituicaoEtapa_IdInstituicao = '{$_SESSION['usuarioId']}'
                AND AnoEtapa like '%$pesquisa%'";
            }
            //echo $sql_qtd_registros;
            $result_registros = $conn->query($sql_qtd_registros);
            $qtd_registros = $result_registros->fetch_assoc();

            //echo $sql_qtd_registros;
            //ceil() pega o próximo valor inteiro(faz tipo um arredondamento para cima)
            $qtd_paginas = ceil($qtd_registros["num_registros"] / $qtd_result_pg);
            $max_links = 2; 
            

            echo "<nav aria-label='Paginação de registros'>";
            echo "<ul class='pagination'>";

            echo " <li class='page-item'><a href='#' class='page-link' onclick='listar_registros(1, $qtd_result_pg)'>Primeira</a></li>";
            
            for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                if ($pag_ant >= 1) {
                    echo "<li class='page-item'><a href='#'  class='page-link' onclick='listar_registros($pag_ant, $qtd_result_pg)'> $pag_ant </a></li>";
                }
            }
            echo "<li class='page-link text-dark'> $pagina </li> "; //escreve a página atual

            for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                if ($pag_dep <= $qtd_paginas) {
                    echo "<li class='page-item'><a href='#'  class='page-link' onclick='listar_registros($pag_dep, $qtd_result_pg)'> $pag_dep </a></li>";
                }
            }
            echo "<li class='page-item'><a href='#'  class='page-link' onclick='listar_registros($qtd_paginas, $qtd_result_pg)'>Última</a></li>";
            echo "</ul></nav>"
            ?>
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
    <div class="modal fade" id="inserirModal" tabindex="-1" role="dialog" aria-labelledby="inserirModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inserirModalLabel">Inserir uma nova etapa</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../php/php_crud_inserir/inserirEtapa.php" method="post">
                        <h6><b>Insira o nome da etapa</b></h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtnomeEtapa" id="txtnomeEtapa" aria-describedby="nomeEtapa" placeholder="Nome da etapa">
                        </div>
                        <h6><b>Insira o ano da etapa</b></h6>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="txtanoEtapa" id="txtanoEtapa" aria-describedby="anoEtapa" placeholder="Ano da etapa">
                        </div>
                        <h6><b>Insira o período inicial</b></h6>
                        <div class="form-group">
                            <input type="date" class="form-control form-control-user" name="txtinicioEtapa" id="txtinicioEtapa" aria-describedby="inicioEtapa" placeholder="Período inicial">
                        </div>
                        <h6><b>Insira o período final</b></h6>
                        <div class="form-group">
                            <input type="date" class="form-control form-control-user" name="txtfinalEtapa" id="txtfinalEtapa" aria-describedby="finalEtapa" placeholder="Período final">
                        </div>
                        <hr>
                        <input type="submit" value="Adicionar etapa" class="btn btn-success btn-icon-split-user">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>  
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    

</body>

</html>