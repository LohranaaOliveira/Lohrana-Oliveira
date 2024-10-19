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
    <title>Headset Echo</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<div class="navigation">
    <div class="navigation-left">
      <a href="products.php" style="color: #fff;">Início</a>
      <span>|</span>
      <a>Headset Echo </a>
    </div>
    <div class="navigation-right">
      <a href="Cadeira Gamer Impact.php" style="color: #fff;">&lt; Anterior</a>
      <span>|</span>
      <a href="headset L503.php" style="color: #fff;">Próximo &gt;</a>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div class="produto">
    <div class="container3">
      <div class="left-side">
        <img src="produtosimg/acessorios/headset-echo.webp
        " alt="Product Image">
        <p>O Headset Echo é um fone de ouvido premium nas cores preto e vermelho, ideal para gamers e entusiastas de som
          que buscam qualidade superior. Com um microfone de alta definição e tecnologia de cancelamento de ruído
          aprimorada, ele proporciona uma experiência de comunicação cristalina, ideal para ambientes competitivos e
          profissionais.
        </p>
      </div>
      <div class="right-side">
        <h2 class="product-title">Headset Echo</h2>
        <p class="product-price"><s>R$ 149,99</s> R$ 134,99</p>
        <p class="product-promotion">no PIX (10% de desconto)</p>


        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto
          <li>Cores: Preto e Vermelho, com um design agressivo e moderno.
            <li>Microfone: De alta definição com cancelamento de ruído avançado, garantindo clareza total em jogos e chamadas.
              <li>Almofadas: Almofadas de espuma de memória que se ajustam confortavelmente à orelha, oferecendo isolamento acústico e conforto prolongado.
                <li>Compatibilidade: Universal, funcionando com PCs, consoles, dispositivos móveis e tablets, com suporte a conexões via USB e P2 (3.5mm).
                  <li>Conexão: Disponível em versões USB, P2, e bluetooth com suporte a áudio surround virtual 7.1 para maior imersão.
                    <li>Som: Áudio de qualidade superior com graves profundos e agudos precisos, proporcionando uma experiência de som surround perfeita para jogos e filmes.
                      <li>Iluminação LED: Detalhes com luzes vermelhas LED, destacando o design moderno do headset.
                        <li>Durabilidade: Estrutura reforçada e leve, ideal para longas sessões de jogo.
                          <li>Controles de áudio: Integrados no próprio fone, permitindo ajustes de volume e mute com facilidade.</li>
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
