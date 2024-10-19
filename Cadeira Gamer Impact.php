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
      <a>Cadeira Gamer Impact</a>
    </div>
    <div class="navigation-right">
    <a>&lt; Anterior</a>
        <span>|</span>
        <a href="Cadeira Gamer Mach.php" style="color: #fff;">Próximo &gt;</a>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div class="produto">
    <div class="container3">
      <div class="left-side">
        <img src="produtosimg/acessorios/cadeira-gamer-impact.webp" alt="Product Image">
        <p>Esta é uma cadeira gamer de alta qualidade, com um design sofisticado e minimalista nas cores preto com
          detalhes em branco. Indicada para aqueles que buscam um nível superior de conforto e durabilidade, ela é
          perfeita para longas sessões de jogo ou trabalho. Com acabamento premium e detalhes que realçam sua estética,
          ela proporciona um toque moderno e elegante ao ambiente.</p>
        <p>Além disso, a cadeira conta com recursos avançados, como ajuste de altura, encosto reclinável e rodízios
           silenciosos, proporcionando uma experiência de uso confortável e sem ruídos.</p>
        <p>Ideal para gamers que passam horas em frente ao computador, a Cadeira Gamer Impact também é excelente para
           ambientes de trabalho, garantindo o máximo de conforto e suporte para a coluna, prevenindo dores e
           desconfortos ao longo do dia.</p>
      </div>
      <div class="right-side">
        <h2 class="product-title">Cadeira Gamer Impact</h2>
        <p class="product-price">Preço: R$ 799,99</p>
        <p class="product-promotion">no PIX (10% de desconto)</p>
        <p class="products"> ou R$ 839,98 em 10x de R$ 83,99 sem juros</p>
        

        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto:
          <li>Estofado premium: O revestimento em couro sintético de alta qualidade oferece maior durabilidade e um toque macio, além de facilitar a limpeza.</li>
          <li>Encosto ergonômico: Proporciona suporte total para a coluna, com design que favorece a postura, evitando dores após horas de uso.</li>
          <li>Apoios de braço ajustáveis: Oferecem maior flexibilidade, permitindo o ajuste para diferentes alturas e posições, promovendo o máximo de conforto.</li>
          <li>Base reforçada: Construída com material resistente e durável, a base possui rodízios de alta qualidade para movimentação suave e silenciosa.</li>
          <li>Encosto reclinável: Com mecanismo de reclinação ajustável, permitindo que o usuário relaxe em diferentes ângulos.</li>
          <li>Suporte de peso: Estrutura robusta que suporta um peso elevado, ideal para diferentes perfis de usuários.</li>
          <li>Design moderno: A aparência marcante do encosto com detalhes geométricos, além dos contornos em branco, destaca-se em setups gamers e ambientes de trabalho.</li>
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
