<?php
@include 'config.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = $_POST['nome'] ?? '';
    $sobrenome = $_POST['sobrenome'] ?? '';
    $email = $_POST['email'] ?? '';
    $telefone = $_POST['telefone'] ?? '';
    $mensagem = $_POST['mensagem'] ?? '';
    $rating = $_POST['rating'] ?? null;

    if (is_null($rating) || empty($rating)) {
        echo "Erro: avaliação não foi selecionada.";
        exit;
    }

    $sql = "INSERT INTO avaliacoes (nome, sobrenome, email, telefone, mensagem, rating) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        echo "Erro na preparação da declaração: " . $conn->error;
        exit;
    }

    $stmt->bind_param("ssssss", $nome, $sobrenome, $email, $telefone, $mensagem, $rating);

    if ($stmt->execute()) {
        echo "<strong>Avaliação enviada com sucesso!</strong> Agradecemos seu feedback.";
    } else {
        echo "<strong>Erro ao enviar avaliação:</strong> " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
}
?>
