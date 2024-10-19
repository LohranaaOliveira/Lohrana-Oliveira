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
    <title>Política de Reembolso</title>
</head>

<body>
  <script src="https://kit.fontawesome.com/87a451ecf9.js" crossorigin="anonymous"></script>
    
  <div class="textos5" id="t4">
    <h1>Política de reembolso</h1>
          </div>
          <div class="text-container">
              <p>Na TopLevel, a satisfação dos nossos clientes é nossa prioridade. Sabemos que, às vezes, pode ser necessário devolver ou trocar um produto, e estamos aqui para tornar esse processo o mais simples possível. Abaixo, detalhamos as diretrizes da nossa política de reembolso.<br>

1. Condições Gerais para Reembolso<br>
1.1. Para solicitar um reembolso, o produto deve ser devolvido em sua embalagem original, sem sinais de uso ou danos, com todos os acessórios e documentos incluídos.<br>
1.2. O prazo para solicitar um reembolso é de até 7 dias corridos a partir da data de recebimento do produto, conforme estabelecido pelo Código de Defesa do Consumidor (Direito de Arrependimento).<br>
1.3. O reembolso será efetuado após a análise e confirmação das condições do produto devolvido.<br>

2. Processo de Devolução e Solicitação de Reembolso<br>
2.1. Para iniciar o processo de devolução, entre em contato com nossa equipe de atendimento ao cliente pelo e-mail suporte@toplevel.com, informando o número do pedido e o motivo da devolução.<br>
2.2. Nossa equipe fornecerá as instruções detalhadas para a devolução, incluindo o endereço para envio.<br>
2.3. O cliente será responsável pelo custo do frete de devolução, exceto nos casos de produtos com defeito ou envio incorreto por parte da TopLevel.<br>
2.4. Assim que o produto for recebido e inspecionado, enviaremos um e-mail notificando sobre a aprovação ou rejeição do reembolso.<br>

3. Reembolsos para Produtos com Defeito<br>
3.1. Se o produto adquirido apresentar defeito de fabricação, o cliente poderá solicitar a troca ou o reembolso no prazo de até 30 dias corridos após o recebimento.<br>
3.2. Produtos com defeito devem ser devolvidos para avaliação técnica. Após a confirmação do defeito, o cliente poderá optar pelo reembolso total ou pela substituição do produto por outro igual ou de valor equivalente.<br>
3.3. O frete de devolução e reenvio será coberto pela TopLevel em casos de defeito de fabricação.<br>

4. Prazo para Reembolso<br>
4.1. O prazo para processamento do reembolso pode variar de acordo com o método de pagamento original:<br>

Cartão de crédito: o estorno será solicitado junto à administradora do cartão e poderá levar de 5 a 10 dias úteis para ser refletido na fatura do cliente, conforme as políticas da operadora.<br>
Boleto bancário: o reembolso será feito via depósito bancário em até 10 dias úteis, após a confirmação dos dados bancários do cliente.<br>
Outros métodos de pagamento: o prazo pode variar conforme a plataforma de pagamento utilizada.<br>
5. Produtos não elegíveis para Reembolso<br>
5.1. Não realizamos reembolso para produtos que não atendam aos seguintes critérios:<br>

Produtos que foram utilizados ou danificados pelo cliente.<br>
Jogos e conteúdos digitais que tenham sido ativados ou baixados, exceto em casos de defeito técnico.<br>
Produtos em promoção especial, marcados como "sem devolução", exceto em casos de defeito.<br>
6. Cancelamento de Pedido<br>
6.1. O cliente pode cancelar o pedido e solicitar o reembolso a qualquer momento antes da confirmação de envio.<br>
6.2. Após o envio do pedido, o processo de cancelamento será tratado como devolução, e o cliente deverá seguir o processo descrito na seção 2 desta política.

7. Exceções e Situações Especiais<br>
7.1. Produtos recebidos fora do prazo estipulado ou que não atendam às condições de devolução podem ser devolvidos ao cliente, sem o direito a reembolso.<br>
7.2. Caso o cliente não receba o produto dentro do prazo de entrega estipulado e a responsabilidade seja da transportadora, nossa equipe tomará as providências necessárias para o envio de um novo produto ou o reembolso total do pedido, conforme a preferência do cliente.<br>

8. Contato<br>
Se você tiver qualquer dúvida sobre nossa política de reembolso ou precisar de assistência para realizar uma devolução, entre em contato com nossa equipe de suporte pelo e-mail suporte@toplevel.com ou pelo telefone (xx) xxxxx-xxxx.<br></p>
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
  