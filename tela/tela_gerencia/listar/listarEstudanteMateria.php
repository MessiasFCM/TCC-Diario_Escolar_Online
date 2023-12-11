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
    
    if(isset($_GET["RegistroAcademico"])){
        $RegistroAcademico = $_GET["RegistroAcademico"];
    }
    

    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];
    $qtd_result_pg = $_POST["qtd_result_pg"];
    
    

    $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;

    if(isset($_SESSION['registradoInseridoComSucesso'])){
        ?>
        <div class="alert hide alert-success">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Estudante registrado na matéria</span>
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
            <span class="msg">Estudante deletado da matéria</span>
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
            <span class="msg">Erro ao inserir estudante na matéria</span>
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
            <span class="msg">Erro ao deletar estudante da matéria</span>
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

    <link rel="stylesheet" href="../../css/alertsCrud.css">

    <!-- Custom fonts for this template-->
    

</head>

<body id="page-top">
    <div>
        <?php
            $sqlEstudante = "SELECT * FROM Estudante WHERE RegistroAcademico= $RegistroAcademico ";
            $Estudante = $conn->query($sqlEstudante);
            $exibirEstudante = $Estudante->fetch_assoc();

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

            if($total==4){
                $anoEscolar = $array[0];
                $idadeEscolar = $array[1];
                $situacaoEscolarGeral = $array[2];

            }elseif($total==7){
                $anoEscolar = $array[3];
                $idadeEscolar = $array[4];
                $situacaoEscolarGeral = $array[5];

            }elseif($total==10){
                $anoEscolar = $array[6];
                $idadeEscolar = $array[7];
                $situacaoEscolarGeral = $array[8];

            }elseif($total==13){
                $anoEscolar = $array[9];
                $idadeEscolar = $array[10];
                $situacaoEscolarGeral = $array[11];

            }elseif($total==16){
                $anoEscolar = $array[12];
                $idadeEscolar = $array[13];
                $situacaoEscolarGeral = $array[14];

            }elseif($total==19){
                $anoEscolar = $array[15];
                $idadeEscolar = $array[16];
                $situacaoEscolarGeral = $array[17];

            }elseif($total==22){
                $anoEscolar = $array[18];
                $idadeEscolar = $array[19];
                $situacaoEscolarGeral = $array[20];

            }elseif($total==25){
                $anoEscolar = $array[21];
                $idadeEscolar = $array[22];
                $situacaoEscolarGeral = $array[23];

            }elseif($total==28){
                $anoEscolar = $array[24];
                $idadeEscolar = $array[25];
                $situacaoEscolarGeral = $array[26];

            }elseif($total==31){
                $anoEscolar = $array[27];
                $idadeEscolar = $array[28];
                $situacaoEscolarGeral = $array[29];

            }elseif($total==34){
                $anoEscolar = $array[30];
                $idadeEscolar = $array[31];
                $situacaoEscolarGeral = $array[32];

            }elseif($total==37){
                $anoEscolar = $array[33];
                $idadeEscolar = $array[34];
                $situacaoEscolarGeral = $array[35];

            }elseif($total==40){
                $anoEscolar = $array[36];
                $idadeEscolar = $array[37];
                $situacaoEscolarGeral = $array[38];
        
            }elseif($total==43){
                $anoEscolar = $array[39];
                $idadeEscolar = $array[40];
                $situacaoEscolarGeral = $array[41];
        
            }elseif($total==46){
                $anoEscolar = $array[42];
                $idadeEscolar = $array[43];
                $situacaoEscolarGeral = $array[44];
        
            }

            $DataEstudante = $anoEscolar;
        ?>
        <div class="modal-body">
            <?php
            $sqlMateria = "SELECT * 
            FROM deo.Materia
            INNER JOIN deo.Professor ON Professor.InstituicaoProfessor_IdInstituicao = '{$_SESSION['usuarioId']}'
            WHERE NomeMateria like '%$pesquisa%'
            AND IdadeEscolarMateria= '$idadeEscolar'
            AND Professor_idProfessor = Professor.idProfessor
            ORDER BY NomeMateria
            LIMIT $inicio, $qtd_result_pg";
            ?>
            <p><b>Nome:</b>&nbsp;<?php echo $exibirEstudante["NomeEstudante"]?>&nbsp;-&nbsp;<b>Ano Letivo:</b>&nbsp;<?php echo $DataEstudante ?>
            -&nbsp;<b>Cursando:</b>&nbsp;<?php echo $idadeEscolar ?></p>
            <?php
            //executar o comando
            $Materia = $conn->query($sqlMateria);

            if ($Materia->num_rows >= 0) {

                
            ?>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th>Nome da matéria</th>
                    <th>Professor Responsável</th>
                    <th>Idade Escolar</th>
                    <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <th colspan="4" style="text-align:center;width:100px;">Voltar 
                    <a href="gerenciaEstudante.php"  type="button" class="btn btn-success btn-xs dt-add">
                        <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                    </a>
                    </th>
                </tfoot>
                <?php
                    while ($exibir = $Materia->fetch_assoc()){
                        $checar = 0;
                        $opcao = 0;
                        //buscar dados do dropdown no BD (tbestcivil)
                        //criar o comando sql
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
                        $idMateria = $exibir["idMateria"];
                        if($checar == 1){
                            $sqlAnoLetivo = "SELECT *
                            FROM Estudante_has_Materia
                            WHERE Materia_idMateria = $idMateria";
                            //executar o comando sql
                            $vinculacaoConferir = $conn->query($sqlAnoLetivo);
                            $exibirVinculacao = $vinculacaoConferir->fetch_assoc();
                            // if (isset($exibirVinculacao["AnoLetivo_EstudanteHasMateria"])){
                            // if ($exibirEstudante["AnoLetivoEstudante"] == $exibirVinculacao["AnoLetivo_EstudanteHasMateria"]){
                                    ?>
                                    <tbody>
                                        <tr>
                                            <td><?php echo $exibir["NomeMateria"] ?> </td>
                                            <?php
                                                $idMateriaProfessorConfirmar = $exibir["Professor_idProfessor"];
                                                $sqlProfessor = "SELECT * 
                                                FROM Professor 
                                                WHERE idProfessor = $idMateriaProfessorConfirmar";
                                                $Professor = $conn->query($sqlProfessor);
                                                $exibirProfessor = $Professor->fetch_assoc();
                                            ?>
                                            <td><?php echo $exibirProfessor["NomeProfessor"] ?> </td>
                                            <td><?php echo $exibir["IdadeEscolarMateria"] ?> </td>
                                            <td>
                                                <?php
                                                    $idMateriaSwitch = $exibir["idMateria"];
                                                    $verificarSwitch = "SELECT *
                                                    FROM Estudante_has_Materia
                                                    WHERE Estudante_RegistroAcademico = '$RegistroAcademico'
                                                    AND Materia_idMateria = '$idMateria' 
                                                    AND  AnoLetivo_EstudanteHasMateria = '$DataEstudante'";
                                                    $verificarSwitch = $conn->query($verificarSwitch);
                                                    $exibirVerificarSwitch = $verificarSwitch->fetch_assoc();

                                                    if(isset($exibirVerificarSwitch["Estudante_RegistroAcademico"]) && isset($exibirVerificarSwitch["AnoLetivo_EstudanteHasMateria"])){
                                                    $opcao = 1;
                                                        if($DataEstudante == $exibirVerificarSwitch["AnoLetivo_EstudanteHasMateria"]){
                                                            ?>
                                                            <label class="switch switch-3d switch-primary mr-3">
                                                                <input type="checkbox" class="switch-input" checked data-toggle="modal" data-target="#atualizarModal<?php echo $exibir["idMateria"] ?>" data-backdrop="static" data-keyboard="false">
                                                                <span class="switch-label"></span>
                                                                <span class="switch-handle"></span>
                                                            </label>    
                                                            <?php
                                                        }else{
                                                            $opcao = 0;
                                                            ?>
                                                            <label class="switch switch-3d switch-primary mr-3">
                                                                <input type="checkbox" class="switch-input" data-toggle="modal" data-target="#atualizarModal<?php echo $exibir["idMateria"] ?>" data-backdrop="static" data-keyboard="false">
                                                                <span class="switch-label"></span>
                                                                <span class="switch-handle"></span>
                                                            </label>
                                                            <?php
                                                        }
                                                    }else{
                                                    $opcao = 0;
                                                    ?>
                                                    <label class="switch switch-3d switch-primary mr-3">
                                                        <input type="checkbox" class="switch-input" data-toggle="modal" data-target="#atualizarModal<?php echo $exibir["idMateria"] ?>" data-backdrop="static" data-keyboard="false">
                                                        <span class="switch-label"></span>
                                                        <span class="switch-handle"></span>
                                                    </label>
                                                    <?php
                                                    }
                                                ?>
                                                
                                            <!-- Atualizar Modal-->
                                            <div class="modal fade" id="atualizarModal<?php echo $exibir["idMateria"] ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                                <div class="modal-dialog" role="document">
                                                    <div class="modal-content">
                                                        <?php
                                                        if($opcao == 1){
                                                        ?>
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="inserirModalLabel">Retirar matéria</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="Atualizar()">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <form action="../../php/php_crud_deletar/deletarEstudanteMateria.php?Estudante_RegistroAcademico=<?php echo $_GET["RegistroAcademico"]?>&Materia_idMateria=<?php echo $exibir["idMateria"]?>&AnoLetivo_EstudanteHasMateria=<?php echo $DataEstudante?>" method="post">
                                                                <div>
                                                                    <h5 class="modal-text">Você confirma que deseja retirar a matéria <b><?php echo $exibir["NomeMateria"] ?></b> ?</h5>
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
                                                            <h5 class="modal-title" id="inserirModalLabel">Adicionar matéria</h5>
                                                            <button class="close" type="button" data-dismiss="modal" aria-label="Close" onclick="Atualizar()">
                                                                <span aria-hidden="true">×</span>
                                                            </button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <form action="../../php/php_crud_inserir/inserirEstudanteMateria.php?Estudante_RegistroAcademico=<?php echo $_GET["RegistroAcademico"]?>&Materia_idMateria=<?php echo $exibir["idMateria"]?>&AnoLetivo_EstudanteHasMateria=<?php echo $DataEstudante ?>" method="post">
                                                                    <div>
                                                                        <h5 class="modal-text">Você confirma que deseja adicionar a matéria <b><?php echo $exibir["NomeMateria"] ?></b> ?</h5>
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
                                    $checar = 0;
                                }
                            ?>
                        </table>
                    <?php
                        //codigo da paginação
                        
                        $sql_qtd_registros ="SELECT count(idMateria) as num_registros
                        FROM deo.Materia
                        INNER JOIN deo.Professor ON Professor.InstituicaoProfessor_IdInstituicao = '{$_SESSION['usuarioId']}'
                        WHERE NomeMateria like '%$pesquisa%'
                        AND IdadeEscolarMateria= '$idadeEscolar'
                        AND Professor_idProfessor = Professor.idProfessor";
                        

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
        window.location = "gerenciaEstudanteMateria.php?RegistroAcademico=<?php echo $RegistroAcademico ?>";
    }
</script>

</html>