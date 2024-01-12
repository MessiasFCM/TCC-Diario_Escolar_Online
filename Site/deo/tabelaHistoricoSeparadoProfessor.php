<?php
    session_start();
    include_once("php/conexao.php");
    if($_SESSION['logged'] != True) {
        // Usuário não logado! Redireciona para a página de login
        header("Location: /php/sair.php");
        exit;
    }else{
        if($_SESSION['usuarioNivelDeAcesso'] != '2'){
            // Usuário sem acesso! Redireciona para a página anterior
            header("Location: /tela/tela_inicial/menu.php");
            exit;
        }
    }
    $hoje = date('Y');
    $anoEscolar= $hoje;

    $RegistroAcademico=$_SESSION['RegistroAcademico'];
    $idadeEscolar=$_SESSION['idadeEscolar'];
    $idMateriaSelect = $_SESSION['idMateria'];

    $DataEstudante = $anoEscolar;

    $sqlEstudante = "SELECT *
    FROM Estudante
    WHERE RegistroAcademico = '$RegistroAcademico'";
    $Estudante = $conn->query($sqlEstudante);
    $exibirEstudante = $Estudante->fetch_assoc();
    $NomeEstudante = $exibirEstudante["NomeEstudante"];

    $sqlMateria = "SELECT *
    FROM Materia
    WHERE idMateria = '$idMateriaSelect'";
    $Materia = $conn->query($sqlMateria);
    $exibirMateria = $Materia->fetch_assoc();
    $NomeMateria= $exibirMateria["NomeMateria"];

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
        <p><b>Estudante:</b>&nbsp;<?php echo $NomeEstudante?>&nbsp;-&nbsp;<b>Ano letivo:</b>&nbsp;<?php echo $anoEscolar ?>&nbsp;-&nbsp;<b>Série:</b>&nbsp;<?php echo $idadeEscolar ?>
         &nbsp;-&nbsp;<b>Matéria:</b>&nbsp;<?php echo $NomeMateria ?></p>
            <?php
            $sql = "SELECT * 
            FROM deo.Prova
            INNER JOIN deo.Nota ON Nota.Provas_idProvas = idProva
            WHERE Materia_idMateria = '$idMateriaSelect'
            AND Estudante_RegistroAcademico = $RegistroAcademico
            AND $DataEstudante = year(DataProva)
            ORDER BY Prova.DataProva";

            //executar o comando
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
        unset(
            $_SESSION['RegistroAcademico'],
            $_SESSION['idadeEscolar'],
            $_SESSION['anoEscolar'],
            $_SESSION['idMateriaSelect']
        );
        }
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