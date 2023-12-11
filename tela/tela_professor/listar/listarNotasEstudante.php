<?php
    session_start();
    include_once("../../../php/conexao.php");
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: ../../../php/sair.php");
        exit;
    }else{
        if($_SESSION['usuarioNivelDeAcesso'] != '2'){
            // Usuário sem acesso! Redireciona para a página anterior
            header("Location: ../../tela_inicial/menu.php");
            exit;
        }
    }

    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];
    $qtd_result_pg = $_POST["qtd_result_pg"];

    $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;

    $sqlProfessor = "SELECT *
    FROM Professor
    WHERE idProfessor = '{$_SESSION['usuarioId']}'";
    $Professor = $conn->query($sqlProfessor);
    $exibirProfessor = $Professor->fetch_assoc();

    $idProfessor = $exibirProfessor["idProfessor"];
    $NomeProfessor = $exibirProfessor["NomeProfessor"];
    $EmailProfessor = $exibirProfessor["EmailProfessor"];
    $ContatoProfessor = $exibirProfessor["ContatoProfessor"];
    $InstituicaoProfessor_IdInstituicao = $exibirProfessor["InstituicaoProfessor_IdInstituicao"];

    
    $idEtapa = $_SESSION['idEtapa'];
    $idMateria = $_SESSION['idMateria'];
    $idProva = $_SESSION['idProva'];

    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];
    $qtd_result_pg = $_POST["qtd_result_pg"];

    $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;

    if(isset($_SESSION['registradoInseridoComSucesso'])){
        ?>
        <div class="alert hide alert-success">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Nota registrada no estudante</span>
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
            <span class="msg">Nota do estudante atualizada</span>
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
            <span class="msg">Nota deletada do estudante</span>
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
            <span class="msg">Erro ao inserir nota do estudante</span>
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
            <span class="msg">Erro ao atualizar nota do estudante</span>
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
            <span class="msg">Erro ao deletar nota do estudante</span>
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
                $sqlMateria = "SELECT * FROM Materia WHERE idMateria = $idMateria ";
                $Materia = $conn->query($sqlMateria);
                $exibirMateria = $Materia->fetch_assoc();
                $NomeMateria = $exibirMateria["NomeMateria"];
                $IdadeEscolarMateria = $exibirMateria["IdadeEscolarMateria"];

                $sqlEtapa = "SELECT * FROM Etapa WHERE idEtapa = $idEtapa ";
                $Etapa = $conn->query($sqlEtapa);
                $exibirEtapa = $Etapa->fetch_assoc();
                $AnoEtapa = $exibirEtapa["AnoEtapa"];
                $NomeEtapa = $exibirEtapa["NomeEtapa"];

                $sqlProva = "SELECT * FROM Prova WHERE idProva = '$idProva'";
                $Prova = $conn->query($sqlProva);
                $exibirProva = $Prova->fetch_assoc();
                $NomeProva = $exibirProva["NomeProva"];

                $sqlProfessor="SELECT * FROM Professor Where idProfessor={$_SESSION['usuarioId']}";
                $Professor=$conn->query($sqlProfessor);
                $exibirProfessor = $Professor->fetch_assoc();
                $InstituicaoProfessor_IdInstituicao=$exibirProfessor["InstituicaoProfessor_IdInstituicao"]
            ?>
            <p><b>Etapa:</b>&nbsp;<?php echo $NomeEtapa?>&nbsp;-&nbsp;<b>Matéria:</b>&nbsp;<?php echo $NomeMateria ?>, <?php echo $IdadeEscolarMateria ?>&nbsp;-&nbsp;<b>Prova:</b>&nbsp;<?php echo $NomeProva ?></p>

            <div>
                <?php
                $sql = "SELECT * 
                FROM Estudante
                INNER JOIN Materia ON Materia.idMateria=$idMateria
                INNER JOIN Professor ON Professor.idProfessor={$_SESSION['usuarioId']}
                INNER JOIN Etapa ON Etapa.idEtapa=$idEtapa
                WHERE Estudante.AnoLetivoEstudante=$AnoEtapa
                AND Estudante.IdadeEscolarEstudante='$IdadeEscolarMateria'
                AND Estudante.InstituicaoEstudante_IdInstituicao=$InstituicaoProfessor_IdInstituicao
                AND Estudante.NomeEstudante like '%$pesquisa%'
                ORDER BY Estudante.NomeEstudante
                LIMIT $inicio, $qtd_result_pg";

                //executar o comando
                $Estudante = $conn->query($sql);

                if ($Estudante->num_rows >= 0) {
                ?>
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th>Registro Academico</th>
                        <th>Nome</th>
                        <th>Valor</th>
                        <th>Nota Obtida</th>
                        <th>Editar</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <th colspan="5" style="text-align:center;width:100px;">Voltar 
                            <a href="gerenciaNotasProvas.php?idEtapa=<?php echo $idEtapa?>&idMateria=<?php echo $idMateria?>"  type="button" class="btn btn-success btn-xs dt-add">
                                <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                            </a>
                        </th>
                    </tfoot>
                    <?php
                    while ($exibir = $Estudante->fetch_assoc()){
                        $RegistroAcademico = $exibir["RegistroAcademico"];
                        $sqlVerificarEstudante = "SELECT *
                        FROM Estudante_has_Materia
                        WHERE Estudante_RegistroAcademico = '$RegistroAcademico' AND Materia_idMateria = '$idMateria' AND AnoLetivo_EstudanteHasMateria = '$AnoEtapa'";
                        $verificarEstudante = $conn->query($sqlVerificarEstudante);
                        $exibirVerificarEstudante = $verificarEstudante->fetch_assoc();

                        if (isset($exibirVerificarEstudante)){
                            ?>
                            <tbody>
                                <tr>
                                <td><?php echo $exibir["RegistroAcademico"] ?></td>
                                <td><?php echo $exibir["NomeEstudante"] ?> </td>
                                <td><?php echo $exibirProva["ValorProva"] ?> </td>
                                <?php
                                    $sqlNota = "SELECT * FROM Nota WHERE Provas_idProvas = '$idProva' AND Estudante_RegistroAcademico = '$RegistroAcademico'";
                                    $Nota = $conn->query($sqlNota);
                                    $exibirNota = $Nota->fetch_assoc();
                                    if (isset($exibirNota)){
                                        ?>
                                        <td><?php echo $exibirNota["ValorObtido"] ?> </td>
                                        <?php
                                    }else{
                                        ?>
                                        <td></td>
                                        <?php
                                    }
                                ?>
                                    <td>
                                        <button type="button" class="btn btn-primary btn-xs dt-edit" data-toggle="modal" data-target="#myModal<?php echo $exibir["RegistroAcademico"] ?>" style="margin-right:16px;">
                                            <span class="mdi mdi-account-edit"  aria-hidden="true"></span>
                                        </button>
                                        <!-- Atualizar Modal-->
                                        <div class="modal fade" id="myModal<?php echo $exibir["RegistroAcademico"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="inserirModalLabel">Editar nota</h5>
                                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                            <span aria-hidden="true">×</span>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <?php
                                                            if(isset($exibirNota["ValorObtido"])){
                                                                $opcao=1;
                                                            }else{
                                                                $opcao=2;
                                                            }
                                                        ?>
                                                        <form action="<?php echo $opcao==1?"../../php/php_crud_atualizar/atualizarNota.php":"../../php/php_crud_inserir/inserirNota.php"?>" method="post">
                                                            <?php

                                                                if($opcao==1){
                                                                    ?>
                                                                    <h6><b>Valor obtido</b>&nbsp;</h6>
                                                                    <div class="form-group">
                                                                        <input type="text" value="<?php echo $exibirNota["ValorObtido"] ?>" class="form-control form-control-user" name="txtValorObtido" id="ValorObtido" aria-describedby="ValorObtido" placeholder="Insira o valor obtido" >
                                                                    </div>
                                                                    <div hidden class="form-group">
                                                                        <input type="text" value="<?php echo $exibirNota["idNota"] ?>" class="form-control form-control-user" name="txtIdNota" id="IdNota" aria-describedby="IdNota" placeholder="" >
                                                                    </div>
                                                                    <?php
                                                                }else{
                                                                    ?>
                                                                    <h6><b>Insira o valor obtido</b>&nbsp;</h6>
                                                                    <div class="form-group">
                                                                        <input type="text" class="form-control form-control-user" name="txtValorObtido" id="ValorObtido" aria-describedby="ValorObtido" placeholder="Valor obtido" >
                                                                    </div>
                                                                    <div hidden class="form-group">
                                                                        <input type="text" value="<?php echo $idProva ?>"class="form-control form-control-user" name="txtIdProva" id="txtIdProva" aria-describedby="IdProva" placeholder="" >
                                                                    </div>
                                                                    <div hidden class="form-group">
                                                                        <input type="text" value="<?php echo $RegistroAcademico ?>" class="form-control form-control-user" name="txtRegistroAcademico" id="txtRegistroAcademico" aria-describedby="RegistroAcademico" placeholder="" >
                                                                    </div>
                                                                    <?php
                                                                }
                                                            ?>
                                                            <hr>
                                                            <input type="submit" value="Editar nota" class="btn btn-primary btn-icon-split-user">
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
                    }
                    ?>
                </table>
                <?php
                //codigo da paginação
                $sql_qtd_registros = "SELECT count(RegistroAcademico) as num_registros
                FROM Estudante
                INNER JOIN Materia ON Materia.idMateria=$idMateria
                INNER JOIN Estudante_has_Materia ON Estudante_has_Materia.Materia_idMateria=$idMateria
                INNER JOIN Professor ON Professor.idProfessor={$_SESSION['usuarioId']}
                INNER JOIN Etapa ON Etapa.idEtapa=$idEtapa
                WHERE Estudante.AnoLetivoEstudante=$AnoEtapa
                AND Estudante.IdadeEscolarEstudante='$IdadeEscolarMateria'
                AND Estudante.InstituicaoEstudante_IdInstituicao=$InstituicaoProfessor_IdInstituicao
                AND Estudante_has_Materia.Estudante_RegistroAcademico = Estudante.RegistroAcademico
                AND Estudante.NomeEstudante like '%$pesquisa%'";
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

</html>