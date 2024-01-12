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
            <span class="msg">Matéria registrada</span>
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
            <span class="msg">Matéria atualizada</span>
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
            <span class="msg">Matéria deletada</span>
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
            <span class="msg">Erro ao inserir matéria</span>
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
            <span class="msg">Erro ao atualizar matéria</span>
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
            <span class="msg">Erro ao deletar matéria</span>
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
            FROM Materia 
            INNER JOIN Professor ON Professor.idProfessor = Materia.Professor_idProfessor
            WHERE NomeMateria like '%$pesquisa%'
            AND Professor.InstituicaoProfessor_IdInstituicao='{$_SESSION['usuarioId']}'
            ORDER BY NomeMateria
            LIMIT $inicio, $qtd_result_pg";
                                            

            //executar o comando
            $Materia = $conn->query($sql);

            if ($Materia->num_rows >= 0) {
            ?>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>Nome da Matéria</th>
                    <th>Ano Escolar</th>
                    <th>Nome do Professor</th>
                    <th>Editar &nbsp;&nbsp;&nbsp; Deletar</th>
                    </tr>
                </thead>
                <tfoot>
                    <th colspan="5" style="text-align:center;width:100px;">Adicionar matéria <button type="button" data-toggle="modal" data-target="#inserirModal" class="btn btn-success btn-xs dt-add">
                        <span class="mdi mdi-account-plus" aria-hidden="true"></span>
                        </button></th>
                </tfoot>
                <?php
                    while ($exibir = $Materia->fetch_assoc()){
                        $checar = 0;

                        $sql1 = "SELECT idProfessor
                            FROM Professor
                            WHERE InstituicaoProfessor_IdInstituicao = '{$_SESSION['usuarioId']}'";

                        //executar o comando sql
                        $idProfessorConferir = $conn->query($sql1);
                        $idProfessor = $exibir["Professor_idProfessor"];
                        
                        while ($rowIdProfessor= $idProfessorConferir->fetch_assoc()) {
                            if($idProfessor == $rowIdProfessor["idProfessor"]){
                                $checar = 1;
                            }
                        }
                        if($checar == 1){
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $exibir["NomeMateria"] ?></td>
                                <td><?php echo $exibir["IdadeEscolarMateria"] ?></td>
                                <?php
                                    $sqlProfessor = "SELECT NomeProfessor FROM Professor WHERE idProfessor = $idProfessor ";
                                    $Professor = $conn->query($sqlProfessor);
                                    $exibirNomeProfessor = $Professor->fetch_assoc();
                                ?>
                                <td><?php echo $exibirNomeProfessor["NomeProfessor"] ?></td>
                                <td>
                                <?php $id =  $exibir["idMateria"]; ?>
                                    <button type="button" class="btn btn-primary btn-xs dt-edit" data-toggle="modal" data-target="#myModal<?php echo $exibir["idMateria"] ?>" style="margin-right:16px;">
                                        <span class="mdi mdi-account-edit" aria-hidden="true"></span>
                                    </button>
                                    <button type="button" class="btn btn-danger btn-xs dt-delete" data-toggle="modal" data-target="#deletarModal<?php echo $exibir["idMateria"] ?>" >
                                    <span class="mdi mdi-delete" aria-hidden="true"></span>
                                    </button>

                                    <!-- Atualizar Modal-->
                                <div class="modal fade" id="myModal<?php echo $exibir["idMateria"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Atualizar matéria</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../php/php_crud_atualizar/atualizarMateria.php?idMateria=<?php echo $exibir["idMateria"] ?>" method="post">
                                                    <h6><b>Nome matéria</b></h6>
                                                    <div class="form-group">
                                                        <input type="text" value="<?php echo$exibir["NomeMateria"] ?>" class="form-control form-control-user" name="txtnomeMateria2" id="nomeMateria2" aria-describedby="nomeMateria" placeholder="Insira o nome da matéria" >
                                                    </div> 
                                                    <h6><b>Ano escolar</b></h6>
                                                    <div class="form-group">
                                                        <select class="custom-select custom-select-sm form-control form-control-sm" name="opIdadeEscolar2" aria-label=" select example" >
                                                            <option disabled hidden>Selecione o ano escolar</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "1 fundamental")?"selected":"" ?> value="1 fundamental">1° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "2 fundamental")?"selected":"" ?> value="2 fundamental">2° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "3 fundamental")?"selected":"" ?> value="3 fundamental">3° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "4 fundamental")?"selected":"" ?> value="4 fundamental">4° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "5 fundamental")?"selected":"" ?> value="5 fundamental">5° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "6 fundamental")?"selected":"" ?> value="6 fundamental">6° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "7 fundamental")?"selected":"" ?> value="7 fundamental">7° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "8 fundamental")?"selected":"" ?> value="8 fundamental">8° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "9 fundamental")?"selected":"" ?> value="9 fundamental">9° ano fundamental</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "1 médio")?"selected":"" ?> value="1 médio">1° ano médio</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "2 médio")?"selected":"" ?> value="2 médio">2° ano médio</option>
                                                            <option <?php echo($exibir["IdadeEscolarMateria"] == "3 médio")?"selected":"" ?> value="3 médio">3° ano médio</option>
                                                        </select>
                                                    </div>
                                                    <h6><b>Nome professor</b></h6>
                                                    <div class="form-group">
                                                        <select class="custom-select custom-select-sm form-control form-control-sm" name="idProfessorSelect2" id="idProfessorSelect2">
                                                            <option selected disabled hidden>Selecione o professor</option>
                                                            <?php
                                                            //buscar dados do dropdown no BD (tbestcivil)
                                                            //criar o comando sql
                                                            $sql = "SELECT idProfessor,NomeProfessor
                                                                FROM Professor
                                                                WHERE InstituicaoProfessor_IdInstituicao = '{$_SESSION['usuarioId']}'";

                                                            //executar o comando sql
                                                            $idProfessorSelect = $conn->query($sql);
                                                            
                                                            while ($rowIdProfessor= $idProfessorSelect->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $rowIdProfessor["idProfessor"]; ?>" <?php echo($exibir["Professor_idProfessor"] == $rowIdProfessor["idProfessor"])?"selected":"" ?> ><?php echo $rowIdProfessor["NomeProfessor"]; ?></option>
                                                            <?php
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <input type="submit" value="Atualizar matéria" class="btn btn-primary btn-icon-split-user">
                                                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                                </form> 
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Deletar Modal-->
                                <div class="modal fade" id="deletarModal<?php echo $exibir["idMateria"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Deletar matéria</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                            <form action="../../php/php_crud_deletar/deletarMateria.php?idMateria=<?php echo $exibir["idMateria"] ?>" method="post">
                                                <div>
                                                    <h5 class="modal-text">Você confirma que deseja deletar a matéria <b><?php echo $exibir["NomeMateria"]?></b> do <b><?php echo $exibir["IdadeEscolarMateria"] ?></b> ?</h5>
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
                    $checar = 0;
                }
            ?>
        </table>
        <?php
                //codigo da paginação
                
                /*$sql = "SELECT idProfessor,NomeProfessor
                FROM Professor
                WHERE InstituicaoProfessor_IdInstituicao = '{$_SESSION['usuarioId']}'";

                $idProfessorConferir = $conn->query($sql1);
                $idProfessor = $exibir["Professor_idProfessor"];*/

                $sql_qtd_registros = "SELECT count(idMateria) as num_registros
                FROM Materia
                INNER JOIN Professor ON Professor.idProfessor = Materia.Professor_idProfessor
                WHERE NomeMateria like '%$pesquisa%'
                AND Professor.InstituicaoProfessor_IdInstituicao='{$_SESSION['usuarioId']}'";
            }
            
            
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
                    <h5 class="modal-title" id="inserirModalLabel">Inserir uma nova matéria</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../php/php_crud_inserir/inserirMateria.php" method="post">
                        <h6><b>Insira o nome da matéria</b></h6>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtnomeMateria" id="nomeMateria" aria-describedby="nomeMateria" placeholder="Nome da matéria" >
                        </div>
                        <h6><b>Selecione o ano escolar</b></h6>
                        <div class="form-group ">
                            <select class="custom-select custom-select-sm form-control form-control-sm" name="opIdadeEscolar" aria-label=" select example" >
                                <option selected disabled hidden>Ano escolar</option>
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
                        <h6><b>Selecione o professor</b></h6>
                        <div>
                            <select class="custom-select custom-select-sm form-control form-control-sm" name="idProfessorSelect" id="idProfessorSelect">
                                <option selected disabled hidden>Professor</option>
                                <?php
                                //buscar dados do dropdown no BD (tbestcivil)
                                //criar o comando sql
                                $sql = "SELECT idProfessor,NomeProfessor
                                    FROM Professor
                                    WHERE InstituicaoProfessor_IdInstituicao = '{$_SESSION['usuarioId']}'";

                                //executar o comando sql
                                $idProfessorSelect = $conn->query($sql);
                                
                                while ($rowIdProfessor= $idProfessorSelect->fetch_assoc()) {
                                ?>
                                    <option value="<?php echo $rowIdProfessor["idProfessor"]; ?>"><?php echo $rowIdProfessor["NomeProfessor"]; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        <hr>
                        <input type="submit" value="Adicionar matéria" class="btn btn-success btn-icon-split-user">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>  
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    
</body>

</html>