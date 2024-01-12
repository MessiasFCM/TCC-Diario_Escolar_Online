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

    $idAnoLetivo=$_SESSION['idAnoLetivo'];

    $sqlEstudante = "SELECT *
    FROM Estudante
    WHERE RegistroAcademico = '$RegistroAcademico'";
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

    $contador = 0;
    for($cont = 0; $cont < sizeof($array); $cont++){
        //echo $array[$total] . " / ";
        if($idAnoLetivo == $array[$cont]){
            $anoEscolar = $array[$cont];
            $contador = 1;
        }elseif($contador == 1){
            $idadeEscolar = $array[$cont];
            $contador = 2;
        }elseif($contador == 2){
            $situacaoEscolarGeral = $array[$cont];
            $contador = 0;
        }
    }

    $_SESSION['RegistroAcademico'] = $RegistroAcademico;
    $_SESSION['idadeEscolar'] = $idadeEscolar;
    $_SESSION['anoEscolar'] = $anoEscolar;

    
    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];
    $qtd_result_pg = $_POST["qtd_result_pg"];
    
    $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;
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
            AND Estudante_has_Materia.AnoLetivo_EstudanteHasMateria = '$anoEscolar'
            AND NomeMateria like '%$pesquisa%'
            order by NomeMateria
            LIMIT $inicio, $qtd_result_pg";
            
            //executar o comando
            ?>
            <p><b>Estudante:</b>&nbsp;<?php echo $NomeEstudante?>&nbsp;-&nbsp;<b>Ano letivo:</b>&nbsp;<?php echo $anoEscolar ?>&nbsp;-&nbsp;<b>Série:</b>&nbsp;<?php echo $idadeEscolar ?></p>
            <?php
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
                    </tr>
                </thead>
                <tfoot>
                    <th colspan="5" style="text-align:center;width:100px;">Voltar 
                        <a href="gerenciaEstudante.php"  type="button" class="btn btn-success btn-xs dt-add">
                            <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                        </a>
                        &nbsp;&nbsp;&nbsp;Baixar Histórico
                        <a href="../../gerarPDFHistoricoGeralInstituicao.php"  type="submit" class="btn btn-info btn-xs dt-add">
                            <span class="mdi mdi-file-download" aria-hidden="true"></span>
                        </a>
                    </th>
                </tfoot>
                <?php
                    while ($exibir = $Materia->fetch_assoc()){
                    ?>
                    <tbody>
                        <tr>
                            <!-- Notas total -->
                            <?php 
                                $notaTotal = 0;
                                $idMateria = $exibir["idMateria"];
                                $sqlNota = "SELECT * 
                                FROM deo.Prova
                                INNER JOIN deo.Nota ON Nota.Provas_idProvas = idProva
                                WHERE Materia_idMateria = $idMateria 
                                AND Estudante_RegistroAcademico = $RegistroAcademico
                                AND $anoEscolar = year(DataProva)";
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
                                WHERE Estudante_RegistroAcademico = '$RegistroAcademico'
                                AND Materias_idMateria = '$idMateria'
                                AND $anoEscolar = year(DataAusencia)";
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
                                AND AnoLetivo_EstudanteHasMateria = '$anoEscolar'";
                                $Situacao = $conn->query($sqlSituacao);
                                $exibirSituacao = $Situacao->fetch_assoc();
                                $situacaoEscolar = $exibirSituacao["VerificacaoAprovacao"];

                            ?>

                            <td><?php echo $exibir["NomeMateria"] ?></td>
                            <td><?php echo $situacaoEscolar ?></td>
                            <td><?php echo $anoEscolar ?> </td>
                            <td><?php echo $notaTotal ?> </td>
                            <td><?php echo $totalAusencia ?> </td>
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
                AND Estudante_has_Materia.AnoLetivo_EstudanteHasMateria = '$anoEscolar'
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

    <!-- Bootstrap core JavaScript-->
    
</body>

</html>