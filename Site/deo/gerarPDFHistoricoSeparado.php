<!DOCTYPE html> 

<html> 

<head> 

        <title></title> 

        <meta charset="utf-8"> 

</head> 

<body> 

<?php 

        //definimos uma constante com o nome da pasta 

        //incluimos o arquivo 

        require_once __DIR__ . '/vendor/autoload.php';
        $arquivo="HistóricoEscolar.pdf";

        $mpdf = new \Mpdf\Mpdf();
        ob_start();  

        //incluindo o conteúdo de todo o arquivo conteudo.php 

        include('tabelaHistoricoSeparado.php'); 

        //Limpa o buffer jogando todo o HTML em uma variável. 

        $html = ob_get_clean();

        $mpdf->WriteHTML($html);

        $mpdf->Output($arquivo, 'I');



        exit(); 

?> 

</body> 

</html> 