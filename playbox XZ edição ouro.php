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
    <title>Playbox XZ Edição Ouro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body>

  <div class="navigation">
    <div class="navigation-left">
      <a href="products.php" style="color: #fff;">Início</a>
      <span>|</span>
      <a>Playbox XZ Edição Ouro</a>
    </div>
    <div class="navigation-right">
      <a href="Gameflow.php" style="color: #fff;">&lt; Anterior</a>
      <span>|</span>
      <a href="set vr veritas.php" style="color: #fff;">Próximo &gt;</a>
    </div>
    <div style="clear: both;"></div>
  </div>

  <div class="produto">
    <div class="container3">
      <div class="left-side">
        <img src="produtosimg/consoles/playbox-XZ-edição-ouro.webp" alt="Product Image">
        <p>O console Playbox XZ Edição Ouro é a epítome do desempenho premium, projetado para proporcionar uma
          experiência de jogo incomparável. O processador Octa-Core HyperXtreme de 4.5 GHz oferece uma potência de
          processamento impressionante, garantindo um desempenho ultrarrápido e suave em todos os jogos.<br>
          <br>
          Com uma memória RAM de 128 GB DDR6, o Playbox XZ Edição Ouro permite a execução perfeita de jogos com gráficos
          exigentes e multitarefa intensiva. O armazenamento interno é fornecido por um SSD de 8 TB NVMe, que oferece
          uma quantidade generosa de espaço para armazenar uma vasta biblioteca de jogos e conteúdo multimídia.<br>
          <br>
          A placa de vídeo UltraGraphics Pro XZ Edition, com seus impressionantes 32 GB de memória GDDR6X, oferece
          gráficos de última geração em resolução 8K. Com suporte a ray tracing em tempo real e altas taxas de quadros,
          você pode desfrutar de imagens deslumbrantes e imersivas em seus jogos favoritos.<br>
          
        </p>
      </div>
      <div class="right-side">
        <h2 class="product-title">Playbox XZ Edição Ouro</h2>
        <p class="product-price">Preço: R$ 10.000,00</p>
        <p class="product-promotion">no PIX (10% de desconto)</p>
        <p class="products"> ou R$ R$ 11.000,00 em 10x de R$ 1.100 com juros de 5% ao mês</p>
        
      

        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto
          <li>Processador: Octa-Core HyperXtreme de 4.5 GHz
          <li> Memória RAM: 128 GB DDR6
          <li>Armazenamento interno: SSD de 8 TB NVMe
          <li>Gráficos: Placa de vídeo UltraGraphics Pro XZ Edition com 32 GB de memória GDDR6X
          <li>Unidade óptica: Leitor de Blu-ray UHD 8K
          <li>Conectividade: Wi-Fi 6E de alta velocidade e Bluetooth 5.2
          <li>Conexões: 6 portas USB 4.0, 4 portas HDMI 2.1, 2 portas Ethernet de 25 Gbps, 2 portas Thunderbolt 4
          <li>Sistema operacional: PlayOS (uma interface personalizada baseada em Linux)
          <li>Controladores: Dois controladores sem fio de última geração com feedback tátil avançado e gatilhos
            adaptáveis
          <li>Recursos de áudio: Áudio Dolby Atmos 9.1.4 surround com suporte a som 3D personalizado
          <li>Fonte de alimentação: Fonte de alimentação de alta eficiência de 1500W</li>
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
