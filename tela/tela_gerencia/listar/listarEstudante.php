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

    //calcula o registro de inicio da visualização

    if(isset($_SESSION['registradoInseridoComSucesso'])){
        ?>
        <div class="alert hide alert-success">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Estudante registrado</span>
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
            <span class="msg">Estudante atualizado</span>
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
            <span class="msg">Erro ao atualizar estudante</span>
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

    <!-- Custom fonts for this template-->
    

    
    
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Códigos de edição -->
        <div class="modal-body">
            <?php
            $sql = "SELECT * 
                FROM Estudante 
                WHERE InstituicaoEstudante_IdInstituicao = '{$_SESSION['usuarioId']}'
                AND NomeEstudante like '%$pesquisa%'
                order by NomeEstudante
                LIMIT $inicio, $qtd_result_pg";
            //executar o comando
            $Estudante = $conn->query($sql);
            if ($Estudante->num_rows >= 0) {
            ?>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>Registro Acadêmico</th>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Idade Escolar</th>
                    <th>Editar &nbsp; Matéria &nbsp; Histórico &nbsp; Deletar</th>
                    </tr>
                </thead>
                <tfoot>
                    <th colspan="5" style="text-align:center;width:100px;">Adicionar estudante <button type="button" data-toggle="modal" data-target="#inserirModal" class="btn btn-success btn-xs dt-add">
                        <span class="mdi mdi-account-plus" aria-hidden="true"></span>
                        </button></th>
                </tfoot>
                <?php
                    while ($exibir = $Estudante->fetch_assoc()){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $exibir["RegistroAcademico"] ?></td>
                            <td><?php echo $exibir["NomeEstudante"] ?> </td>
                            <td><?php echo $exibir["EmailEstudante"] ?> </td>
                            <td><?php echo $exibir["IdadeEscolarEstudante"] ?> </td>
                            <td>
                            <?php $RA =  $exibir["RegistroAcademico"]; ?>
                                <button type="button" class="btn btn-primary btn-xs dt-edit" data-toggle="modal" data-target="#myModal<?php echo $exibir["RegistroAcademico"] ?>" style="margin-right:16px;">
                                    <span class="mdi mdi-account-edit"  aria-hidden="true"></span>
                                </button>
                                <a type="button" href="gerenciaEstudanteMateria.php?RegistroAcademico=<?php echo $exibir["RegistroAcademico"] ?>" class="btn btn-success btn-xs dt-edit" style="margin-right:16px;">
                                    <span class="mdi mdi-account-plus"  aria-hidden="true"></span>
                                </a>
                                &nbsp;
                                <a type="button" href="gerenciaEstudanteHistorico.php?RegistroAcademico=<?php echo $exibir["RegistroAcademico"] ?>" class="btn btn-warning btn-xs dt-edit" style="margin-right:16px;">
                                    <span class="mdi mdi-folder-open"  aria-hidden="true"></span>
                                </a>
                                &nbsp;
                                <button type="button" class="btn btn-danger btn-xs dt-delete" data-toggle="modal" data-target="#deletarModal<?php echo $exibir["RegistroAcademico"] ?>" >
                                    <span class="mdi mdi-delete" aria-hidden="true"></span>
                                </button>

                                <!-- Atualizar Modal-->
                                <div class="modal fade" id="myModal<?php echo $exibir["RegistroAcademico"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Atualizar estudante</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../php/php_crud_atualizar/atualizarEstudante.php?RegistroAcademico=<?php echo $exibir["RegistroAcademico"] ?>" method="post">
                                                    <h6><b>Nome completo</b></h6>
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $exibir["NomeEstudante"]?>" class="form-control form-control-user" name="txtnomeCompleto2" id="txtnomeCompleto2" aria-describedby="nomeEstudante" required placeholder="Nome completo">
                                                    </div>
                                                    <h6><b>E-mail</b></h6>
                                                    <div class="form-group">
                                                        <input type="email" value="<?php echo $exibir["EmailEstudante"]?>" class="form-control form-control-user" name="txtemailEstudante2" id="txtemailEstudante2" aria-describedby="emailEstudante"  required placeholder="E-mail">
                                                    </div>
                                                    <!-- <h6><b>Ano letivo</b></h6>
                                                    <div class="form-group">
                                                        <input type="number" value="?php echo $exibir["AnoLetivoEstudante"]?>" class="form-control form-control-user" name="txtanoLetivoEstudante2" id="anoLetivoEstudante2" aria-describedby="anoLetivoEstudante2" placeholder="">
                                                    </div>
                                                    <h6><b>Selecione a idade escolar</b></h6>
                                                    <div class="form-group ">
                                                        <select class="custom-select custom-select-sm form-control form-control-sm" name="opIdadeEscolarEstudante2" aria-label=" select example" >
                                                            <option disabled hidden>Idade escolar</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "1 fundamental")?"selected":"" ?> value="1 fundamental">1° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "2 fundamental")?"selected":"" ?> value="2 fundamental">2° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "3 fundamental")?"selected":"" ?> value="3 fundamental">3° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "4 fundamental")?"selected":"" ?> value="4 fundamental">4° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "5 fundamental")?"selected":"" ?> value="5 fundamental">5° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "6 fundamental")?"selected":"" ?> value="6 fundamental">6° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "7 fundamental")?"selected":"" ?> value="7 fundamental">7° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "8 fundamental")?"selected":"" ?> value="8 fundamental">8° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "9 fundamental")?"selected":"" ?> value="9 fundamental">9° ano fundamental</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "1 médio")?"selected":"" ?> value="1 médio">1° ano médio</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "2 médio")?"selected":"" ?> value="2 médio">2° ano médio</option>
                                                            <option ?php echo($exibir["IdadeEscolarEstudante"] == "3 médio")?"selected":"" ?> value="3 médio">3° ano médio</option>
                                                        </select>
                                                    </div> -->
                                                    <h6><b>Telefone</b></h6>
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo $exibir["TelefoneEstudante"]?>" class="form-control form-control-user" name="txttelefoneEstudante2" id="txttelefoneEstudante2" aria-describedby="telefoneEstudante2"  placeholder="Telefone">
                                                    </div>
                                                    <hr>
                                                    <input type="submit" value="Atualizar estudante" class="btn btn-primary btn-icon-split-user">
                                                    <button type="button" class="btn btn-info btn-xs dt-edit" data-dismiss="modal" data-toggle="modal" data-target="#myModalAtualizarEstudante<?php echo $exibir["RegistroAcademico"] ?>">
                                                        Atualizar senha
                                                    </button>
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deletar Modal-->
                                <div class="modal fade" id="deletarModal<?php echo $exibir["RegistroAcademico"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Deletar estudante</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="../../php/php_crud_deletar/deletarEstudante.php?RegistroAcademico=<?php echo $exibir["RegistroAcademico"] ?>" method="post">
                                                <div>
                                                    <h5 class="modal-text">Você confirma que deseja deletar o(a) estudante <b><?php echo $exibir["NomeEstudante"] ?></b> ?</h5>
                                                </div>
                                                <hr>
                                                <input type="submit" value="Confirmar" class="btn btn-danger btn-icon-split-user">
                                                <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                            </form>  
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Atualizar Modal-->
                                <div class="modal fade" id="myModalAtualizarEstudante<?php echo $exibir["RegistroAcademico"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Atualizar senha</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../php/php_crud_atualizar/atualizarEstudante.php?RegistroAcademico=<?php echo $exibir["RegistroAcademico"] ?>" method="post">
                                                    
                                                    <div class="form-group">
                                                        <h6><b>Insira uma nova senha</b></h6>
                                                        <input type="password" class="form-control form-control-user"
                                                        id="txtsenhaEstudante2" name="txtsenhaEstudante2" required placeholder="Nova senha">
                                                    </div>
                                                    <div class="form-group">
                                                        <h6><b>Repita a senha inserida</b></h6>
                                                        <input type="password" class="form-control form-control-user"
                                                        id="txtrepetirsenhaEstudante2" name="txtrepetirsenhaEstudante2" required placeholder="Repita a senha">
                                                    </div>
                                                    <hr>
                                                    <input type="submit" value="Atualizar senha" class="btn btn-primary btn-icon-split-user">
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
                $sql_qtd_registros = "SELECT count(RegistroAcademico) as num_registros
                FROM Estudante
                WHERE InstituicaoEstudante_IdInstituicao = '{$_SESSION['usuarioId']}'
                AND NomeEstudante like '%$pesquisa%'";
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
    <!-- End of Main Content -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Inserir Modal-->
    <div class="modal fade" id="inserirModal" tabindex="-1" role="dialog" aria-labelledby="inserirModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inserirModalLabel">Inserir um novo estudante</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../php/php_crud_inserir/inserirEstudante.php" method="post">
                        <h6><b>Insira o nome completo</b></h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtnomeCompleto" id="nomeCompleto" aria-describedby="nomeEstudante" required placeholder="Nome completo">
                        </div>
                        <h6><b>Insira o E-mail</b></h6>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="txtemailEstudante" id="emailEstudante" aria-describedby="emailEstudante" required placeholder="E-mail">
                        </div>
                        <h6><b>Insira a senha</b></h6>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="txtsenhaEstudante"  id="senha" required placeholder="Senha">
                        </div>
                        <h6><b>Insira o ano letivo</b></h6>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="txtanoLetivoEstudante" id="anoLetivoEstudante" required aria-describedby="anoLetivoEstudante" placeholder="Ano letivo">
                        </div>
                        <h6><b>Selecione a idade escolar</b></h6>
                        <div class="form-group ">
                            <select class="custom-select custom-select-sm form-control form-control-sm" name="opIdadeEscolarEstudante" required aria-label=" select example" >
                                <option selected disabled hidden>Idade escolar</option>
                                <option value="1 fundamental">1° ano fundamental</option>
                                <option value="2 fundamental">2° ano fundamental</option>
                                <option value="3 fundamental">3° ano fundamental</option>
                                <option value="4 fundamental">4° ano fundamental</option>
                                <option value="5 fundamental">5° ano fundamental</option>
                                <option value="6 fundamental">6° ano fundamental</option>
                                <option value="7 fundamental">7° ano fundamental</option>
                                <option value="8 fundamental">8° ano fundamental</option>
                                <option value="9 fundamental">9° ano fundamental</option>
                                <option value="1 médio">1° ano médio</option>
                                <option value="2 médio">2° ano médio</option>
                                <option value="3 médio">3° ano médio</option>
                            </select>
                        </div>
                        <h6><b>Insira o telefone</b></h6>
                        <div class="form-group ">
                            <input type="text" class="form-control form-control-user" name="txttelefoneEstudante" id="txttelefoneEstudante" aria-describedby="telefoneEstudante"  placeholder="Telefone">
                        </div>
                        <hr>
                        <input type="submit" value="Adicionar estudante" class="btn btn-success btn-icon-split-user">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>  
                </div>
                
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    
</body>

</html>