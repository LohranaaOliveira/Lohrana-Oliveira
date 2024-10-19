<?php
@include 'config.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $pedido_id = $_POST['pedido_id'];

    if (isset($_POST['entregar'])) {
        $current_status = $_POST['current_status']; 
        $new_status = ($current_status === 'entregue') ? 'pendente' : 'entregue';

        $conn = new mysqli('localhost', 'root', '', 'cart_db');

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }
        echo "Atualizando o pedido ID $pedido_id para o status '$new_status'...<br>";

        $sql_entrega = "UPDATE pedidos SET status='$new_status' WHERE id='$pedido_id'";
        if ($conn->query($sql_entrega) === TRUE) {
            echo "Status atualizado com sucesso para '$new_status'.<br>";
        } else {
            echo "Erro ao atualizar status: " . $conn->error . "<br>";
        }

        $conn->close();
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit;
    }

    if (isset($_POST['apagar'])) {
        $sql_delete = "DELETE FROM pedidos WHERE id='$pedido_id'";
        $conn = new mysqli('localhost', 'root', '', 'cart_db');

        if ($conn->connect_error) {
            die("Conexão falhou: " . $conn->connect_error);
        }

        if ($conn->query($sql_delete) === TRUE) {
            echo "Pedido apagado com sucesso.<br>";
        } else {
            echo "Erro ao apagar pedido: " . $conn->error . "<br>";
        }

        $conn->close();
        header("Location: " . $_SERVER['PHP_SELF']); 
        exit; 
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pedidos</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 95%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }

        table, th, td {
            border: 1px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #9000ff;
            color: white;
        }

        tr.entregue {
            background-color: #90ee90; 
        }

        .btn {
            padding: 5px 10px;
            color: white;
            background-color: #9000ff;
            border: none;
            cursor: pointer;
            border-radius: 4px;
        }

        .btn-apagar {
            background-color: #ff0000; 
        }

        .logo {
    font-size: 25px;
    font-weight: bold;
    text-decoration: none;
    color: #9000ff;
    align-items: center;
    justify-content: center;
    margin-left: 15px;
}


.header-config img {
   height: 60px;
   width: 60px;
}
    </style>
</head>
<body>

<div class="header-config">
    <a href="Index.php" class="logo"><img src="Personalização do site/TopLevelLogo2.webp" alt="logo" height="80" width="80" align="center">TopLevel</a>
</div>

<div class="container">
    <h1>Lista de Pedidos</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome</th>
                <th>Número</th>
                <th>Email</th>
                <th>Método de Pagamento</th>
                <th>Apto/Número</th>
                <th>Rua</th>
                <th>Cidade</th>
                <th>Estado</th>
                <th>Total de Produtos</th>
                <th>Preço Total</th>
                <th>Entregue</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
    <?php
    $conn = new mysqli('localhost', 'root', '', 'cart_db');

    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    $sql = "SELECT id, nome, telefone, email, `method`, bairro, endereco, cidade, estado, total_products, total_price, status FROM pedidos";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $entregue = $row['status'] === 'entregue' ? 'checked' : '';
            $linha_entregue = $row['status'] === 'entregue' ? 'class="entregue"' : '';

            echo "<tr $linha_entregue>
                    <td>" . $row['id'] . "</td>
                    <td>" . $row['nome'] . "</td>
                    <td>" . $row['telefone'] . "</td>
                    <td>" . $row['email'] . "</td>
                    <td>" . $row['method'] . "</td>
                    <td>" . $row['bairro'] . "</td>
                    <td>" . $row['endereco'] . "</td>
                    <td>" . $row['cidade'] . "</td>
                    <td>" . $row['estado'] . "</td>
                    <td>" . $row['total_products'] . "</td>
                    <td>R$ " . number_format($row['total_price'], 2, ',', '.') . "</td>
                    <td>
                        <form method='POST' style='display: inline;'>
                            <input type='hidden' name='pedido_id' value='" . $row['id'] . "'>
                            <input type='hidden' name='current_status' value='" . $row['status'] . "'>
                            <input type='checkbox' name='entregar' $entregue onchange='this.form.submit()'>
                        </form>
                    </td>
                    <td>
                        <form method='POST' style='display: inline;'>
                            <input type='hidden' name='pedido_id' value='" . $row['id'] . "'>
                            <button type='submit' name='apagar' class='btn btn-apagar'>Apagar</button>
                        </form>
                    </td>
                  </tr>";
        }
    } else {
        echo "<tr><td colspan='13'>Nenhum pedido encontrado</td></tr>";
    }

    $conn->close();
    ?>
</tbody>

    </table>
</div>

</body>
</html>
