<?php
session_start();
include_once("php/conexao.php");
$RegistroAcademico=$_SESSION['RegistroAcademico'];
$idadeEscolar=$_SESSION['idadeEscolar'];
$anoEscolar=$_SESSION['idAnoLetivo'];


$sqlEstudante = "SELECT *
    FROM Estudante
    WHERE RegistroAcademico = '$RegistroAcademico'";
    $Estudante = $conn->query($sqlEstudante);
    $exibirEstudante = $Estudante->fetch_assoc();
    $NomeEstudante=$exibirEstudante["NomeEstudante"];

?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <title>Histórico Escolar</title>

        <style>
            table {
                font-size:16px;
                font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
                border-collapse: collapse;
                border-spacing: 0;
                width: 100%;
            }

            td,  th {
                border: 1px solid #ddd;
                text-align: left;
                padding: 8px;
            }

            tr:nth-child(even){background-color: #f2f2f2}

            th {
                padding-top: 11px;
                padding-bottom: 11px;
                background-color: #33cc99;
                color: white;
            }
            .tabletest {
            margin-top: 20px;
            margin-bottom: 40px;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            }

            .tabletest,
            .tabletest th,
            .tabletest td {
            padding: 8px;
            text-align: left;
            }

            .tabletest2 {
            font-size:15px;
            margin-top: 20px;
            margin-bottom: 40px;
            border-collapse: collapse;
            width: 100%;
            }

            .tabletest2,
            .tabletest2 th,
            .tabletest2 td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            }

            .tabletest3 {
            border: 1px solid #ddd;
            margin-top: 20px;
            margin-bottom: 40px;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            }

            .tabletest3,
            .tabletest3 th,
            .tabletest3 td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            }

            .tabletest4 {
            margin-top: 20px;
            margin-bottom: 40px;
            border-collapse: collapse;
            width: 100%;
            }

            .tabletest4,
            .tabletest4 th,
            .tabletest4 td {
            padding: 8px;
            text-align: left;
            border-bottom: 1px solid #ddd;
            }

            .tabletest4 tr:hover {
            background-color: #f5f5f5
            }

            .tabler2 {
            box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19) !important;
            margin-top: 20px;
            margin-bottom: 40px;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            }

            .tabler2,
            .tabler2 th,
            .tabler2 td {
            border: none;
            text-align: left;
            padding: 8px;
            }

            .tabler2 tbody tr:nth-child(even) {
            background-color: #f2f2f2
            }

            .tabler {
            margin-top: 20px;
            margin-bottom: 40px;
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
            }

            .tabler,
            .tabler th,
            .tabler td {
            border: none;
            text-align: left;
            padding: 8px;
            }

            .tabler tbody tr:nth-child(even) {
            background-color: #f2f2f2
            }
        </style>
    </head>
  
    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            <!-- Códigos de edição -->
            <div class="modal-body">
            <p><b>Estudante:</b>&nbsp;<?php echo $NomeEstudante?>&nbsp;-&nbsp;<b>Ano letivo:</b>&nbsp;<?php echo $anoEscolar ?>&nbsp;-&nbsp;<b>Série:</b>&nbsp;<?php echo $idadeEscolar ?></p>
                <?php
                    $sqlPDF = "SELECT * 
                        FROM Materia
                        INNER JOIN deo.Estudante_has_Materia ON Estudante_has_Materia.Estudante_RegistroAcademico = '$RegistroAcademico' 
                        WHERE Materia.IdadeEscolarMateria = '$idadeEscolar'
                        AND Estudante_has_Materia.Materia_idMateria = idMateria
                        AND Estudante_has_Materia.AnoLetivo_EstudanteHasMateria = '$anoEscolar'
                        order by NomeMateria";

                    $tabelaPDF = $conn->query($sqlPDF);
                if ($tabelaPDF->num_rows >= 0) {
                    ?>
                    <table>
                            </thead>
                            <tr>
                                <th>Matéria</th>
                                <th>Situação</th>
                                <th>P. Letivo</th>
                                <th>Nota</th>
                                <th>Faltas</th>
                            </tr>
                            </thead>
                        <tbody>
                            <?php
                        while ($exibir = $tabelaPDF->fetch_assoc()){
                            ?>
                            <tr>
                                <?php
                                    $idMateria = $exibir["idMateria"];

                                    $notaTotal = 0;
                                    $sqlNota = "SELECT * 
                                    FROM deo.Prova
                                    INNER JOIN deo.Nota ON Nota.Provas_idProvas = idProva
                                    WHERE Materia_idMateria = '$idMateria' 
                                    AND Estudante_RegistroAcademico = '$RegistroAcademico'
                                    AND '$anoEscolar' = year(DataProva)";
                                    $Nota = $conn->query($sqlNota);
                                    if ($Nota->num_rows > 0) {
                                        while ($exibirNota = $Nota->fetch_assoc()){
                                            $notaTotal += $exibirNota["ValorObtido"];
                                        }
                                    }
                                    //echo $notaTotal;

                                    $totalAusencia = 0;
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
                                    //echo $totalAusencia;

                                    $sqlSituacao = "SELECT * 
                                    FROM deo.Estudante_has_Materia
                                    WHERE Estudante_RegistroAcademico = '$RegistroAcademico'
                                    AND Materia_idMateria = '$idMateria'
                                    AND AnoLetivo_EstudanteHasMateria = '$anoEscolar'";
                                    $Situacao = $conn->query($sqlSituacao);
                                    $exibirSituacao = $Situacao->fetch_assoc();
                                    $situacaoEscolar = $exibirSituacao["VerificacaoAprovacao"];

                                    //echo $situacaoEscolar;
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
                    }
                    ?>
                </table>
            </div>
        </div>
        <?php

        unset(
            $_SESSION['RegistroAcademico'],
            $_SESSION['idadeEscolar'],
            $_SESSION['anoEscolar'],
            $_SESSION['NomeEstudante']
        );
    ?>

    <!-- Bootstrap core JavaScript-->
    <script src="../vendor/jquery/jquery.min.js"></script>
    <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="../js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="../vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->


    </body>
</html>