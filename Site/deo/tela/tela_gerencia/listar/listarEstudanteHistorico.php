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
            <span class="msg">Situação do estudante atualizada</span>
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
            <span class="msg">Erro ao atualizar situação do estudante</span>
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

    $RA = $_SESSION['RegistroAcademicoEstudante'];
    $sqlEstudante = "SELECT *
    FROM Estudante
    WHERE RegistroAcademico = $RA";
    $Estudante = $conn->query($sqlEstudante);
    $exibirEstudante = $Estudante->fetch_assoc();

    $RegistroAcademico = $exibirEstudante["RegistroAcademico"];
    $NomeEstudante = $exibirEstudante["NomeEstudante"];
    $EmailEstudante = $exibirEstudante["EmailEstudante"];
    $InstituicaoEstudante_IdInstituicao = $exibirEstudante["InstituicaoEstudante_IdInstituicao"];
    $AnoLetivoEstudante = $exibirEstudante["AnoLetivoEstudante"];
    $IdadeEscolarEstudante = $exibirEstudante["IdadeEscolarEstudante"];
    $DataInicioEstudante = date('Y', strtotime($exibirEstudante["DataInicioEstudante"]));
    $DataFinalEstudante = date('Y', strtotime($exibirEstudante["DataFinalEstudante"]));

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
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Códigos de edição -->
        <div class="modal-body">
            <?php
            $sql = "SELECT * 
            FROM Materia
            INNER JOIN deo.Estudante_has_Materia ON Estudante_has_Materia.Estudante_RegistroAcademico = '$RegistroAcademico' 
            WHERE Materia.IdadeEscolarMateria = '$idadeEscolar'
            AND Estudante_has_Materia.Materia_idMateria = idMateria
            AND Estudante_has_Materia.AnoLetivo_EstudanteHasMateria = '$DataEstudante'
            AND NomeMateria like '%$pesquisa%'
            order by NomeMateria
            LIMIT $inicio, $qtd_result_pg";
            ?>
            <p><b>Nome:</b>&nbsp;<?php echo $NomeEstudante?>&nbsp;-&nbsp;<b>Ano Letivo:</b>&nbsp;<?php echo $DataEstudante ?>
            -&nbsp;<b>Cursando:</b>&nbsp;<?php echo $idadeEscolar ?></p>
            <?php

            //executar o comando
            $Materia = $conn->query($sql);
            if ($Materia->num_rows >= 0) {
            ?>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Matéria</th>
                        <th>Situação</th>
                        <th>P. Letivo</th>
                        <th>Nota</th>
                        <th>Faltas</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tfoot>
                    <th colspan="6" style="text-align:center;width:100px;">Voltar 
                        <a href="gerenciaEstudante.php"  type="button" class="btn btn-success btn-xs dt-add">
                            <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                        </a>
                        &nbsp;&nbsp;&nbsp;&nbsp;Reprovado
                        <button type="button" class="btn btn-danger btn-xs dt-edit" data-toggle="modal" data-target="#myModalReprovado" style="margin-right:16px;">
                            <span class="mdi mdi-close"  aria-hidden="true"></span>
                        </button>
                        Aprovado
                        <button type="button" class="btn btn-info btn-xs dt-edit" data-toggle="modal" data-target="#myModalAprovado" style="margin-right:16px;">
                            <span class="mdi mdi-check-bold"  aria-hidden="true"></span>
                        </button>
                        &nbsp;&nbsp;&nbsp;&nbsp;Visualizar históricos 
                        <button type="button" class="btn btn-warning btn-xs dt-edit" data-toggle="modal" data-target="#myModalCarregar<?php echo $RegistroAcademico ?>" style="margin-right:16px;">
                            <span class="mdi mdi-file-document"  aria-hidden="true"></span>
                        </button>

                        <!-- Confirmar Reprovação Modal-->
                        <div class="modal fade" id="myModalReprovado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="inserirModalLabel">Certeza que deseja reprovar?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../../php/php_crud_atualizar/atualizarEstudante.php?RegistroAcademico=<?php echo $RA ?>&anoEscolar=<?php echo $DataEstudante ?>&idadeEscolar=<?php echo $IdadeEscolarEstudante ?>&situacaoEscolar=Reprovado" method="post">
                                            Selecione "Confirmar" abaixo se realmente for <b>reprovar</b> o(a) estudante <b><?php echo $NomeEstudante ?></b>.
                                            <hr>
                                            <input type="submit" value="Confirmar" class="btn btn-primary btn-icon-split-user">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Confirmar Aprovado Modal-->
                        <div class="modal fade" id="myModalAprovado" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="inserirModalLabel">Certeza que deseja aprovar?</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="../../php/php_crud_atualizar/atualizarEstudante.php?RegistroAcademico=<?php echo $RA ?>&anoEscolar=<?php echo $DataEstudante ?>&idadeEscolar=<?php echo $IdadeEscolarEstudante ?>&situacaoEscolar=Aprovado" method="post">
                                            Selecione "Confirmar" abaixo se realmente for <b>aprovar</b> o(a) estudante <b><?php echo $NomeEstudante ?></b>.
                                            <hr>
                                            <input type="submit" value="Confirmar" class="btn btn-primary btn-icon-split-user">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Carregar históricos -->
                        <div class="modal fade" id="myModalCarregar<?php echo $RegistroAcademico ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="inserirModalLabel">Visualizar históricos do estudante</h5>
                                        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="gerenciaEstudanteHistoricoSelecionar.php?RegistroAcademico=<?php echo $RegistroAcademico ?>" method="post">
                                            <h6><b>Selecione o ano letivo</b></h6>
                                            <select class="custom-select custom-select-sm form-control form-control-sm mb-3" name="idAnoLetivoSelect" id="idAnoLetivoSelect">
                                                <option selected disabled hidden>Ano letivo</option>
                                                <?php
                                                for ($cont = 0; $cont <= $total; $cont++)  {
                                                    if($cont==4){
                                                        $anoEscolar = $array[0];
                                                        $idadeEscolar = $array[1];
                                                        $situacaoEscolarGeral = $array[2];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==7){
                                                        $anoEscolar = $array[3];
                                                        $idadeEscolar = $array[4];
                                                        $situacaoEscolarGeral = $array[5];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==10){
                                                        $anoEscolar = $array[6];
                                                        $idadeEscolar = $array[7];
                                                        $situacaoEscolarGeral = $array[8];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==13){
                                                        $anoEscolar = $array[9];
                                                        $idadeEscolar = $array[10];
                                                        $situacaoEscolarGeral = $array[11];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==16){
                                                        $anoEscolar = $array[12];
                                                        $idadeEscolar = $array[13];
                                                        $situacaoEscolarGeral = $array[14];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==19){
                                                        $anoEscolar = $array[15];
                                                        $idadeEscolar = $array[16];
                                                        $situacaoEscolarGeral = $array[17];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==22){
                                                        $anoEscolar = $array[18];
                                                        $idadeEscolar = $array[19];
                                                        $situacaoEscolarGeral = $array[20];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==25){
                                                        $anoEscolar = $array[21];
                                                        $idadeEscolar = $array[22];
                                                        $situacaoEscolarGeral = $array[23];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==28){
                                                        $anoEscolar = $array[24];
                                                        $idadeEscolar = $array[25];
                                                        $situacaoEscolarGeral = $array[26];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==31){
                                                        $anoEscolar = $array[27];
                                                        $idadeEscolar = $array[28];
                                                        $situacaoEscolarGeral = $array[29];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==34){
                                                        $anoEscolar = $array[30];
                                                        $idadeEscolar = $array[31];
                                                        $situacaoEscolarGeral = $array[32];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==37){
                                                        $anoEscolar = $array[33];
                                                        $idadeEscolar = $array[34];
                                                        $situacaoEscolarGeral = $array[35];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==40){
                                                        $anoEscolar = $array[36];
                                                        $idadeEscolar = $array[37];
                                                        $situacaoEscolarGeral = $array[38];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==43){
                                                        $anoEscolar = $array[39];
                                                        $idadeEscolar = $array[40];
                                                        $situacaoEscolarGeral = $array[41];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }elseif($cont==46){
                                                        $anoEscolar = $array[42];
                                                        $idadeEscolar = $array[43];
                                                        $situacaoEscolarGeral = $array[44];
                                                        ?>
                                                            <option value="<?php echo $anoEscolar ?>"><?php echo $anoEscolar ?> - <?php echo $idadeEscolar ?> - <?php echo $situacaoEscolarGeral ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <hr>
                                            <input type="submit" value="Carregar histórico" class="btn btn-primary btn-icon-split-user">
                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                                        </form> 
                                    </div>
                                </div>
                            </div>
                        </div>
                    </th>
                </tfoot>
                <?php
                    while ($exibir = $Materia->fetch_assoc()){
                    ?>
                    <tbody>
                        <tr>
                            <!-- Notas total -->
                            <?php 
                                $totalAusencia = 0;
                                $notaTotal = 0;
                                $idMateria = $exibir["idMateria"];
                                $sqlNota = "SELECT * 
                                FROM deo.Prova
                                INNER JOIN deo.Nota ON Nota.Provas_idProvas = idProva
                                WHERE Materia_idMateria = $idMateria 
                                AND Estudante_RegistroAcademico = $RegistroAcademico";
                                $Nota = $conn->query($sqlNota);
                                if ($Nota->num_rows > 0) {
                                    while ($exibirNota = $Nota->fetch_assoc()){
                                        $notaTotal += $exibirNota["ValorObtido"];
                                    }
                                }
                            ?>

                            <!-- Ausencia total -->
                            <?php 
                                $totalAusencia = 0;
                                $idMateria = $exibir["idMateria"];
                                $sqlAusencia = "SELECT *  
                                FROM deo.Ausencia
                                WHERE Estudante_RegistroAcademico = $RegistroAcademico
                                AND Materias_idMateria = $idMateria 
                                AND $DataEstudante = year(DataAusencia)";
                                $Ausencia = $conn->query($sqlAusencia);
                                if ($Ausencia->num_rows > 0) {
                                    while ($exibirAusencia = $Ausencia->fetch_assoc()){
                                        $totalAusencia++;
                                    }
                                }
                            ?>

                            <!-- Situação Escolar -->
                            <?php 
                                $sqlSituacao = "SELECT * 
                                FROM deo.Estudante_has_Materia
                                WHERE Estudante_RegistroAcademico = '$RegistroAcademico'
                                AND Materia_idMateria = '$idMateria'
                                AND AnoLetivo_EstudanteHasMateria = '$DataEstudante'";
                                $Situacao = $conn->query($sqlSituacao);
                                $exibirSituacao = $Situacao->fetch_assoc();
                                $situacaoEscolar = $exibirSituacao["VerificacaoAprovacao"];
                            ?>

                            <td><?php echo $exibir["NomeMateria"] ?></td>
                            <td><?php echo $situacaoEscolar ?></td>
                            <td><?php echo $DataEstudante ?> </td>
                            <td><?php echo $notaTotal ?> </td>
                            <td><?php echo $totalAusencia ?> </td>
                            <td>
                                <button type="button" class="btn btn-primary btn-xs dt-edit" data-toggle="modal" data-target="#myModal<?php echo $RA ?><?php echo $idMateria ?><?php echo $DataEstudante ?>" style="margin-right:16px;">
                                    <span class="mdi mdi-account-edit"  aria-hidden="true"></span>
                                </button>

                                <!-- Atualizar Modal-->
                                <div class="modal fade" id="myModal<?php echo $RA ?><?php echo $idMateria ?><?php echo $DataEstudante ?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="inserirModalLabel">Atualizar estudante</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <form action="../../php/php_crud_atualizar/atualizarEstudanteMateria.php?Estudante_RegistroAcademico=<?php echo $RA ?>&Materia_idMateria=<?php echo $idMateria ?>&AnoLetivo_EstudanteHasMateria=<?php echo $DataEstudante ?>" method="post">
                                                    <div class="form-group ">
                                                        <h6><b>Selecione a situação do estudante nessa matéria</b></h6>
                                                        <select class="custom-select custom-select-sm form-control form-control-sm" name="opSituacaoEscolar" aria-label=" select example" >
                                                            <option disabled hidden>Situação</option>
                                                            <option <?php echo($situacaoEscolar == "Aprovado")?"selected":"" ?> value="Aprovado">Aprovado</option>
                                                            <option <?php echo($situacaoEscolar == "Em andamento")?"selected":"" ?> value="Em andamento">Em andamento</option>
                                                            <option <?php echo($situacaoEscolar == "Reprovado")?"selected":"" ?> value="Reprovado">Reprovado</option>
                                                        </select>
                                                    </div>
                                                    <hr>
                                                    <input type="submit" value="Atualizar estudante" class="btn btn-primary btn-icon-split-user">
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
                $sql_qtd_registros = "SELECT count(idMateria) as num_registros
                FROM Materia
                INNER JOIN deo.Estudante_has_Materia ON Estudante_has_Materia.Estudante_RegistroAcademico = '$RegistroAcademico' 
                WHERE Materia.IdadeEscolarMateria = '$idadeEscolar'
                AND Estudante_has_Materia.Materia_idMateria = idMateria
                AND Estudante_has_Materia.AnoLetivo_EstudanteHasMateria = '$DataEstudante'
                AND NomeMateria like '%$pesquisa%'";
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
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtnomeCompleto" id="nomeCompleto" aria-describedby="nomeEstudante" placeholder="Insira o nome completo">
                        </div>
                        <div class="form-group">
                            <input type="email" class="form-control form-control-user" name="txtemailEstudante" id="emailEstudante" aria-describedby="emailEstudante" placeholder="Insira o Email">
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-control form-control-user" name="txtsenhaEstudante"  id="senha" placeholder="Insira a senha">
                        </div>
                        <div class="form-group">
                            <input type="number" class="form-control form-control-user" name="txtanoLetivoEstudante" id="anoLetivoEstudante" aria-describedby="anoLetivoEstudante" placeholder="Insira o ano letivo">
                        </div>
                        <div class="form-group ">
                            <select class="custom-select custom-select-sm form-control form-control-sm" name="opIdadeEscolarEstudante" aria-label=" select example" >
                                <option selected disabled hidden>Selecione a idade escolar</option>
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