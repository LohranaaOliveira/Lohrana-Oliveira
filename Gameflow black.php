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
    <title>GameFlow Black</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

<div class="navigation">
    <div class="navigation-left">
        <a href="products.php" style="color: #fff;">Início</a>
        <span>|</span>
        <a>GameFlow Black</a>
    </div>
    <div class="navigation-right">
        <a>&lt; Anterior </a>
        <span>|</span>
        <a href="Gameflow.php" style="color: #fff;">Próximo &gt;</a>
    </div>
    <div style="clear: both;"></div>
</div>

<div class="produto">
    <div class="container3">
      <div class="left-side">
        <img src="produtosimg/consoles/Gameflow Black.webp" alt="Product Image">
        <p>Apresentamos o GameFlow Black, projetado para redefinir a experiência gamer com desempenho impressionante e tecnologia de ponta. Com um design robusto e futurista, o GameFlow Black oferece um poder de processamento que transforma seus jogos em experiências imersivas, com gráficos de alta definição e tempos de resposta ultrarrápidos, ideal para jogadores exigentes que buscam o melhor em desempenho.</p>
      </div>
      <div class="right-side">
        <h2 class="product-title">GameFlow Black</h2>
        <p class="product-price">Preço: <s>R$ 5.000,00</s> R$ 4.500,00</p>
        <p class="product-promotion">no PIX (10% de desconto)</p>
        <p class="products"> ou R$ R$ 4.650,00 em 10x de R$ 465,00 sem juros</p>
        

        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto:
           <li> Processador: Octa-Core TurboX 3.2 GHz, capaz de rodar os jogos mais exigentes com fluidez extrema.
           <li>Memória RAM: 16 GB DDR6, garantindo multitarefa sem interrupções e tempos de carregamento praticamente inexistentes.
           <li>Armazenamento interno: 1 TB SSD de alta velocidade, com suporte para expansão via SSD externo.
           <li>Gráficos: Placa gráfica UltraVision 8K com suporte para Ray Tracing e HDR10, oferecendo resolução 4K e 8K em jogos compatíveis.
           <li>Unidade óptica: Leitor Blu-ray 4K Ultra HD para uma experiência de mídia de alta qualidade.
           <li>Conectividade: Wi-Fi 6 e Bluetooth 5.1 para máxima velocidade e estabilidade online.
           <li>Conexões: 4 portas USB-C 3.2, 1 porta HDMI 2.1, 1 porta Ethernet Gigabit, 1 porta óptica de áudio, 1 porta de alimentação.
           <li>Sistema Operacional: GameFlow OS, um sistema otimizado para performance, baseado em Linux.
           <li>Controladores: Dois controladores sem fio de precisão com resposta tátil avançada, gatilhos adaptativos e sensor de movimento.
           <li>Recursos de Áudio: Suporte a som surround 3D, com áudio espacial imersivo para uma experiência de som sem igual.
           <li>Fonte de alimentação: Fonte de alimentação interna de 100-240V com sistema de resfriamento inteligente para um desempenho eficiente e silencioso.</li>
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
