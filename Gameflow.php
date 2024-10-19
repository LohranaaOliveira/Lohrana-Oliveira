<?php
ob_start(); 
@include 'config.php';
session_start();

if (isset($_SESSION['email'])) {
    if ($_SESSION['email'] === 'toplevelbrasil@gmail.com') {
        include 'headeradm.php'; 
    } else {
        include 'headeruser.php'; 
    }
} else {
    include 'header.php'; 
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_SESSION['email'])) {
        $productName = basename(__FILE__, ".php"); 
        $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1; 

        $productQuery = "SELECT * FROM products WHERE name = '$productName'";
        $result = mysqli_query($conn, $productQuery);

        if (mysqli_num_rows($result) > 0) {
            $product = mysqli_fetch_assoc($result);
            $productName = $product['name'];
            $productPrice = $product['price'];
            $productImage = $product['image'];

            $checkCart = "SELECT * FROM cart WHERE name = '$productName'";
            $cartResult = mysqli_query($conn, $checkCart);

            if (mysqli_num_rows($cartResult) > 0) {
                $cartProduct = mysqli_fetch_assoc($cartResult);
                $newQuantity = $cartProduct['quantity'] + $quantity;
                $updateCartQuery = "UPDATE cart SET quantity = '$newQuantity' WHERE name = '$productName'";
                mysqli_query($conn, $updateCartQuery);
            } else {
                $insertCartQuery = "INSERT INTO cart (name, price, image, quantity) 
                                    VALUES ('$productName', '$productPrice', '$productImage', '$quantity')";
                mysqli_query($conn, $insertCartQuery);
            }

            header('Location: cart.php');
            exit;
        }
    } else {
        header('Location: login.php');
        exit;
    }
}

ob_end_flush(); 
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="Personalização do site/TopLevelLogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="assents/css/Global.css">
    <link rel="stylesheet" href="assents/css/Produtos.css">
    <link rel="stylesheet" href="assents/css/index.css">
    <link rel="stylesheet" href="assents/css/userstl.css">
    <title>Gameflow</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<div class="navigation">
        <div class="navigation-left">
            <a href="products.php" style="color: #fff;">Início</a>
            <span>|</span>
            <a>Gameflow</a>
        </div>
        <div class="navigation-right">
            <a href="Wave Gen RX.php" style="color: #fff;">&lt; Anterior</a>
            <span>|</span>
            <a href="playbox XZ edição ouro.php" style="color: #fff;">Próximo &gt;</a>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="produto">
        <div class="container3">
            <div class="left-side">
                <img src="produtosimg/consoles/gameflow.webp" alt="Product Image">
                <p>O GameFlow é um console de jogos projetado para proporcionar uma experiência de jogo envolvente e
                    acessível. Com um design moderno e elegante, este console de desempenho médio é perfeito para
                    jogadores que buscam entretenimento de qualidade sem comprometer o orçamento.</p>
            </div>
            <div class="right-side">
                <h2 class="product-title">Gameflow</h2>
                <p class="product-price">Preço: <s>R$ 2.899,99</s> R$ 2.219,99</p>
                <p class="product-promotion">no PIX (10% de desconto)</p>
                <p class="products"> ou R$ R$ 2.609,99 em 10x de R$ 260,99 sem juros</p>
        

        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto
                    <li>Processador: Quad-Core NexGen 1.5 GHz
                    <li>Memória RAM: 2 GB DDR3
                    <li>Armazenamento interno: 16 GB de armazenamento em flash (expansível com cartão de memória)
                    <li> Gráficos: Chip gráfico NexGraphics com suporte para resolução máxima de 720p
                    <li> Unidade óptica: Leitor de Blu-ray/DVD
                    <li> Conectividade: Wi-Fi integrado para acesso à internet
                    <li> Conexões: 2 portas USB 3.0, 1 porta HDMI, 1 porta Ethernet, 1 porta de alimentação, 1 porta de
                        áudio
                    <li> Sistema operacional: NexOS (uma interface personalizada baseada em Linux)
                    <li> Controladores: Dois controladores sem fio com suporte a vibração
                    <li> Recursos de áudio: Áudio estéreo de qualidade média com suporte a saída de áudio digital
                    <li> Fonte de alimentação: Adaptador AC de 12V, 2A</li>
            </div>
        </div>
    </div>

<?php include 'cartsidebar.php'; ?>
<?php include 'rodape.php'; ?>

<script>
document.getElementById('quantity').addEventListener('change', function() {
  document.getElementById('produto-quantidade').value = this.value;
});
</script>

</body>
</html>
