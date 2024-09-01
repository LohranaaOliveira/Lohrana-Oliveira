<?php
session_start();
include_once('config.php');

if(isset($_POST['submit'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    // Exemplo simples de verificação de login (modifique conforme necessário)
    $sql = "SELECT * FROM usuarios WHERE email = '$email' AND senha = '$senha'";
    $result = $conexao->query($sql);

    if($result->num_rows > 0) {
        // Login bem-sucedido
        $_SESSION['email'] = $email;
        header('Location: sistema.php');
    } else {
        // Login falhou
        $_SESSION['login_erro'] = "Email ou senha incorretos.";
        header('Location: login.php');
    }
}
?>
