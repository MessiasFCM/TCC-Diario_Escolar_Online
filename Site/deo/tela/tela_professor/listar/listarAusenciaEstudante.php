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

    if (isset($_SESSION["idEtapa"]) && isset($_SESSION["idMateria"]) && isset($_SESSION ["data"])) {
        $idEtapa = $_SESSION['idEtapa'];
        $idMateria = $_SESSION['idMateria'];
        $data = $_SESSION['data'];
    }else{
        $idEtapa = $_SESSION['idEtapaSelect'];
        $idMateria = $_SESSION['idMateriaSelect'];
        $data = $_SESSION['txtDataAusencia'];
    }
    
    
    
    $dataFormatada = date('d/m/Y', strtotime($data));

    if(isset($_SESSION['registradoInseridoComSucesso'])){
        ?>
        <div class="alert hide alert-success">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Ausência registrada no estudante</span>
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
            <span class="msg">Ausência do estudante atualizada</span>
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
            <span class="msg">Ausência deletada do estudante</span>
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
            <span class="msg">Erro ao inserir ausência ao estudante</span>
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
            <span class="msg">Erro ao atualizar ausência do estudante</span>
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
            <span class="msg">Erro ao deletar ausência do estudante</span>
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
            ?>
            <p><b>Etapa:</b>&nbsp;<?php echo $NomeEtapa?>&nbsp;-&nbsp;<b>Ano letivo:</b>&nbsp;<?php echo $AnoEtapa?>&nbsp;-&nbsp;<b>Matéria:</b>&nbsp;<?php echo $NomeMateria ?>&nbsp;-&nbsp;<b>Série:</b>&nbsp;<?php echo $IdadeEscolarMateria ?>&nbsp;-&nbsp;<b>Dia:</b>&nbsp;<?php echo $dataFormatada ?></p>

            <div>
                <?php
                $sqlEstudante = "SELECT * 
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
                
                $sqlAusencia = "SELECT * 
                FROM Ausencia 
                WHERE DataAusencia = '$data' AND Etapa_idEtapa = '$idEtapa' AND Materias_idMateria = '$idMateria'
                order by idAusencia";

                //executar o comando
                $Estudante = $conn->query($sqlEstudante);
                $exibirAusencia = $conn -> query($sqlAusencia);

                if (true){
                    if ($Estudante->num_rows >= 0) {
                        ?>
                        <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                            <thead>
                                <tr>
                                    <th>Registro Academico</th>
                                    <th>Nome</th>
                                    <th>Ausente</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <th colspan="3" style="text-align:center;width:100px;">Voltar 
                                    <a href="gerenciaAusencia.php"  type="button" class="btn btn-success btn-xs dt-add">
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
                                        <td>
                                            <?php
                                                $sqlVerificarAusencia = "SELECT * 
                                                FROM Ausencia
                                                WHERE Estudante_RegistroAcademico = '$RegistroAcademico' AND Materias_idMateria = '$idMateria' AND DataAusencia = '$data' AND Etapa_idEtapa = '$idEtapa'";
                                                $verificarAusencia = $conn->query($sqlVerificarAusencia);
                                                $exibirVerificarAusencia= $verificarAusencia->fetch_assoc();

                                                if(isset($exibirVerificarAusencia)){
                                                    $opcao = 1;
                                                    ?>
                                                    <label class="switch switch-3d switch-primary mr-3">
                                                        <input type="checkbox" class="switch-input" checked data-toggle="modal" data-target="#atualizarModal<?php echo $exibir["RegistroAcademico"] ?>" data-backdrop="static" data-keyboard="false">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>    
                                                    <?php
                                                }else{
                                                    $opcao = 0;
                                                    ?>
                                                    <label class="switch switch-3d switch-primary mr-3">
                                                        <input type="checkbox" class="switch-input" data-toggle="modal" data-target="#atualizarModal<?php echo $exibir["RegistroAcademico"] ?>" data-backdrop="static" data-keyboard="false">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                    <?php
                                                }
                                            ?>

                                            <!-- Atualizar Modal-->
                                            <div class="modal fade" id="atualizarModal<?php echo $exibir["RegistroAcademico"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <?php
                                                        if($opcao == 1){
                                                        ?>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="inserirModalLabel">Retirar ausência</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="Atualizar()">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../../php/php_crud_deletar/deletarAusencia.php?idAusencia=<?php echo $exibirVerificarAusencia["idAusencia"]?>&Etapa_idEtapa=<?php echo $idEtapa?>&DataAusencia=<?php echo $data?>&Materias_idMateria=<?php echo $idMateria?>" method="post">
                                                                <div>
                                                                    <h5 class="modal-text">Você confirma que deseja retirar a ausência de <b><?php echo $exibir["NomeEstudante"] ?></b> ?</h5>
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
                                                            <h5 class="modal-title" id="inserirModalLabel">Adicionar ausência</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="Atualizar()">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../../php/php_crud_inserir/inserirAusencia.php?DataAusencia=<?php echo $data?>&Etapa_idEtapa=<?php echo $idEtapa?>&Estudante_RegistroAcademico=<?php echo $RegistroAcademico?>&Materias_idMateria=<?php echo $idMateria?>" method="post">
                                                                    <div>
                                                                        <h5 class="modal-text">Você confirma que deseja adicionar ausência no(a) <b><?php echo $exibir["NomeEstudante"] ?></b> ?</h5>
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
                            }
                        }
                        ?>
                    </table>
                    <?php
                    //codigo da paginação
                        $sql_qtd_registros = "SELECT count(RegistroAcademico) as num_registros
                        FROM Estudante
                        INNER JOIN Materia ON Materia.idMateria=$idMateria
                        INNER JOIN Professor ON Professor.idProfessor={$_SESSION['usuarioId']}
                        INNER JOIN Etapa ON Etapa.idEtapa=$idEtapa
                        WHERE Estudante.AnoLetivoEstudante=$AnoEtapa
                        AND Estudante.IdadeEscolarEstudante='$IdadeEscolarMateria'
                        AND Estudante.InstituicaoEstudante_IdInstituicao=$InstituicaoProfessor_IdInstituicao
                        AND Estudante.NomeEstudante like '%$pesquisa%'";
                        
                    
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
                    <?php
                    }else{
                    ?>
                    <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                            <th>Registro Academico TESTE</th>
                            <th>Nome</th>
                            <th>Presença</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <th colspan="3" style="text-align:center;width:100px;">Voltar 
                                <a href="gerenciaAusencia.php"  type="button" class="btn btn-success btn-xs dt-add">
                                    <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                                </a>
                            </th>
                        </tfoot>
                    </table>
                    <?php
                }
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

<script>
    function Atualizar(){
        window.location = "gerenciaAusenciaEstudante.php?idEtapa=<?php echo $idEtapa ?>&idMateria=<?php echo $idMateria ?>&data=<?php echo $data ?>";
    }
</script>

</html>