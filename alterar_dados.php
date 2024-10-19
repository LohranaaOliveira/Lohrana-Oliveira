<?php
session_start();
@include 'config.php'; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['name'];
    $telefone = $_POST['telefone']; 
    $email = $_SESSION['email']; 

    $stmt = $conn->prepare("UPDATE usuarios SET nome = ?, telefone = ? WHERE email = ?");
    $stmt->bind_param("sss", $nome, $telefone, $email);

    if ($stmt->execute()) {
        $_SESSION['message'] = "Dados atualizados com sucesso!";
    } else {
        $_SESSION['message'] = "Erro ao atualizar os dados. Tente novamente.";
    }

    $stmt->close();
    $conn->close(); 

    header('Location: user.php'); 
    exit();
}

if (!preg_match("/^\(\d{2}\) \d{5}-\d{4}$/", $telefone)) {
    $_SESSION['message'] = "Formato de telefone inválido.";
    header('Location: user.php');
    exit();
}

?>
