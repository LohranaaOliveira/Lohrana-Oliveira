<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $conn = new mysqli('localhost', 'root', '', 'cart_db'); 

        if ($conn->connect_error) {
            die("Falha na conexão: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM subscribers WHERE email = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $_SESSION['message'] = "Este e-mail já está cadastrado!";
        } else {
            $sql = "INSERT INTO subscribers (email) VALUES (?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("s", $email);

            if ($stmt->execute()) {
                $_SESSION['message'] = "Assinatura realizada com sucesso!";
            } else {
                $_SESSION['message'] = "Ocorreu um erro ao cadastrar seu e-mail. Tente novamente!";
            }
        }

        $stmt->close();
        $conn->close();
    } else {
        $_SESSION['message'] = "E-mail inválido. Por favor, insira um e-mail correto.";
    }

    header('Location: index.php'); 
    exit();
}
?>
