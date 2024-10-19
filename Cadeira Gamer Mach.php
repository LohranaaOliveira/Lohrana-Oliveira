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
    <title>Cadeira Gamer mach</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<div class="navigation">
    <div class="navigation-left">
      <a href="products.php" style="color: #fff;">Início</a>
      <span>|</span>
      <a>Cadeira Gamer mach</a>
    </div>
    <div class="navigation-right">
      <a href="Cadeira Gamer Impact.php" style="color: #fff;">&lt; Anterior</a>
      <span>|</span>
      <a href="Headset Echo.php" style="color: #fff;">Próximo &gt;</a>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div class="produto">
    <div class="container3">
      <div class="left-side">
        <img src="produtosimg/acessorios/cadeira-gamer-mach.webp" alt="Product Image">
        <p>Esta é uma cadeira gamer de alta qualidade, com um design sofisticado e minimalista nas cores preto com detalhes em branco. Indicada para aqueles que buscam um nível superior de conforto e durabilidade, ela é perfeita para longas sessões de jogo ou trabalho. Com acabamento premium e detalhes que realçam sua estética, ela proporciona um toque moderno e elegante ao ambiente.
        </p>
      </div>
      <div class="right-side">
        <h2 class="product-title">Cadeira Gamer mach</h2>
        <p class="product-price"><s>R$ 649,99</s> R$ 584,99</p>
        <p class="product-promotion">no PIX (10% de desconto)</p>
        <p class="products"> ou R$ 609,98 em 10x de R$ 60,99 sem juros</p>
      

        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto
          <li>Estofado: Feito com material acolchoado e revestimento em couro sintético, o que facilita a limpeza e
            aumenta a durabilidade.
          <li>Apoio de braço: Ajustável, proporcionando conforto extra e suporte adequado para os braços.
          <li>Ajuste de altura: A cadeira possui sistema de ajuste de altura a gás, permitindo a personalização conforme
            a necessidade do usuário.
          <li>Base giratória: Feita em aço resistente, com rodízios que permitem fácil movimentação e estabilidade.
          <li>Encosto reclinável: Oferece a possibilidade de inclinação, ideal para momentos de relaxamento.</li>
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
