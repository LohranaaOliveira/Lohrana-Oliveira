<?php
session_start();
include_once('config.php');

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc(); 
        $_SESSION['email'] = $email;
        
        if ($_SESSION['email'] === 'toplevelbrasil@gmail.com') {
            header('Location: sistema.php'); 
        } else {
            header('Location: user.php'); 
        }
        exit(); 
    } else {
        $_SESSION['login_erro'] = "Email ou senha incorretos.";
        header('Location: login.php');
        exit(); 
    }
}
?>
