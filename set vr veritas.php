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
            <a>Set VR Veritas</a>
        </div>
        <div class="navigation-right">
            <a href="playbox XZ edição ouro.php" style="color: #fff;">&lt; Anterior</a>
            <span>|</span>
            <a href="Wave Gen RX.php" style="color: #fff;">Próximo &gt;</a>
        </div>
        <div style="clear: both;"></div>
    </div>

    <div class="produto">
        <div class="container3">
            <div class="left-side">
                <img src="produtosimg/consoles/set-VR-veritas.webp" alt="Product Image">
                <p>O Set VR Veritas redefine os limites da realidade virtual, oferecendo um desempenho excepcional e uma
                    experiência imersiva de última geração. Com uma resolução impressionante de 8K Ultra HD, cada
                    detalhe ganha vida com clareza e nitidez incríveis. A taxa de atualização de 240 Hz proporciona
                    movimentos ultrafluidos e uma experiência visual verdadeiramente imersiva.
                    <br></br>
                    O amplo campo de visão de 150 graus cria uma visão panorâmica envolvente e realista, permitindo que
                    você mergulhe completamente nos ambientes virtuais. A conectividade Bluetooth 5.1 e Wi-Fi 6E
                    garantem uma conexão rápida e estável para transmitir conteúdo e jogar online sem interrupções.
                    <br></br>
                    O áudio espacial 3D com som surround de alta definição mergulha você em uma paisagem sonora rica e
                    envolvente, permitindo que você localize sons com precisão e desfrute de uma experiência de áudio
                    realista e imersiva.
                    <br></br>
                    Compatível com dispositivos PC, consoles e smartphones de última geração, o Set VR
                </p>
            </div>
            <div class="right-side">
                <h2 class="product-title">Set VR Veritas</h2>
                <p class="product-price">Preço: R$ 3.149,99</p>
                <p class="product-promotion">no PIX (10% de desconto)</p>
                <p class="products"> ou R$ R$ 3.469,98 em 10x de R$ 346,99 sem juros</p>
        
        

        <form id="comprar-form" action="" method="POST">
          <input type="hidden" name="produto" value="Cadeira Gamer Impact">
          <input type="hidden" name="quantidade" id="produto-quantidade" value="1">
          <button type="submit" class="buy-now-button4">Comprar agora</button>
        </form>

        <p class="product-info">Informações do produto
                    <li> Resolução: 8K Ultra HD
                    <li>Taxa de atualização: 240 Hz
                    <li>Campo de visão: 150 graus
                    <li>Conectividade: Bluetooth 5.1 e Wi-Fi 6E
                    <li>Rastreamento de movimento: Sistema de rastreamento de 8 eixos
                    <li>Áudio: Áudio espacial 3D com som surround de alta definição
                    <li>Controles: Controladores avançados com sensor de pressão e feedback háptico
                    <li>Rastreamento ocular: Rastreamento ocular de alta precisão com reconhecimento de expressões
                        faciais
                    <li>Conforto: Design ergonômico com ajustes personalizáveis para máximo conforto
                    <li>Compatibilidade: Compatível com dispositivos PC, consoles e smartphones de última geração
                    <li>Aplicativos e conteúdo: Acesso a uma vasta biblioteca de jogos, experiências e aplicativos de
                        realidade virtual</li>
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
