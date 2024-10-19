<?php
@include 'config.php';

$conn = new mysqli('localhost', 'root', '', 'cart_db');

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Lógica para excluir uma avaliação
if (isset($_POST['delete_id'])) {
    $delete_id = intval($_POST['delete_id']);
    $conn->query("DELETE FROM avaliacoes WHERE id = $delete_id");
}

// Lógica para excluir todas as avaliações
if (isset($_POST['delete_all'])) {
    $conn->query("DELETE FROM avaliacoes");
}

$sql = "SELECT id, nome, sobrenome, email, telefone, mensagem, rating, data_envio FROM avaliacoes ORDER BY data_envio DESC";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Personalização do site/TopLevelLogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Consulta de Avaliações</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #f8f9fa; /* Cor de fundo clara */
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            border: 1px solid #e0e0e0;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 24px;
            margin-bottom: 20px;
        }

        .message {
            padding: 15px;
            border-radius: 20px;
            border-top-left-radius: 0px;
            background-color: #ebcff57f; /* Cor de fundo do balão do usuário */
            margin-bottom: 15px; /* Espaço entre as mensagens */
            position: relative;
            transition: background-color 0.3s;
        }

        .message:hover {
            background-color: #e9ecef; /* Efeito hover */
        }

        .message::before {
            content: "";
            position: absolute;
            left: -14.2px;
            width: 0;
            height: 0;
            border: 7.5px solid transparent;
            border-right-color: #ebcff57f; /* Cor do balão */
            margin-top: -15px;
        }

        .message p {
            margin: 5px 0; /* Margem ajustada */
        }

        .message-info {
            font-size: 12px;
            color: #888;
            text-align: right;
        }

        .star-rating {
            color: gold; /* Cor das estrelas */
            font-size: 18px; /* Tamanho das estrelas */
        }

        /* Estilizando o botão de excluir todas as avaliações */
        .delete-all-button {
            background-color: #dc3545; /* Cor de fundo do botão */
            color: white; /* Cor do texto */
            border: none;
            padding: 10px 20px;
            border-radius: 20px;
            cursor: pointer;
            font-size: 16px;
            margin-bottom: 20px;
            transition: background-color 0.3s;
            display: block;
            text-align: center;
            width: 30%; /* Botão ocupa toda a largura */
        }

        .delete-all-button:hover {
            background-color: #c82333; /* Cor do botão ao passar o mouse */
        }

        .delete-icon {
            color: #dc3545; /* Cor do ícone */
            cursor: pointer;
            font-size: 16px; /* Tamanho do ícone */
            transition: color 0.3s;
            background-color: #ffffff00;
            border: none;
        }

        .delete-icon:hover {
            color: #c82333; /* Cor do ícone ao passar o mouse */
        }

        .header-config {
            text-align: center; /* Centraliza o logo */
            margin-bottom: 20px;
        }

        .logo {
            font-size: 30px;
            font-weight: bold;
            color: #9000ff;
            text-decoration: none;
            display: inline-block;
        }

        .header-config img {
            height: 60px;
            width: 60px;
            vertical-align: middle; /* Centraliza o logo */
        }
    </style>
</head>
<body>
<div class="header-config">
    <a href="Index.php" class="logo"><img src="Personalização do site/TopLevelLogo2.webp" alt="logo">TopLevel</a>
</div>

<div class="container">
    <h1>Consulta de Avaliações</h1>

    <!-- Botão para excluir todas as avaliações -->
    <form method="POST">
        <button type="submit" name="delete_all" class="delete-all-button" onclick="return confirm('Tem certeza que deseja excluir todas as avaliações?');">Excluir Todas as Avaliações</button>
    </form>
    <?php
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo '<div class="message">';
            echo '<p><strong>' . htmlspecialchars($row['nome']) . ' ' . htmlspecialchars($row['sobrenome']) . '</strong></p>';
            
            // Adicionando estrelas de avaliação
            echo '<p class="star-rating">';
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $row['rating']) {
                    echo '<i class="fas fa-star"></i>'; // Estrela preenchida
                } else {
                    echo '<i class="far fa-star"></i>'; // Estrela vazia
                }
            }
            echo '</p>';
            
            echo '<p>' . htmlspecialchars($row['mensagem']) . '</p>';
            echo '<div class="message-info">Email: ' . htmlspecialchars($row['email']) . ' | Telefone: ' . htmlspecialchars($row['telefone']) . ' | Data: ' . htmlspecialchars($row['data_envio']) . '</div>';

            // Formulário para excluir a avaliação individual
            echo '<form method="POST" style="display:inline;">';
            echo '<input type="hidden" name="delete_id" value="' . htmlspecialchars($row['id']) . '">';
            echo '<button type="submit" class="delete-icon" onclick="return confirm(\'Tem certeza que deseja excluir esta avaliação?\');"><i class="fas fa-trash-alt"></i></button>';
            echo '</form>';
            
            echo '</div>';
        }
    } else {
        echo '<p>Nenhuma avaliação encontrada.</p>';
    }
    $conn->close();
    ?>


</div>
</body>
</html>
