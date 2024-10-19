<?php

@include 'config.php';
$select_products = mysqli_query($conn, "SELECT * FROM `products`");

if(isset($_POST['add_to_cart'])){

  $product_name = $_POST['product_name'];
  $product_price = $_POST['product_price'];
  $product_image = $_POST['product_image'];
  $product_quantity = 1;

  $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

  if(mysqli_num_rows($select_cart) > 0){
      $message[] = 'product already added to cart';
  }else{
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'product added to cart succesfully';
  }

}

if(isset($_POST['add_to_cart'])){
$product_name = $_POST['product_name'];
$product_price = $_POST['product_price'];
$product_image = $_POST['product_image'];
$product_quantity = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : 1;

$select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

if(mysqli_num_rows($select_cart) > 0){
    $message[] = 'Product already added to cart';
}else{
    $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
    $message[] = 'Product added to cart successfully';
}
}

if (isset($_POST['update_quantity'])) {
$product_id = $_POST['update_quantity_id'];
$new_quantity = $_POST['update_quantity'];

$update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = '$new_quantity' WHERE id = '$product_id'");
$message[] = 'Quantity updated successfully';
}

if (isset($_POST['decrement'])) {
$product_id = $_POST['update_quantity_id'];
$current_quantity = mysqli_query($conn, "SELECT quantity FROM `cart` WHERE id = '$product_id'");
$quantity = mysqli_fetch_assoc($current_quantity)['quantity'];
if ($quantity > 1) {
    $update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = quantity - 1 WHERE id = '$product_id'");
}
$message[] = 'Quantity decreased successfully';
}

if (isset($_POST['increment'])) {
$product_id = $_POST['update_quantity_id'];
$update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = quantity + 1 WHERE id = '$product_id'");
$message[] = 'Quantity increased successfully';
}

  
  if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = 1;

    $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE name = '$product_name'");

    if (mysqli_num_rows($select_cart) > 0) {
      $message[] = 'Product already added to cart';
    } else {
      $insert_product = mysqli_query($conn, "INSERT INTO `cart`(name, price, image, quantity) VALUES('$product_name', '$product_price', '$product_image', '$product_quantity')");
      $message[] = 'Product added to cart successfully';
    }
  }

  if (isset($_POST['update_quantity'])) {
    $product_id = $_POST['update_quantity_id'];
    $new_quantity = $_POST['update_quantity'];

    $update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = '$new_quantity' WHERE id = '$product_id'");
    $message[] = 'Quantity updated successfully';
  }

  if (isset($_POST['decrement'])) {
    $product_id = $_POST['update_quantity_id'];
    $current_quantity = mysqli_query($conn, "SELECT quantity FROM `cart` WHERE id = '$product_id'");
    $quantity = mysqli_fetch_assoc($current_quantity)['quantity'];
    if ($quantity > 1) {
      $update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = quantity - 1 WHERE id = '$product_id'");
    }
    $message[] = 'Quantity decreased successfully';
  }

  if (isset($_POST['increment'])) {
    $product_id = $_POST['update_quantity_id'];
    $update_quantity = mysqli_query($conn, "UPDATE `cart` SET quantity = quantity + 1 WHERE id = '$product_id'");
    $message[] = 'Quantity increased successfully';
  }

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

if (isset($_SESSION['message'])) {
    echo "<script>showNotification('" . $_SESSION['message'] . "');</script>";
    unset($_SESSION['message']); 
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="mage/x-icon" href="Personalização do site\TopLevelLogo.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="assents/css/Global.css">
    <link rel="stylesheet" href="assents/css/user.css">
    <title>Política de Envio</title>
</head>

<body>
  <script src="https://kit.fontawesome.com/87a451ecf9.js" crossorigin="anonymous"></script>
    
      
  <div class="textos5" id="t4">
    <h1>Política de envio</h1>
          </div>
          <div class="text-container">
              <p>Na TopLevel, queremos garantir que sua experiência de compra seja fácil e que seus produtos cheguem até você de forma rápida e segura. A seguir, estão os detalhes da nossa política de envio.
<br>
1. Regiões de Entrega<br>
1.1. Realizamos entregas em todo o território nacional, cobrindo todas as capitais e principais cidades do Brasil.<br>
1.2. No momento, não realizamos envios internacionais, mas estamos trabalhando para expandir nossas operações.<br>

2. Prazos de Entrega<br>
2.1. O prazo de entrega é calculado com base na sua localização e no método de envio selecionado.<br>
2.2. O prazo estimado de entrega é exibido durante o processo de compra e começa a contar a partir da confirmação do pagamento.<br>
2.3. Pedidos realizados em finais de semana ou feriados serão processados no próximo dia útil.<br>

3. Métodos de Envio<br>
3.1. Oferecemos diversas opções de envio, que podem variar de acordo com a sua região:<br>

Entrega Padrão: opção mais econômica, com prazos que variam entre 5 a 15 dias úteis.<br>
Entrega Expressa: opção mais rápida, com prazos entre 2 a 5 dias úteis (disponível para algumas regiões).<br>
Retirada na Loja Parceira: em regiões com parceiros, você pode optar por retirar o produto em uma loja indicada durante a compra.<br>
4. Frete
4.1. O valor do frete é calculado com base no peso total do pedido, na localização de entrega e no método de envio selecionado.<br>
4.2. Oferecemos frete grátis para pedidos acima de um valor determinado, que será informado no site durante as promoções ou em campanhas específicas.<br>
4.3. Durante eventos promocionais, podem ser aplicadas tarifas de frete reduzido ou frete gratuito, conforme anunciado no site.<br>

5. Processamento de Pedidos
5.1. Após a confirmação do pagamento, o pedido será processado e preparado para envio. O tempo de processamento varia de 1 a 3 dias úteis.<br>
5.2. Assim que o pedido for enviado, você receberá um e-mail de confirmação com os detalhes de rastreamento para acompanhar a entrega.<br>
5.3. Se houver algum problema com a disponibilidade de estoque, nossa equipe entrará em contato para informar o prazo de reabastecimento ou oferecer alternativas, como a troca ou reembolso.</p>
            </div>
            <div class="text-container">
              <p>6. Rastreamento de Pedidos<br>
6.1. Para sua conveniência, todos os pedidos possuem um código de rastreamento. Assim que o pedido for despachado, você receberá um e-mail com o número de rastreamento e o link para acompanhar a entrega.<br>
6.2. O status do envio também pode ser consultado diretamente em sua conta no TopLevel.<br>

7. Tentativas de Entrega e Endereço Incorreto<br>
7.1. A transportadora realizará até 3 tentativas de entrega no endereço informado. Caso todas as tentativas falhem, o pedido será devolvido ao nosso centro de distribuição.<br>
7.2. Se o pedido for devolvido devido a um erro no endereço fornecido ou por impossibilidade de entrega, entraremos em contato para confirmar o endereço correto e realizar um novo envio. Nesse caso, o custo do frete poderá ser cobrado novamente.<br>
7.3. É responsabilidade do cliente garantir que o endereço de entrega esteja correto e completo no momento da compra.<br>

8. Atrasos e Problemas com a Entrega<br>
8.1. Embora nos esforcemos para garantir que seu pedido chegue no prazo, atrasos podem ocorrer devido a fatores fora de nosso controle, como condições climáticas, greves ou problemas com a transportadora.<br>
8.2. Se houver um atraso significativo ou o pedido não chegar dentro do prazo estimado, entre em contato com nossa equipe de suporte, e faremos o possível para resolver o problema.<br>

9. Produtos Danificados ou Extraviados<br>
9.1. Caso seu produto chegue danificado ou extraviado durante o transporte, entre em contato conosco imediatamente para que possamos investigar e tomar as medidas necessárias.<br>
9.2. Dependendo da situação, podemos providenciar o reenvio do produto, troca ou reembolso. Por favor, entre em contato em até 7 dias corridos após o recebimento para relatar problemas.<br>

10. Contato<br>
Para quaisquer dúvidas ou problemas relacionados ao envio, entre em contato com nosso time de suporte pelo e-mail suporte@toplevel.com ou pelo telefone (xx) xxxxx-xxxx.<br>

</p>
            </div>
  
  
            <?php include 'cartsidebar.php'; ?>
<?php include 'rodape.php'; ?>
<script> 
const decrementButton = document.querySelector('.decrement');
const incrementButton = document.querySelector('.increment');
const quantityInput = document.getElementById('quantity');

incrementButton.addEventListener('click', function () {
    let currentValue = parseInt(quantityInput.value);
    let maxValue = parseInt(quantityInput.max);
    if (currentValue < maxValue) {
        quantityInput.value = currentValue + 1;
    }
});

decrementButton.addEventListener('click', function () {
    let currentValue = parseInt(quantityInput.value);
    let minValue = parseInt(quantityInput.min);
    if (currentValue > minValue) {
        quantityInput.value = currentValue - 1;
    }
});

</script>
  </body>
  </html>
  