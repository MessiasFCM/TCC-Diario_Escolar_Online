<?php
    //parãmetros de conexão com BD
    $servername = "200.18.128.50"; //nome ou endereço (ip) do servidor
    $username = "deo"; //nome do usuário
    $password = "2021@Deo"; //senha de acesso ao servidor do banco de dados
    $dbname = "deo"; //nome do banco de dados

    //criar um objeto de conexão
    $conn = new mysqli($servername, $username, $password, $dbname);

    //checar a conexão
    if ($conn->connect_error) {
        die("Falha na conexão: " . $conn->connect_error);
    }

?>