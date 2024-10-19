<?php

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = '';
    $dbName = 'cart_db';
    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword,$dbName);
    
    $conn = mysqli_connect('localhost','root','','cart_db');
?>