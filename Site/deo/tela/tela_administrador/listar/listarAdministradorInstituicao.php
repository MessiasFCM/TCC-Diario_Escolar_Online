<?php
    session_start();
    include_once("../../../php/conexao.php");
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: ../../../php/sair.php");
        exit;
    }else{
        if($_SESSION['usuarioNivelDeAcesso'] != '4'){
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
            <span class="msg">Instituição registrada</span>
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
            <span class="msg">Instituição atualizada</span>
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
            <span class="msg">Instituição deletada</span>
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
            <span class="msg">Erro ao inserir instituição</span>
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
            <span class="msg">Erro ao atualizar instituição</span>
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
            <span class="msg">Erro ao deletar instituição</span>
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


</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Códigos de edição -->
        <div class="modal-body">
            <?php
            $sql = "SELECT * 
                FROM Instituicao 
                WHERE NomeInstituicao like '%$pesquisa%'
                order by IdInstituicao
                LIMIT $inicio, $qtd_result_pg";
            //executar o comando
            $Instituicao = $conn->query($sql);

            if ($Instituicao->num_rows >= 0) {
            ?>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <th>CNPJ</th>
                    <th>Nome</th>
                    <th>Email</th>                      
                    <th>Editar &nbsp;&nbsp;&nbsp; Deletar</th>
                    </tr>
                </thead>
                <tfoot>
                    <th colspan="7" style="text-align:center;width:100px;">Adicionar instituição <button type="button" data-toggle="modal" data-target="#inserirModal" class="btn btn-success btn-xs dt-add">
                        <span class="mdi mdi-account-plus" aria-hidden="true"></span>
                        </button></th>
                </tfoot>
                <?php
                    while ($exibir = $Instituicao->fetch_assoc()){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $exibir["CNPJInstituicao"] ?> </td>
                            <td><?php echo $exibir["NomeInstituicao"] ?> </td>
                            <td><?php echo $exibir["EmailInstituicao"] ?> </td>
                            <td>
                            <?php $id =  $exibir["IdInstituicao"]; ?>
                                <button type="button" class="btn btn-primary btn-xs dt-edit" data-toggle="modal" data-target="#myModal<?php echo $exibir["IdInstituicao"] ?>" style="margin-right:16px;">
                                    <span class="mdi mdi-account-edit"  aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs dt-delete" data-toggle="modal" data-target="#deletarModal<?php echo $exibir["IdInstituicao"] ?>" >
                                <span class="mdi mdi-delete" aria-hidden="true"></span>
                                </button>

                                <!-- Atualizar Modal-->
                                <div class="modal fade" id="myModal<?php echo $exibir["IdInstituicao"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog modal-lg" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Atualizar instituição</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../php/php_crud_atualizar/atualizarInstituicao.php?IdInstituicao=<?php echo $exibir["IdInstituicao"] ?>" method="post">
                                                    <div class="form-group">
                                                    <input type="text" value="<?php echo $exibir["NomeInstituicao"]?>" class="form-control form-control-user" name="txtnomeInstituicao2" id="nomeInstituicao" aria-describedby="nomeInstituicao"
                                                        placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $exibir["CNPJInstituicao"]?>" class="form-control form-control-user" name="txtCNPJdaInstituicao2" id="CNPJdaInstituicao" aria-describedby="CNPJdaInstituicao"
                                                            placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="email" value="<?php echo $exibir["EmailInstituicao"]?>" class="form-control form-control-user" name="txtemailInstituicao2" id="emailInstituicao" aria-describedby="emailInstituicao"
                                                            placeholder="">
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="password" value="" class="form-control form-control-user" name="txtsenhaInstituicao2" id="senhaInstituicao" aria-describedby="senhaInstituicao"
                                                            placeholder="Insira uma senha caso deseje alterá-la">
                                                    </div>
                                                    <hr>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <input type="text" value="<?php echo $exibir["Bairro"]?>" class="form-control form-control-user" name="txtbairroInstituicao2" id="bairroInstituicao" aria-describedby="bairroInstituicao"
                                                            placeholder="">
                                                        </div>  
                                                        <div class="col-sm-6">
                                                            <input type="text" value="<?php echo $exibir["Rua"]?>" class="form-control form-control-user" name="txtruaInstituicao2" id="ruaInstituicao" aria-describedby="ruaInstituicao"
                                                            placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <input type="text" value="<?php echo $exibir["Estado"]?>" class="form-control form-control-user" name="txtestadoInstituicao2" id="estadoInstituicao" aria-describedby="estadoInstituicao"
                                                            placeholder="">
                                                        </div> 
                                                        <div class="col-sm-6">
                                                            <input type="text" value="<?php echo $exibir["Cidade"]?>" class="form-control form-control-user" name="txtcidadeInstituicao2" id="cidadeInstituicao" aria-describedby="cidadeInstituicao"
                                                            placeholder="">
                                                        </div>
                                                    </div>
                                                    <div class="form-group row">
                                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                                            <input type="text" value="<?php echo $exibir["NumeroResidencial"]?>" class="form-control form-control-user" name="txtnumeroInstituicao2"  id="numeroInstituicao" aria-describedby="numeroInstituicao"
                                                            placeholder="">
                                                        </div>
                                                        <div class="col-sm-6">
                                                            <input type="text" value="<?php echo $exibir["CEP"]?>" class="form-control form-control-user" name="txtCEPdaInstituicao2" id="CEPdaInstituicao" aria-describedby="CEPdaInstituicao"
                                                            placeholder="">
                                                        </div>
                                                    </div>
                                                    <hr>
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $exibir["ContatoInstituicao"]?>" class="form-control form-control-user" name="txtcontatoInstituicao2" id="contatoInstituicao" aria-describedby="contatoInstituicao"
                                                            placeholder="">
                                                    </div>
                                                    <hr>
                                                    <input type="submit" value="Atualizar instituição" class="btn btn-primary btn-icon-split-user">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deletar Modal-->
                                <div class="modal fade" id="deletarModal<?php echo $exibir["IdInstituicao"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Deletar instituição</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="../../php/php_crud_deletar/deletarInstituicao.php?IdInstituicao=<?php echo $exibir["IdInstituicao"] ?>" method="post">
                                                <div>
                                                    <h5 class="modal-text">Você confirma que deseja deletar a instituição <b><?php echo $exibir["NomeInstituicao"] ?></b> ?</h5>
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
                $sql_qtd_registros = "SELECT count(IdInstituicao) as num_registros
                FROM Instituicao
                WHERE NomeInstituicao like '%$pesquisa%'
                order by NomeInstituicao";
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

    <!-- Inserir Modal-->
    <div class="modal fade" id="inserirModal" tabindex="-1" role="dialog" aria-labelledby="inserirModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inserirModalLabel">Inserir um novo instituição</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                <form action="../../php/php_crud_inserir/inserirInstituicao.php?IdInstituicao" method="post">
                        <div class="form-group">
                        <input type="text" class="form-control form-control-user" name="txtnomeInstituicao" id="nomeInstituicao" aria-describedby="nomeInstituicao"
                            placeholder="Insira o nome da instituição">
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtCNPJdaInstituicao" id="CNPJdaInstituicao" aria-describedby="CNPJdaInstituicao"
                                placeholder="Insira o CNPJ da instituição">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="txtemailInstituicao" id="emailInstituicao" aria-describedby="emailInstituicao"
                                placeholder="Insira o Email da instituição">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="txtsenhaInstituicao" id="senhaInstituicao" aria-describedby="senhaInstituicao"
                                placeholder="Insira a senha da instituição">
                        </div>
                        <hr>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="txtbairroInstituicao" id="bairroInstituicao" aria-describedby="bairroInstituicao"
                                placeholder="Insira o bairro da instituição">
                            </div>
                            <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="txtruaInstituicao" id="ruaInstituicao" aria-describedby="ruaInstituicao"
                                    placeholder="Insira a rua da instituição">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="txtestadoInstituicao" id="estadoInstituicao" aria-describedby="estadoInstituicao"
                                placeholder="Insira o estado da instituição">
                            </div>
                            <div class="col-sm-6">
                                    <input type="text" class="form-control form-control-user" name="txtcidadeInstituicao" id="cidadeInstituicao" aria-describedby="cidadeInstituicao"
                                    placeholder="Insira a cidade da instituição">
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="col-sm-6 mb-3 mb-sm-0">
                                <input type="text" class="form-control form-control-user" name="txtnumeroInstituicao"  id="numeroInstituicao" aria-describedby="numeroInstituicao"
                                placeholder="Insira o número residencial da instituição">
                            </div>
                            <div class="col-sm-6">
                                <input type="text" class="form-control form-control-user" name="txtCEPdaInstituicao" id="CEPdaInstituicao" aria-describedby="CEPdaInstituicao"
                                placeholder="Insira o CEP da instituição">
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtcontatoInstituicao" id="contatoInstituicao" aria-describedby="contatoInstituicao"
                                placeholder="Insira o contato da instituição">
                        </div>
                        <hr>
                        <input type="submit" value="Inserir instituição" class="btn btn-success btn-icon-split-user">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>  
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->


</body>

</html>