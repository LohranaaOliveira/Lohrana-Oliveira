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
    <title>Teclado Mecânico CO-21</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

  <div class="navigation">
    <div class="navigation-left">
      <a href="products.php" style="color: #fff;">Início</a>
      <span>|</span>
      <a>Teclado Mecânico CO-21</a>
    </div>
    <div class="navigation-right">
      <a href="Mouse Wireless Blaze.php" style="color: #fff;">&lt; Anterior</a>
      <span>|</span>
      <a href="Teclado Mecânico Spartan.php" style="color: #fff;">Próximo &gt;</a>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div class="produto">
    <div class="container3">
      <div class="left-side">
        <img src="produtosimg/acessorios/Teclado Mecânico CO-21.webp" alt="Product Image">
        <p>O Teclado Mecânico CO-21 oferece um desempenho excepcional e uma experiência de digitação agradável.
          Equipado com switches mecânicos de alta qualidade, cada pressionamento das teclas é responsivo e preciso. Com
          uma vida útil de 50 milhões de pressionamentos, o teclado oferece durabilidade e confiabilidade a longo prazo.
          <br></br>
          A retroiluminação RGB personalizável adiciona um toque de estilo ao seu teclado. Com uma ampla gama de cores e
          efeitos de iluminação dinâmicos, você pode personalizar a aparência do teclado de acordo com suas
          preferências.
          <br></br>
          O cabo USB destacável oferece conveniência e facilita o transporte do teclado. Você pode conectar e
          desconectar o teclado facilmente, tornando-o adequado para uso em casa ou em movimento.
          <br></br>
          O layout compacto e ergonômico do Teclado Mecânico Spartan economiza espaço em sua mesa, proporcionando
          conforto durante longas sessões de digitação. O descanso de pulso ergonômico removível oferece suporte
          adicional para reduzir a fadiga durante o uso prolongado.
          <br></br>
          Com tecnologia anti-ghosting avançada e N-key Rollover, o teclado permite que você pressione várias teclas ao
          mesmo tempo, garantindo a precisão e a responsividade necessárias para jogos e digitação rápida.
          <br></br>
          O software dedicado permite que você personalize as teclas e os efeitos de iluminação de acordo com suas
          preferências. Você pode atribuir macros, ajustar a sensibilidade das teclas e criar perfis personalizados para
          atender às suas necessidades específicas.
        </p>
      </div>
      <div class="right-side">
        <h2 class="product-title">Teclado Mecânico CO-21</h2>
        <p class="product-price">R$ 220,99</p>
        <p class="product-promotion">no PIX (10% de desconto)</p>
        <p class="products"> ou R$ R$ 200,97 em 3x de R$ 66,99 sem juros</p>
        
        

        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto
          <li> Interruptores: Switches mecânicos de alta qualidade
          <li> Durabilidade: Vida útil dos interruptores de 50 milhões de pressionamentos
          <li> Retroiluminação: Retroiluminação RGB personalizável com efeitos de iluminação dinâmicos
          <li> Conectividade: Cabo USB destacável
          <li> Layout: Layout compacto e ergonômico
          <li> Anti-ghosting: Tecnologia anti-ghosting avançada com N-key Rollover
          <li> Descanso de pulso: Descanso de pulso ergonômico removível
          <li> Software de personalização: Software dedicado para personalização de teclas e efeitos de iluminação
          <li> Construção: Estrutura em metal resistente e de alta qualidade
          <li> Teclas multimídia: Teclas dedicadas para controle de mídia
          <li> Teclas adicionais: Conjunto de teclas adicionais incluídas para personalização</li>
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
