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

    if (isset($_SESSION["idEtapaSelect"]) && isset($_SESSION["idMateriaSelect"])) {
        $idEtapa = $_SESSION['idEtapaSelect'];
        $idMateria = $_SESSION['idMateriaSelect'];
    }else{
        $idEtapa = $_SESSION['idEtapa'];
        $idMateria = $_SESSION['idMateria'];
    }
    
    $pesquisa = $_POST["pesquisa"];
    $pagina = $_POST["pagina"];
    $qtd_result_pg = $_POST["qtd_result_pg"];

    $inicio = ($pagina * $qtd_result_pg) - $qtd_result_pg;
    if(isset($_SESSION['registradoInseridoComSucesso'])){
        ?>
        <div class="alert hide alert-success">
            <span class="fa fa-sign-out"></span>
            <span class="msg">Nota registrada na prova</span>
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
            <span class="msg">Nota da prova atualizada</span>
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
            <span class="msg">Nota deletada da prova</span>
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
            <span class="msg">Erro ao inserir notas</span>
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
            <span class="msg">Erro ao atualizar notas</span>
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
            <span class="msg">Erro ao deletar notas</span>
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
                $IdadeEscolarMateria = $exibirMateria["IdadeEscolarMateria"];

                $sqlEtapa = "SELECT * FROM Etapa WHERE idEtapa = $idEtapa ";
                $Etapa = $conn->query($sqlEtapa);
                $exibirEtapa = $Etapa->fetch_assoc();
            ?>
            <p><b>Etapa:</b>&nbsp;<?php echo $exibirEtapa["NomeEtapa"]?>&nbsp;-&nbsp;<b>Ano letivo:</b>&nbsp;<?php echo $exibirEtapa["AnoEtapa"] ?>&nbsp;-&nbsp;<b>Matéria:</b>&nbsp;<?php echo $exibirMateria["NomeMateria"] ?>, <?php echo $IdadeEscolarMateria ?></p>

            <div>
                <?php
                $sql = "SELECT * 
                FROM Prova
                WHERE Prova.Materia_idMateria=$idMateria 
                AND Prova.Etapa_idEtapa=$idEtapa
                AND NomeProva like '%$pesquisa%'
                order by NomeProva
                LIMIT $inicio, $qtd_result_pg";

                //executar o comando
                $Prova = $conn->query($sql);

                if ($Prova->num_rows >= 0) {
                ?>
                <table id="dataTable" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th>Nome da Prova</th>
                        <th>Valor da Prova</th>
                        <th>Data da Prova</th>
                        <th>Inserir notas</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <th colspan="4" style="text-align:center;width:100px;">Voltar 
                            <a href="gerenciaNotas.php"  type="button" class="btn btn-success btn-xs dt-add">
                                <span class="mdi mdi-arrow-left-bold" aria-hidden="true"></span>
                            </a>
                        </th>
                    </tfoot>
                    <?php
                    while ($exibir = $Prova->fetch_assoc()){
                        $dataFormatada = date('d/m/Y', strtotime($exibir["DataProva"]));
                        ?>
                        <tbody>
                            <tr>
                            <td><?php echo $exibir["NomeProva"] ?></td>
                            <td><?php echo $exibir["ValorProva"] ?></td>
                            <td><?php echo $dataFormatada ?></td>
                            <td>
                                <?php $id =  $exibir["idProva"]; ?>
                                <a type="button" href="gerenciaNotasEstudante.php?idProva=<?php echo $exibir["idProva"] ?>&idEtapa=<?php echo $idEtapa ?>&idMateria=<?php echo $idMateria?>" class="btn btn-success btn-xs dt-edit" style="margin-right:16px;">
                                    <span class="mdi mdi-account-plus"  aria-hidden="true"></span>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                    <?php
                    }
                    ?>
                </table>
                <?php
                //codigo da paginação
                $sql_qtd_registros = "SELECT count(idProva) as num_registros
                FROM Prova
                WHERE Prova.Materia_idMateria=$idMateria 
                AND Prova.Etapa_idEtapa=$idEtapa
                AND Prova.NomeProva like '%$pesquisa%'
                ";
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

     <!-- Inserir Modal-->
     <div class="modal fade" id="inserirModal" tabindex="-1" role="dialog" aria-labelledby="inserirModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="inserirModalLabel">Inserir uma nova prova</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="../../php/php_crud_inserir/inserirProva.php?Etapa_idEtapa=<?php echo $idEtapa ?>&Materia_idMateria=<?php echo $idMateria?>" method="post">
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtnomeProva" id="NomeProva" aria-describedby="NomeProva" placeholder="Insira o nome da prova" >
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control form-control-user" name="txtvalorProva" id="ValorProva" aria-describedby="ValorProva" placeholder="Insira o valor da prova" >
                        </div>
                        <div class="form-group">
                            <input type="data" class="form-control form-control-user" name="txtdataProva" id="DataProva" aria-describedby="DataProva" placeholder="Insira a data da prova" >
                        </div>
                        <hr>
                        <input type="submit" value="Adicionar prova" class="btn btn-success btn-icon-split-user">
                        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    </form>  
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    

</body>

</html>