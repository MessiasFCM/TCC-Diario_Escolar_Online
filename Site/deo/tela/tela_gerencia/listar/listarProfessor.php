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
            <span class="msg">Professor registrado</span>
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
            <span class="msg">Professor atualizado</span>
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
            <span class="msg">Professor deletado</span>
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
            <span class="msg">Erro ao inserir professor</span>
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
            <span class="msg">Erro ao atualizar professor</span>
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
            <span class="msg">Erro ao deletar professor</span>
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
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <title>Diário Escolar Online</title>

    <!-- Custom fonts for this template-->
    

</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">
        <div class="modal-body">
            <?php
            $sql = "SELECT * 
                FROM Professor 
                WHERE InstituicaoProfessor_IdInstituicao = '{$_SESSION['usuarioId']}' 
                AND NomeProfessor like '%$pesquisa%'
                order by NomeProfessor
                LIMIT $inicio, $qtd_result_pg";

            //executar o comando
            $Professor = $conn->query($sql);

            if ($Professor->num_rows >= 0) {
            ?>
            <table id="datatable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Contato</th>
                    <th>Editar &nbsp;&nbsp;&nbsp; Deletar</th>
                    </tr>
                </thead>
                <tfoot>
                    <th colspan="5" style="text-align:center;width:100px;">Adicionar professor <button type="button" data-toggle="modal" data-target="#inserirModal" class="btn btn-success btn-xs dt-add">
                        <span class="mdi mdi-account-plus" aria-hidden="true"></span>
                        </button></th>
                </tfoot>
                <?php
                    while ($exibir = $Professor->fetch_assoc()){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $exibir["NomeProfessor"] ?> </td>
                            <td><?php echo $exibir["EmailProfessor"] ?> </td>
                            <td><?php echo $exibir["ContatoProfessor"] ?> </td>
                            <td>
                            <?php $id =  $exibir["idProfessor"]; ?>
                                <button type="button" class="btn btn-primary btn-xs dt-edit" data-toggle="modal" data-target="#myModal<?php echo $exibir["idProfessor"] ?>" style="margin-right:16px;">
                                    <span class="mdi mdi-account-edit"  aria-hidden="true"></span>
                                </button>
                                <button type="button" class="btn btn-danger btn-xs dt-delete" data-toggle="modal" data-target="#deletarModal<?php echo $exibir["idProfessor"] ?>" >
                                <span class="mdi mdi-delete" aria-hidden="true"></span>
                                </button>

                                <!-- Atualizar Modal-->
                            <div class="modal fade" id="myModal<?php echo $exibir["idProfessor"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="inserirModalLabel">Atualizar professor</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="../../php/php_crud_atualizar/atualizarProfessor.php?idProfessor=<?php echo $exibir["idProfessor"] ?>" method="post">
                                                
                                                <h6><b>Nome professor</b></h6>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $exibir["NomeProfessor"]?>" class="form-control form-control-user" name="txtNomeProfessor2" id="txtNomeProfessor2" aria-describedby="nomeProfessor" required placeholder="">
                                                </div>
                                                <h6><b>E-mail</b></h6>
                                                <div class="form-group">
                                                    <input type="email" value="<?php echo $exibir["EmailProfessor"]?>" class="form-control form-control-user" name="txtEmailProfessor2" id="txtEmailProfessor2" aria-describedby="emailProfessor"  required placeholder="">
                                                </div>
                                                <h6><b>Telefone</b></h6>
                                                <div class="form-group">
                                                    <input type="text" value="<?php echo $exibir["ContatoProfessor"]?>" class="form-control form-control-user" name="txtContatoProfessor2" id="txtContatoProfessor2" aria-describedby="contatoProfessor" placeholder="">
                                                </div>
                                                <hr>
                                                <input type="submit" value="Atualizar professor" class="btn btn-primary btn-icon-split-user">
                                                <button type="button" class="btn btn-info btn-xs dt-edit" data-dismiss="modal" data-toggle="modal" data-target="#myModalAtualizarProfessor">
                                                    Atualizar senha
                                                </button>
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            </form> 
                                        </div>
                                    </div>
                                </div>
                            </div>

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
                                            <form action="../../php/php_crud_atualizar/atualizarProfessor.php?idProfessor=<?php echo $exibir["idProfessor"] ?>" method="post">
                                                
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

                            <!-- Deletar Modal-->
                            <div class="modal fade" id="deletarModal<?php echo $exibir["idProfessor"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="inserirModalLabel">Deletar professor</h5>
                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">×</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                        <form action="../../php/php_crud_deletar/deletarProfessor.php?idProfessor=<?php echo $exibir["idProfessor"] ?>" method="post">
                                            <div>
                                                <h5 class="modal-text">Você confirma que deseja deletar o(a) professor(a) <b><?php echo $exibir["NomeProfessor"] ?></b> ?</h5>
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
            $sql_qtd_registros = "SELECT count(idProfessor) as num_registros
            FROM Professor
            WHERE InstituicaoProfessor_IdInstituicao = '{$_SESSION['usuarioId']}'
            AND NomeProfessor like '%$pesquisa%'";
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

        echo " <li class='page-item'><a href='#primeira' class='page-link' onclick='listar_registros(1, $qtd_result_pg)'>Primeira</a></li>";
        
        for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
            if ($pag_ant >= 1) {
                echo "<li class='page-item'><a href='#pag'  class='page-link' onclick='listar_registros($pag_ant, $qtd_result_pg)'> $pag_ant </a></li>";
        }
        }
        echo "<li class='page-link text-dark'> $pagina </li> "; //escreve a página atual

        for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
            if ($pag_dep <= $qtd_paginas) {
                echo "<li class='page-item'><a href='#pag'  class='page-link' onclick='listar_registros($pag_dep, $qtd_result_pg)'> $pag_dep </a></li>";
            }
        }
        echo "<li class='page-item'><a href='#ultima'  class='page-link' onclick='listar_registros($qtd_paginas, $qtd_result_pg)'>Última</a></li>";
        echo "</ul></nav>"
        ?>
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
                    <h5 class="modal-title" id="inserirModalLabel">Inserir um novo professor</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../php/php_crud_inserir/inserirProfessor.php" method="post">
                        <h6><b>Insira o nome completo</b></h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtnomeProfessor" id="txtnomeProfessor" aria-describedby="nomeProfessor" placeholder="Nome completo">
                        </div>
                        <h6><b>Insira o E-mail</b></h6>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="txtemailProfessor" id="txtemailProfessor" aria-describedby="emailProfessor" placeholder="E-mail">
                        </div>
                        <h6><b>Insira o telefone</b></h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtContatoProfessor" id="txtContatoProfessor" aria-describedby="contatoProfessor" placeholder="Telefone">
                        </div>
                        <h6><b>Insira a senha</b></h6>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="txtsenhaProfessor"  id="senhaProfessor" placeholder="Senha">
                        </div>
                        <hr>
                        <input type="submit" value="Adicionar professor" class="btn btn-success btn-icon-split-user">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>  
                </div>
            </div>
        </div>
    </div>


    <!-- Bootstrap core JavaScript-->
    

</body>

</html>