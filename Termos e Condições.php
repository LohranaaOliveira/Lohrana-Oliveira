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
    <title>Termos e Condições</title>
</head>

<body>
  <script src="https://kit.fontawesome.com/87a451ecf9.js" crossorigin="anonymous"></script>
      
  <div class="textos5" >
    <h1>Termos e Condições</h1>
          </div>
          <div class="text-container">
              <p>1. Uso do Site 1.1. Para realizar compras no TopLevel, você deve ter 18 anos ou mais. 1.2. Ao se cadastrar, você garante que as informações fornecidas são verdadeiras e atuais. 1.3. Qualquer atividade ilegal ou comportamento prejudicial ao site resultará no encerramento imediato de sua conta.
<br>
2. Produtos e Preços 2.1. Os produtos vendidos no TopLevel incluem jogos, consoles e acessórios eletrônicos. 2.2. Todos os preços estão sujeitos a alterações sem aviso prévio. No entanto, as compras já realizadas manterão o valor acordado no momento do pagamento. 2.3. As promoções são válidas por tempo limitado ou enquanto durarem os estoques. Reservamo-nos o direito de alterar ou cancelar promoções a qualquer momento.
<br>
3. Pagamento e Segurança 3.1. Aceitamos diversos métodos de pagamento, incluindo cartões de crédito e débito, e plataformas de pagamento digital. 3.2. Todas as transações são processadas com segurança através de plataformas certificadas, garantindo a proteção dos seus dados financeiros. 3.3. O pagamento deve ser confirmado antes do envio dos produtos.
<br>
4. Entregas e Prazo 4.1. Realizamos entregas em todo o território nacional. O prazo de entrega pode variar de acordo com a região e será informado no momento da compra. 4.2. O prazo de entrega começa a contar a partir da confirmação do pagamento. 4.3. Não nos responsabilizamos por atrasos decorrentes de fatores externos, como greves ou problemas com transportadoras.
<br>
5. Devoluções e Reembolsos 5.1. Aceitamos devoluções de produtos não utilizados e em sua embalagem original no prazo de 7 dias corridos após o recebimento. 5.2. Caso o produto apresente defeitos de fabricação, realizaremos a troca ou reembolso sem custos adicionais ao cliente. 5.3. Para iniciar um processo de devolução ou troca, entre em contato com nossa equipe de atendimento ao cliente.</p>
            </div>
            <div class="text-container">
              <p>6. Garantia 6.1. A garantia dos produtos segue as normas dos fabricantes. Para saber mais, consulte os termos específicos do produto adquirido. 6.2. Produtos danificados por mau uso ou por fatores externos não são cobertos pela garantia.
              <br>
7. Responsabilidade 7.1. O TopLevel se isenta de qualquer responsabilidade por eventuais danos causados por produtos adquiridos no site que não tenham sido corretamente utilizados conforme as instruções. 7.2. Não nos responsabilizamos por falhas no site devido a fatores externos, como quedas de servidor, interrupção de serviços de internet ou força maior.
<br>
8. Privacidade 8.1. Respeitamos sua privacidade e garantimos que todas as informações pessoais coletadas sejam usadas apenas para processamento de pedidos e comunicação com o cliente. 8.2. Seus dados não serão vendidos, compartilhados ou divulgados a terceiros sem o seu consentimento, exceto quando exigido por lei.
<br>
9. Modificações dos Termos 9.1. O TopLevel reserva-se o direito de alterar estes Termos e Condições a qualquer momento, sem aviso prévio. Recomendamos que você verifique regularmente para estar atualizado com quaisquer mudanças. 9.2. O uso contínuo do site após alterações será considerado como aceitação das modificações.
<br>
10. Contato 10.1. Para dúvidas, reclamações ou sugestões, entre em contato com nosso suporte através do e-mail: toplevelbrasil@gmail.com ou pelo telefone (xx) xxxxx-xxxx.</p>
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
  