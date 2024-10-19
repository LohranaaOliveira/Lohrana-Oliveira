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
    <title>Cadeira Gamer Impact</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<div class="navigation">
    <div class="navigation-left">
      <a href="products.php" style="color: #fff;">Início</a>
      <span>|</span>
      <a>Wave Gen RX</a>
    </div>
    <div class="navigation-right">
      <a href="set vr veritas.php" style="color: #fff;">&lt; Anterior</a>
      <span>|</span>
      <a>Próximo &gt;</a>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div class="produto">
    <div class="container3">
      <div class="left-side">
        <img src="produtosimg/consoles/Wave Gen RX.webp" alt="Product Image">
        <p>Prepare-se para mergulhar em uma nova dimensão de entretenimento com o Wave Gen RX, o console de jogos
          revolucionário que está redefinindo a maneira como você joga. Com recursos inovadores e desempenho de ponta,
          este console é a escolha definitiva para os verdadeiros entusiastas de jogos.</p>
        <p>Experimente gráficos ultra-realistas em resolução 4K, com detalhes nítidos e cores vibrantes que ganham vida
          em sua tela. Cada cenário, cada personagem e cada explosão são apresentados com uma clareza impressionante,
          proporcionando uma imersão total em seus jogos favoritos.</p>
      </div>
      <div class="right-side">
        <h2 class="product-title">Wave Gen RX</h2>
        <p class="product-price">Preço: R$ 3.479,99</p>
        <p class="product-promotion">no PIX (10% de desconto)</p>
        <p class="products"> ou R$ 3.849,00 em 10x de R$ 384,90 sem juros</p>
        
        

        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto
          <li>Processador: Octa-core de 2.5 GHz
          <li>Memória RAM: 8 GB
          <li>Armazenamento interno: 256 GB
          <li>Gráficos: Chip gráfico avançado com suporte para resolução 4K
          <li>Conectividade: Wi-Fi 802.11ac, Bluetooth 5.0
          <li>Portas: HDMI, USB 3.0, Ethernet
          <li>Resolução de saída de vídeo: Suporte para até 1080p
          <li>Áudio: Som estéreo de alta definição com suporte para Dolby Digital
          <li>Controles: Controle sem fio ergonômico com sensor de movimento
          <li>Sistema operacional: Personalizado, baseado em uma plataforma de jogos
          <li>Jogos suportados: Amplamente compatível com uma variedade de jogos populares
          <li>Recursos adicionais: Suporte para streaming de conteúdo multimídia, integração com serviços online de
            jogos e redes sociais
        </p>
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
