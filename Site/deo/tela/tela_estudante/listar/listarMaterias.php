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

    $anoEscolar = $_SESSION['anoEscolar'];
    $idadeEscolar = $_SESSION['idadeEscolar'];
    $situacaoEscolarGeral = $_SESSION['situacaoEscolarGeral'];
    $idMateriaSelect = $_SESSION['idMateriaSelect'];

    $DataEstudante = $anoEscolar;

    $_SESSION['NomeEstudante']=$NomeEstudante;

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
            FROM deo.Prova
            INNER JOIN deo.Nota ON Nota.Provas_idProvas = idProva
            WHERE Materia_idMateria = '$idMateriaSelect'
            AND Estudante_RegistroAcademico = $RegistroAcademico
            AND $DataEstudante = year(DataProva)
            AND Prova.NomeProva like '%$pesquisa%'
            ORDER BY Prova.DataProva
            LIMIT $inicio, $qtd_result_pg";

            $_SESSION['RegistroAcademico']=$RegistroAcademico;
            $_SESSION['idadeEscolar']=$idadeEscolar;
            $_SESSION['anoEscolar']=$anoEscolar;

            $sqlMateria = "SELECT *
            FROM Materia
            WHERE idMateria = '$idMateriaSelect'";
            $Materia = $conn->query($sqlMateria);
            $exibirMateria = $Materia->fetch_assoc();

            $_SESSION['NomeMateria']=$exibirMateria["NomeMateria"];

            //executar o comando
            ?>
                <p><b>Estudante:</b>&nbsp;<?php echo $NomeEstudante?>&nbsp;-&nbsp;<b>Ano letivo:</b>&nbsp;<?php echo $anoEscolar ?>&nbsp;-&nbsp;<b>Série:</b>&nbsp;<?php echo $idadeEscolar ?>
                &nbsp;-&nbsp;<b>Matéria:</b>&nbsp;<?php echo $exibirMateria["NomeMateria"] ?></p>
            <?php
            $Prova = $conn->query($sql);
            if ($Prova->num_rows >= 0) {
            ?>
            <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>Nome Atividade</th>
                        <th>Data da Prova</th>
                        <th>Valor</th>
                        <th>Nota Obtida</th>
                    </tr>
                </thead>
                <tfoot>
                <th colspan="5" style="text-align:center;width:100px;">Voltar 
                        <a href="historico.php"  type="button" class="btn btn-success btn-xs dt-add">
                            <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                        </a>
                        &nbsp;&nbsp;&nbsp;Baixar Histórico
                        <a href="../../gerarPDFHistoricoSeparado.php"  type="submit" class="btn btn-info btn-xs dt-add">
                            <span class="mdi mdi-file-download" aria-hidden="true"></span>
                        </a>
                    </th>
                </tfoot>
                <?php
                    while ($exibir = $Prova->fetch_assoc()){
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $exibir["NomeProva"] ?></td>
                            <td><?php echo $exibir["DataProva"] ?></td>
                            <td><?php echo $exibir["ValorProva"] ?></td>
                            <td><?php echo $exibir["ValorObtido"] ?></td>
                        </tr>
                    </tbody>
                    <?php
                    }
                ?>
            </table>
            <?php
                //codigo da paginação
                $sql_qtd_registros = "SELECT count(idProva) as num_registros
                FROM deo.Prova
                INNER JOIN deo.Nota ON Nota.Provas_idProvas = idProva
                WHERE Prova.Materia_idMateria = '$idMateriaSelect'
                AND Estudante_RegistroAcademico = '$RegistroAcademico'
                AND $DataEstudante = year(DataProva)
                AND NomeProva like '%$pesquisa%'";
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