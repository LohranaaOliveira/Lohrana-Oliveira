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
    <title>Política de Privacidade</title>
</head>

<body>
  <script src="https://kit.fontawesome.com/87a451ecf9.js" crossorigin="anonymous"></script>
  
  <div class="textos5" >
    <h1>Política de Privacidade</h1>
          </div>
          <div class="text-container">
              <p>A sua privacidade é importante para nós. Esta Política de Privacidade descreve como coletamos, usamos, armazenamos e protegemos as suas informações pessoais quando você utiliza o site TopLevel. Ao acessar e utilizar nossos serviços, você concorda com os termos descritos abaixo.<br>

1. Informações que Coletamos<br>
1.1. Informações pessoais fornecidas pelo usuário: Coletamos as informações que você nos fornece diretamente quando se cadastra, faz uma compra ou entra em contato com nossa equipe de suporte. Essas informações podem incluir:<br>

Nome completo<br>
Endereço de e-mail<br>
Endereço de entrega<br>
Número de telefone<br>
Informações de pagamento<br>
1.2. Informações coletadas automaticamente: Quando você navega no site, podemos coletar automaticamente determinadas informações sobre seu dispositivo e comportamento de navegação, como:<br>

Endereço IP<br>
Tipo de navegador<br>
Páginas visitadas<br>
Tempo gasto no site<br>
Dados de cookies<br>
2. Uso das Informações<br>
2.1. As informações que coletamos são usadas para os seguintes fins:<br>

Processamento de pedidos: Para garantir que sua compra seja processada corretamente, enviando atualizações sobre o status do pedido e informações de entrega.<br>
Comunicação: Para responder às suas perguntas, fornecer suporte ao cliente e enviar informações importantes sobre sua conta ou serviços.<br>
Personalização da experiência: Para adaptar o conteúdo, promoções e ofertas de acordo com suas preferências e histórico de navegação.<br>
Melhoria do site: Para entender como você utiliza o TopLevel e melhorar nossos serviços, funcionalidades e experiência do usuário.<br>
Fins de marketing: Enviar e-mails promocionais ou newsletters, desde que você tenha autorizado o recebimento dessas comunicações. Você pode cancelar o recebimento a qualquer momento.<br>
3. Compartilhamento de Informações<br>
3.1. Nós não vendemos, alugamos ou trocamos suas informações pessoais com terceiros. No entanto, podemos compartilhar informações com terceiros nos seguintes casos:<br>

Prestadores de serviço: Compartilhamos informações com empresas que nos auxiliam a operar o site, processar pagamentos, realizar entregas ou fornecer suporte ao cliente.<br>
Conformidade legal: Podemos divulgar informações quando exigido por lei ou em resposta a solicitações legais, como ordens judiciais.<br>
Transferências comerciais: Em caso de fusão, venda de ativos ou outra reorganização corporativa, suas informações podem ser transferidas como parte do negócio.<br>
4. Segurança de Dados<br>
4.1. Implementamos medidas de segurança apropriadas para proteger suas informações pessoais contra acesso não autorizado, uso indevido, divulgação ou destruição. Entre essas medidas estão:<br>

Criptografia de dados financeiros e transações sensíveis.<br>
Controles de acesso restrito aos funcionários que precisam de informações para executar suas funções.<br>
4.2. Embora adotemos práticas de segurança rigorosas, nenhum sistema de armazenamento ou transmissão de dados é 100% seguro. Portanto, não podemos garantir a segurança absoluta de suas informações.<br>

5. Cookies e Tecnologias Semelhantes<br>
5.1. Usamos cookies para melhorar sua experiência de navegação no nosso site. Os cookies são pequenos arquivos de texto armazenados em seu dispositivo que nos permitem lembrar de suas preferências e personalizar sua navegação. 5.2. Você pode desativar os cookies nas configurações do seu navegador, mas isso pode afetar o funcionamento de algumas funcionalidades do site.<br>

6. Seus Direitos<br>
6.1. Você tem os seguintes direitos em relação às suas informações pessoais:<br>

Acesso e correção: Você pode acessar e corrigir suas informações pessoais a qualquer momento, diretamente em sua conta ou entrando em contato com nosso suporte.<br>
Exclusão de dados: Você pode solicitar a exclusão de suas informações pessoais, desde que não sejam mais necessárias para a finalidade para a qual foram coletadas ou que não haja uma obrigação legal de retê-las.<br>
Opt-out de marketing: Caso não deseje mais receber nossas comunicações de marketing, você pode cancelar a inscrição clicando no link de "descadastro" em qualquer e-mail promocional ou ajustando suas preferências em sua conta.<br>
7. Armazenamento de Dados<br>
7.1. Armazenamos suas informações pelo tempo necessário para fornecer nossos serviços ou conforme exigido por lei.<br>
7.2. As informações de contas inativas podem ser retidas por um período de tempo razoável para fins de auditoria, conformidade legal ou prevenção de fraudes.<br>

8. Privacidade de Crianças<br>
8.1. Nosso site não é destinado ao uso por crianças menores de 18 anos. Não coletamos intencionalmente informações pessoais de menores de idade. Caso identifiquemos a coleta de informações de um menor, tomaremos medidas para excluí-las imediatamente.<br>

9. Alterações a Esta Política<br>
9.1. Podemos atualizar esta Política de Privacidade de tempos em tempos para refletir mudanças em nossas práticas ou na legislação aplicável. Quando isso ocorrer, publicaremos a versão atualizada no site e, se as alterações forem significativas, notificaremos você por e-mail ou por meio de um aviso em nosso site.<br>

10. Contato<br>
Se você tiver qualquer dúvida ou preocupação sobre esta Política de Privacidade, ou desejar exercer seus direitos em relação às suas informações pessoais, entre em contato conosco pelo e-mail: privacidade@toplevel.com ou pelo telefone: (xx) xxxxx-xxxx.</p>
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
  