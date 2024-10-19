<?php

@include 'config.php';

session_start();

$logado = $_SESSION['email'];

$telefone = ""; 

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];
    $query = "SELECT telefone FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        $user = mysqli_fetch_assoc($result);
        $telefone = $user['telefone']; 
    }
}

if (isset($_SESSION['email'])) {
    if ($_SESSION['email'] === 'toplevelbrasil@gmail.com') {
        include 'headeradm.php';
    } else {
        include 'headeruser.php'; 
    }
} else {
    include 'header.php'; 
}

if (isset($_SESSION['email'])) {
    $email = $_SESSION['email'];

    $query = "SELECT nome FROM usuarios WHERE email = '$email' LIMIT 1"; 
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nomeUsuario = $row['nome'];
    } 
} else {
    $nomeUsuario = 'Visitante';
}


$email = $_SESSION['email'];
$queryPedidos = "SELECT * FROM `pedidos` WHERE email = '$email' ORDER BY id DESC";
$resultPedidos = mysqli_query($conn, $queryPedidos);


?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meus Pedidos</title>
    <style>
        .pedidos-container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px;
        }

        .pedido-item {
            background-color: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin-bottom: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
        }

        .pedido-info {
            flex: 1;
        }

        .pedido-info p {
            margin: 5px 0;
            color: #333;
        }

        .pedido-info h4 {
            font-size: 18px;
            margin-bottom: 10px;
            color: #9000ff;
        }

        .pedido-status {
            font-weight: bold;
            padding: 8px 15px;
            border-radius: 5px;
            color: #fff;
        }

        .pedido-status.pendente {
            background-color: #9000ff;
        }

        .pedido-status.entregue {
            background-color: #4caf50;
        }

        .pedido-total {
            font-size: 16px;
            font-weight: bold;
            color: #333;
        }

        .comprar-novamente {
            background-color: #9000ff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 14px;
            transition: background-color 0.3s ease;
        }

        .comprar-novamente:hover {
            background-color: #6d00cc;
        }

        .no-pedidos {
            text-align: center;
            padding: 50px 0;
            color: #666;
        }

        .no-pedidos a {
            color: #9000ff;
            text-decoration: underline;
        }
    </style>
</head>
<body>

<div class="containeruser">
    <div class="header">
        <div class="profile-picture">
            <img src="Personalização do site/user.jpg" alt="User Avatar">
        </div>
        <div class="username">
            <h2><?php echo htmlspecialchars($nomeUsuario); ?></h2>
        </div>
    </div>

    <nav class="menu">
        <ul>
            <li class="active"><a href="Meus_pedidos.php">Meus pedidos</a></li>
            <li class="desative"><a href="Meus_endereços.php">Meus endereços</a></li>
            <li class="desative"><a href="user.php">Minha conta</a></li>
        </ul>
    </nav>

<div class="pedidos-container">
    <h2>Meus pedidos</h2>

    <?php
    if (mysqli_num_rows($resultPedidos) > 0) {
        while ($pedido = mysqli_fetch_assoc($resultPedidos)) {
            $status = $pedido['status'] == 'pendente' ? 'pendente' : 'entregue';
            ?>
            <div class="pedido-item">
                <div class="pedido-info">
                    <h4>Pedido</h4>
                    <p><strong>Produtos:</strong> <?= htmlspecialchars($pedido['total_products']); ?></p>
                    <p><strong>Endereço de entrega:</strong> <?= htmlspecialchars($pedido['bairro'] . ', ' . $pedido['endereco'] . ', ' . $pedido['cidade'] . ', ' . $pedido['estado']); ?></p>
                    <p class="pedido-total"><strong>Total:</strong> R$<?= number_format($pedido['total_price'], 2, ',', '.'); ?></p>
                </div>
                <div class="pedido-status <?= $status; ?>">
                    <?= ucfirst($status); ?>
                </div>
            </div>
        <?php }
    } else { ?>
        <div class="no-pedidos">
            <p>Você ainda não recebeu nenhum pedido.</p>
            <a href="products.php">Começar a explorar</a>
        </div>
    <?php } ?>
</div>

</body>
</html>