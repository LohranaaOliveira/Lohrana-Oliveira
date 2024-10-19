<?php
@include 'config.php';

session_start();
$emailUsuario = $_SESSION['email'] ?? '';

if(!empty($emailUsuario)) {
   $query = "SELECT * FROM `usuarios` WHERE email = '$emailUsuario' LIMIT 1";
   $result = mysqli_query($conn, $query);

   if(mysqli_num_rows($result) > 0) {
      $user_data = mysqli_fetch_assoc($result);
      $nome = $user_data['nome'];
      $telefone = $user_data['telefone'];
      $email = $user_data['email'];
      $bairro = $user_data['bairro'];
      $endereco = $user_data['endereco'];
      $cidade = $user_data['cidade'];
      $estado = $user_data['estado'];
   } else {
      $nome = '';
      $telefone = '';
      $email = '';
      $bairro = '';
      $endereco = '';
      $cidade = '';
      $estado = '';
   }
} else {
   $nome = '';
   $telefone = '';
   $email = '';
   $bairro = '';
   $endereco = '';
   $cidade = '';
   $estado = '';
}
if(isset($_POST['order_btn'])){

   $nome = $_POST['nome'];
   $telefone = $_POST['telefone'];
   $email = $_POST['email'];
   $method = $_POST['method'];
   $bairro = $_POST['bairro'];
   $endereco = $_POST['endereco'];
   $cidade = $_POST['cidade'];
   $estado = $_POST['estado'];

   $cart_query = mysqli_query($conn, "SELECT * FROM `cart`");
   $price_total = 0;
   $product_name = [];

   if(mysqli_num_rows($cart_query) > 0){
      while($product_item = mysqli_fetch_assoc($cart_query)){
         $product_name[] = $product_item['name'] .' ('. $product_item['quantity'] .') ';
         $product_price = $product_item['price'] * $product_item['quantity'];
         $price_total += $product_price;
      }
   }

   $total_product = !empty($product_name) ? implode(', ', $product_name) : 'Nenhum produto no carrinho';

   $detail_query = mysqli_query($conn, "INSERT INTO `pedidos`(nome, telefone, email, method, bairro, endereco, cidade, estado, total_products, total_price) 
   VALUES('$nome','$telefone','$email','$method','$bairro','$endereco','$cidade','$estado','$total_product','$price_total')") 
   or die('Query falhou');

   if($cart_query && $detail_query){

      mysqli_query($conn, "DELETE FROM `cart`") or die('Falha ao limpar o carrinho');
      
      echo "
      <div class='order-message-container'>
         <div class='message-container'>
            <h3>Obrigado por comprar com a gente!!</h3>
            <div class='order-detail'>
               <span>".$total_product."</span>
               <span class='total'> Total : R$".number_format($price_total, 2, ',', '.')."  </span>
            </div>
            <div class='customer-details'>
               <p> Seu Nome : <span>".$nome."</span> </p>
               <p> Seu número : <span>".$telefone."</span> </p>
               <p> Seu email : <span>".$email."</span> </p>
               <p> Seu endereço : <span>".$bairro.", ".$endereco.", ".$cidade.", ".$estado."</span> </p>
               <p> Seu metodo de pagamento : <span>".$method."</span> </p>
               <p>Pague quando o produto chegar!</p>
            </div>
            <a href='products.php' class='btn'>Continue Comprando</a>
         </div>
      </div>
      ";
   }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="icon" href="Personalização do site/TopLevelLogo.ico" type="image/x-icon">
   <link rel="stylesheet" href="assents/css/Global.css">
   <link rel="stylesheet" href="assents/css/index.css">
   <link rel="stylesheet" href="assents/css/Produtos.css">
   <link rel="stylesheet" href="assents/css/user.css">
   <title>checkout</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="assents/css/style.css">

   <style>
      .display-order .product-item {
         display: flex;
         align-items: center;
         margin-bottom: 10px;
      }

      .display-order .product-item img.product-image {
         width: 80px;
         height: 80px;
         object-fit: cover;
         margin-right: 10px;
         border-radius: 5px;
      }

      .display-order .grand-total {
         font-weight: bold;
         margin-top: 15px;
         display: block;
      }
   </style>

</head>
<body>

<?php include 'headeruser.php'; ?>

<h1 class="heading">Complete Seu Pedido</h1>
<div class="container">

<section class="checkout-form">

<form action="" method="post">

   <div class="display-order">
      <?php
         // Ajustar a consulta para garantir que o email do usuário esteja correto
         $select_cart = mysqli_query($conn, "SELECT * FROM `cart` WHERE user_email = '$emailUsuario'");
         
         // Inicializa o total do carrinho
         $grand_total = 0;

         // Verifica se há itens no carrinho
         if(mysqli_num_rows($select_cart) > 0){
            // Exibe os itens do carrinho
            while($fetch_cart = mysqli_fetch_assoc($select_cart)){
               $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
               $grand_total += $total_price;
               $product_image = $fetch_cart['image']; 
      ?>
      <div class="product-item">
         <img src="uploaded_img/<?= $product_image; ?>" alt="<?= $fetch_cart['name']; ?>" class="product-image">
         <span><?= $fetch_cart['name']; ?> (<?= $fetch_cart['quantity']; ?>)</span>
      </div>
      <?php
            }
         } else {
            // Mensagem exibida se o carrinho estiver realmente vazio
            echo "<div class='display-order'><span>Seu carrinho está vazio!</span></div>";
         }
      ?>
      <!-- Exibe o total do carrinho -->
      <span class="grand-total">Total: R$<?= number_format($grand_total, 2, ',', '.'); ?></span>
   </div>

   <!-- Formulário continua normalmente -->
   <div class="flex">
      <div class="inputBox">
         <span>Seu nome</span>
         <input type="text" placeholder="Nome completo" name="nome" value="<?= $nome; ?>" required>
      </div>
      <div class="inputBox">
         <span>Número de telefone</span>
         <input type="tel" id="telefone" name="telefone" placeholder="(00) 00000-0000" value="<?= $telefone; ?>" required>
      </div>
      <div class="inputBox">
         <span>Email</span>
         <input type="email" placeholder="Digite seu email" name="email" value="<?= $email; ?>" required>
      </div>
      <div class="inputBox">
         <span>Metodo de pagamento</span>
         <select name="method">
            <option value="Boleto" selected>Boleto</option>
            <option value="Cartão de crédito">Cartão de crédito</option>
            <option value="Pix">Pix</option>
         </select>
      </div>
      <div class="inputBox">
         <span>Bairro</span>
         <input type="text" placeholder="Digite o Bairro" name="bairro" value="<?= $bairro; ?>" required>
      </div>
      <div class="inputBox">
         <span>Endereço</span>
         <input type="text" placeholder="Digite o Endereço" name="endereco" value="<?= $endereco; ?>" required>
      </div>
      <div class="inputBox">
         <span>Estado</span>
         <select id="estado" name="estado" required>
            <option value="" disabled <?= empty($estado) ? 'selected' : ''; ?>>Selecione o estado</option>
            <option value="SP" <?= $estado == 'SP' ? 'selected' : ''; ?>>São Paulo</option>
            <option value="RJ" <?= $estado == 'RJ' ? 'selected' : ''; ?>>Rio de Janeiro</option>
            <option value="MG" <?= $estado == 'MG' ? 'selected' : ''; ?>>Minas Gerais</option>
            <option value="ES" <?= $estado == 'ES' ? 'selected' : ''; ?>>Espírito Santo</option>
            <option value="RS" <?= $estado == 'RS' ? 'selected' : ''; ?>>Rio Grande do Sul</option>
            <option value="PR" <?= $estado == 'PR' ? 'selected' : ''; ?>>Paraná</option>
         </select>
      </div>
      <div class="inputBox">
         <span>Cidade</span>
         <select id="cidade" name="cidade" required>
            <option value="" disabled <?= empty($cidade) ? 'selected' : ''; ?>>Selecione a cidade</option>
            <option value="<?= $cidade; ?>" selected><?= $cidade; ?></option>
         </select>
      </div>
   </div>

   <input type="submit" value="Finalizar pedido" name="order_btn" class="orderbtn">

</form>


</section>

</div>

<?php include 'cartsidebar.php'; ?>
   


<script>
   document.getElementById('telefone').addEventListener('input', function (e) {
            let value = e.target.value.replace(/\D/g, ''); 
            if (value.length > 11) value = value.slice(0, 11); 

            if (value.length <= 2) {
                value = value.replace(/(\d{0,2})/, '($1');
            } else if (value.length <= 6) {
                value = value.replace(/(\d{2})(\d{0,4})/, '($1) $2');
            } else {
                value = value.replace(/(\d{2})(\d{5})(\d{0,4})/, '($1) $2-$3');
            }

            e.target.value = value; 
        });


        const citiesByState = {
            'SP': ['São Paulo', 'Campinas', 'Santos', 'Sorocaba'],
            'RJ': ['Rio de Janeiro', 'Niterói', 'Campos dos Goytacazes'],
            'MG': ['Belo Horizonte', 'Uberlândia', 'Juiz de Fora'],
            'ES': ['Vitória', 'Serra', 'Vila Velha'],
            'RS': ['Porto Alegre', 'Caxias do Sul', 'Pelotas'],
            'PR': ['Curitiba', 'Guarapuava', 'Londrina']
        };

        document.getElementById('estado').addEventListener('change', function() {
            const estado = this.value;
            const citySelect = document.getElementById('cidade');
            
            citySelect.innerHTML = '<option value="" disabled selected>Selecione a cidade</option>';
            
            if (estado && citiesByState[estado]) {
                citiesByState[estado].forEach(cidade => {
                    const option = document.createElement('option');
                    option.value = cidade;
                    option.textContent = cidade;
                    citySelect.appendChild(option);
                });
                citySelect.disabled = false;
            } else {
                citySelect.disabled = true;
            }
        });
</script>
</body>
</html>
