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
    <title>Política de Cookies</title>
</head>

<body>
  <script src="https://kit.fontawesome.com/87a451ecf9.js" crossorigin="anonymous"></script>
    


  <div class="textos5" >
    <h1>Política de Cookies</h1>
          </div>
          <div class="text-container">
              <p>Na TopLevel, utilizamos cookies e tecnologias semelhantes para melhorar a experiência do usuário, personalizar o conteúdo e entender melhor como você interage com nosso site. Esta política explica o que são cookies, como os usamos e como você pode controlá-los.<br>

1. O que são Cookies?<br>
Cookies são pequenos arquivos de texto armazenados em seu dispositivo (computador, smartphone, tablet) quando você visita um site. Eles contêm informações que ajudam a personalizar sua experiência de navegação e melhorar a funcionalidade do site, lembrando suas preferências e interações anteriores.<br>

2. Como Usamos os Cookies<br>
Utilizamos diferentes tipos de cookies em nosso site para várias finalidades, incluindo, mas não se limitando a:<br>

2.1. Cookies Necessários<br>
Esses cookies são essenciais para o funcionamento do nosso site e permitem que você navegue e utilize as funcionalidades principais, como a realização de compras e o login em sua conta. Sem esses cookies, o site não funcionaria corretamente.<br>

2.2. Cookies de Desempenho<br>
Esses cookies coletam informações sobre como os visitantes utilizam o site, como as páginas mais visitadas e se encontram erros em algumas partes. Utilizamos esses dados para melhorar o desempenho e o funcionamento do site.<br>

2.3. Cookies de Funcionalidade<br>
Esses cookies permitem que o site lembre-se de suas escolhas (como nome de usuário, idioma ou região) e forneça funcionalidades aprimoradas e mais personalizadas.<br>

2.4. Cookies de Publicidade<br>
Esses cookies são usados para exibir anúncios mais relevantes para você e seus interesses. Eles também limitam o número de vezes que você vê um anúncio e ajudam a medir a eficácia das campanhas publicitárias. Podemos compartilhar essas informações com terceiros, como redes de anúncios.<br>

2.5. Cookies de Redes Sociais<br>
Esses cookies permitem que você compartilhe páginas e conteúdo do nosso site por meio de redes sociais de terceiros. Eles também podem ser usados para criar perfis de interesses e, eventualmente, exibir anúncios mais relevantes em outras plataformas.<br>

3. Cookies de Terceiros<br>
Em alguns casos, usamos cookies fornecidos por terceiros confiáveis. Estes terceiros podem incluir ferramentas de análise (como o Google Analytics) ou plataformas de redes sociais que implementam seus próprios cookies em nosso site para melhorar os serviços oferecidos.<br>

Google Analytics: Usamos o Google Analytics para entender como você utiliza nosso site e melhorar sua experiência. Os cookies do Google Analytics rastreiam informações como quanto tempo você passa no site e as páginas que visita, ajudando-nos a criar conteúdo mais relevante.<br>
4. Como Controlar os Cookies<br>
Você pode controlar e gerenciar cookies de várias maneiras. No entanto, a remoção ou bloqueio de cookies pode impactar sua experiência de navegação e algumas funcionalidades do site podem não funcionar como esperado.<br> 

4.1. Configurações do Navegador<br>
A maioria dos navegadores permite que você gerencie cookies por meio de suas configurações. Você pode configurar seu navegador para aceitar ou recusar todos os cookies, ou ser notificado quando um cookie estiver sendo enviado. Consulte a seção de ajuda do seu navegador para mais informações sobre como ajustar suas preferências de cookies.<br>

4.2. Ferramentas de Opt-out<br>
Você também pode optar por não receber cookies de publicidade de terceiros, utilizando ferramentas como o Network Advertising Initiative's Opt-Out Tool ou o Your Online Choices.<br>

5. Atualizações na Política de Cookies<br>
Podemos atualizar nossa Política de Cookies de tempos em tempos para refletir mudanças em nossas práticas ou na legislação aplicável. Quando fizermos isso, publicaremos a versão atualizada no site. Recomendamos que você reveja esta página regularmente para estar ciente de quaisquer alterações.<br>

6. Contato<br>
Se você tiver alguma dúvida sobre o uso de cookies ou nossa Política de Cookies, entre em contato conosco pelo e-mail: cookies@toplevel.com ou pelo telefone: (xx) xxxxx-xxxx.</p>
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
  