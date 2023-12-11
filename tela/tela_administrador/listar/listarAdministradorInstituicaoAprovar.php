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
            <span class="msg">Instituicao aprovada</span>
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
            <span class="msg">Estudante deletado</span>
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
            <span class="msg">Erro ao inserir estudante</span>
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
            <span class="msg">Erro ao deletar estudante</span>
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
                    <th>Aprovar</th>
                    </tr>
                </thead>
                <tfoot>
                        <th colspan="4" style="text-align:center;width:100px;">Voltar 
                            <a href="administrador.php"  type="button" class="btn btn-success btn-xs dt-add">
                                <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                            </a>
                        </th>
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
                                <?php
                                    $id =  $exibir["IdInstituicao"];
                                    $sqlInstituicaoAprovada = "SELECT * 
                                    FROM Instituicao
                                    WHERE IdInstituicao = '$id' AND InstituicaoAprovada = '1'";
                                    $verificarAprovacao = $conn->query($sqlInstituicaoAprovada);
                                    $exibirVerificarAprovacao= $verificarAprovacao->fetch_assoc();

                                    if(isset($exibirVerificarAprovacao)){
                                        $opcao = 1;
                                        ?>
                                        <label class="switch switch-3d switch-primary mr-3">
                                            <input type="checkbox" class="switch-input" checked data-toggle="modal" data-target="#atualizarModal<?php echo $exibir["IdInstituicao"] ?>" data-backdrop="static" data-keyboard="false">
                                            <span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>    
                                        <?php
                                    }else{
                                        $opcao = 0;
                                        ?>
                                        <label class="switch switch-3d switch-primary mr-3">
                                            <input type="checkbox" class="switch-input" data-toggle="modal" data-target="#atualizarModal<?php echo $exibir["IdInstituicao"] ?>" data-backdrop="static" data-keyboard="false">
                                            <span class="switch-label"></span>
                                            <span class="switch-handle"></span>
                                        </label>
                                        <?php
                                    }
                                ?>

                                <!-- Atualizar Modal-->
                                <div class="modal fade" id="atualizarModal<?php echo $exibir["IdInstituicao"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <?php
                                            if($opcao == 1){
                                            ?>
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Desativar Instituição</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="Atualizar()">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../php/php_crud_atualizar/atualizarInstituicao.php?IdInstituicao=<?php echo $exibir["IdInstituicao"] ?>&InstituicaoAprovada=0" method="post">
                                                    <div>
                                                        <h5 class="modal-text">Você confirma que deseja desativar a instituição <b><?php echo $exibir["NomeInstituicao"] ?></b> ?</h5>
                                                    </div>
                                                    <hr>
                                                    <input type="submit" value="Confirmar" class="btn btn-danger btn-icon-split-user">
                                                    <button class="btn btn-secondary" onclick="Atualizar()" type="button" data-dismiss="modal">Cancel</button>
                                                </form>  
                                            </div>
                                            <?php
                                            }else{
                                                ?>
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Aprovar Instituição</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="Atualizar()">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="../../php/php_crud_atualizar/atualizarInstituicao.php?IdInstituicao=<?php echo $exibir["IdInstituicao"] ?>&InstituicaoAprovada=1" method="post">
                                                        <div>
                                                            <h5 class="modal-text">Você confirma que deseja aprovar a instituição <b><?php echo $exibir["NomeInstituicao"] ?></b> ?</h5>
                                                        </div>
                                                        <hr>
                                                        <input type="submit" value="Confirmar" class="btn btn-danger btn-icon-split-user">
                                                        <button class="btn btn-secondary" onclick="Atualizar()" type="button" data-dismiss="modal">Cancel</button>
                                                    </form>  
                                                </div>
                                                <?php
                                            }
                                            ?>
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

    <!-- Bootstrap core JavaScript-->

</body>

<script>
    function Atualizar(){
        window.location = "administradorInstituicaoAprovar.php";
    }
</script>

</html>