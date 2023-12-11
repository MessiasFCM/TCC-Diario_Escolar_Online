<?php
    session_start();
    include_once("../../../php/conexao.php");
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: ../../../php/sair.php");
        exit;
    }else{
        if($_SESSION['usuarioNivelDeAcesso'] != '1'){
            // Usuário sem acesso! Redireciona para a página anterior
            header("Location: ../../tela_inicial/menu.php");
            exit;
        }
    }

    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];
    $qtd_result_pg = $_POST["qtd_result_pg"];

    $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;

    $sqlEstudante = "SELECT *
    FROM Estudante
    WHERE RegistroAcademico = '{$_SESSION['usuarioId']}'";
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

    $DataEstudante = $_SESSION["dataEstudante"];

    $_SESSION['NomeEstudante']=$NomeEstudante;

    // VerificacaoEstudante
    $string = null;
    $array = null;
    $string = $exibirEstudante["VerificacaoEstudante"];
    $array = explode(' - ', $string);

    $contador = 0;
    for($cont = 0; $cont < sizeof($array); $cont++){
        //echo $array[$total] . " / ";
        if($DataEstudante == $array[$cont]){
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
            FROM Materia
            INNER JOIN deo.Estudante_has_Materia ON Estudante_has_Materia.Estudante_RegistroAcademico = '$RegistroAcademico' 
            WHERE Materia.IdadeEscolarMateria = '$idadeEscolar'
            AND Estudante_has_Materia.Materia_idMateria = idMateria
            AND Estudante_has_Materia.AnoLetivo_EstudanteHasMateria = '$anoEscolar'
            AND NomeMateria like '%$pesquisa%'
            order by NomeMateria
            LIMIT $inicio, $qtd_result_pg";
            
            $_SESSION['RegistroAcademico']=$RegistroAcademico;
            $_SESSION['idadeEscolar']=$idadeEscolar;
            $_SESSION['anoEscolar']=$anoEscolar;
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
                        <a href="historico.php"  type="button" class="btn btn-success btn-xs dt-add">
                            <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                        </a>
                        &nbsp;&nbsp;&nbsp;Baixar Histórico
                        <a href="../../gerarPDFHistoricoGeral.php"  type="submit" class="btn btn-info btn-xs dt-add">
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