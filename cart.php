<?php
@include 'config.php';


if(isset($_POST['update_update_btn'])){
   $update_value = $_POST['update_quantity'];
   $update_id = $_POST['update_quantity_id'];
   $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
   if($update_quantity_query){
      header('location:cart.php');
   }
}

if(isset($_GET['remove'])){
   $remove_id = $_GET['remove'];
   mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$remove_id'");
   header('location:cart.php');
}

if(isset($_GET['delete_all'])){
   mysqli_query($conn, "DELETE FROM `cart`");
   header('location:cart.php');
}

if (isset($_POST['update_quantity'])) {
    $update_value = $_POST['quantity'];
    $update_id = $_POST['id'];
    $update_quantity_query = mysqli_query($conn, "UPDATE `cart` SET quantity = '$update_value' WHERE id = '$update_id'");
    if ($update_quantity_query) {
        echo 'success';
    } else {
        echo 'error';
    }
    exit;
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
   <title>Carrinho de Compras</title>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
   <link rel="stylesheet" href="assents/css/style.css">

</head>
<body>

<style>
    .show {
    display: block;
}

</style>
<div class="header-config"> 
    <a href="Index.php" class="logo">
        <img src="Personalização do site/TopLevelLogo.webp" alt="logo" height="80" width="80" align="center">TopLevel
    </a>
    <nav>
        <ul>
            <li><a href="products.php" class="linkb1">Produtos</a></li>
            <li><a href="promoções.php" class="linkb1">Promoções</a></li>
            <li><a href="contato.php" class="linkb1">Contato</a></li>

            <?php
            $select_rows = mysqli_query($conn, "SELECT * FROM `cart`") or die('query failed');
            $row_count = mysqli_num_rows($select_rows);
            ?>

            <li class="menu-item">
                <button class="dropdown-btn">
                    <i class="fas fa-chevron-down"></i>
                </button>
                <div class="dropdown-content">
                    <a href="sair.php">Sair</a>
                    <a href="user.php">Minha conta</a>
                </div>
            </li>
            
            
        </ul>
    </nav>
</div>
<?php include 'cartsidebar.php'; ?>

<div class="containerr">

   <section class="shopping-cart">

      <h1 class="heading">Meu Carrinho</h1>

      <table>

         <thead>
            <th>Imagem</th>
            <th>Nome</th>
            <th>Preço</th>
            <th>Quantidade</th>
            <th>Preço Total</th>
            <th>Ação</th>
         </thead>

         <tbody>
            <?php 
            $select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
            $grand_total = 0;

            if(mysqli_num_rows($select_cart) > 0){
               while($fetch_cart = mysqli_fetch_assoc($select_cart)){
                  $total_price = $fetch_cart['price'] * $fetch_cart['quantity'];
            ?>

            <tr>
               <td><img src="uploaded_img/<?php echo $fetch_cart['image']; ?>" height="100" alt="Produto"></td>
               <td><?php echo $fetch_cart['name']; ?></td>
               <td class="unit-price">R$ <?php echo number_format($fetch_cart['price'], 2, ',', '.'); ?></td>
               <td>
               <div class="quantity-input">
    <form action="" method="post">
        <input type="hidden" name="update_quantity_id" value="<?php echo $fetch_cart['id']; ?>">
        <button type="button" class="decrement" data-id="<?php echo $fetch_cart['id']; ?>" <?= ($fetch_cart['quantity'] <= 1) ? 'disabled' : ''; ?>>-</button>
<input type="number" id="quantity_<?php echo $fetch_cart['id']; ?>" name="update_quantity" min="1" max="10" value="<?php echo $fetch_cart['quantity']; ?>" readonly>
<button type="button" class="increment" data-id="<?php echo $fetch_cart['id']; ?>" <?= ($fetch_cart['quantity'] >= 10) ? 'disabled' : ''; ?>>+</button>

    </form>
               </div>
</td>

               <td class="total-price" data-price="<?php echo $fetch_cart['price']; ?>">R$ <?php echo number_format($total_price, 2, ',', '.'); ?></td>
               <td>
                  <a href="cart.php?remove=<?php echo $fetch_cart['id']; ?>" class="delete-btn">
                     <i class="fas fa-trash"></i>  
                  </a>
               </td>
            </tr>

            <?php
               $grand_total += $total_price;
               }
            } else {
               echo '<tr><td colspan="6" style="text-align: center;">Seu carrinho está vazio</td></tr>';
            }
            ?>
         </tbody>

         <tfoot>
            <tr class="table-bottom">
               <td><a href="products.php" class="option-btn">Continuar Comprando</a></td>

            </tr>
         </tfoot>

      </table>

      <div class="checkout-summary">
         <h3>Resumo do Pedido</h3>
         <p>Subtotal: R$ <?php echo number_format($grand_total, 2, ',', '.'); ?></p>
         <a href="#">Estimar Entrega</a>
         <p>Total: R$ <?php echo number_format($grand_total, 2, ',', '.'); ?></p>
         <div class="checkout-btn">
            <a href="checkout.php" class="btn <?= ($grand_total > 0) ? '' : 'disabled'; ?>">Finalizar compra</a>
         </div>
      </div>

   </section>

</div>

<script>

document.addEventListener('DOMContentLoaded', function() {
            const dropdownBtn = document.querySelector('.dropdown-btn');
            const dropdownContent = document.querySelector('.dropdown-content');

            dropdownBtn.addEventListener('click', function() {
                dropdownContent.classList.toggle('show');
            });

            document.addEventListener('click', function(event) {
                if (!dropdownBtn.contains(event.target)) {
                    dropdownContent.classList.remove('show');
                }
            });
        });


        function updatePrice(element, quantity, price) {
    const totalPriceElement = element.closest('tr').querySelector('.total-price');
    totalPriceElement.textContent = 'R$ ' + (quantity * price).toFixed(2).replace('.', ',');
    updateSubtotal();
}



function updateSubtotal() {
    let subtotal = 0;
    document.querySelectorAll('.total-price').forEach(priceElement => {
        const price = parseFloat(priceElement.textContent.replace('R$ ', '').replace(',', '.'));
        subtotal += price;
    });
    document.getElementById('subtotal').textContent = 'R$ ' + subtotal.toFixed(2).replace('.', ',');
}


function updateCart(id, quantity) {
    fetch('cart.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `id=${id}&quantity=${quantity}&update_quantity=true`
    }).then(response => response.text())
    .then(data => {
        console.log(data); 
    }).catch(error => console.error('Erro:', error));
}

function handleQuantityButtons() {
    document.querySelectorAll('.increment').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const quantityInput = document.getElementById('quantity_' + id);
            let quantity = parseInt(quantityInput.value);
            const price = parseFloat(this.closest('tr').querySelector('.total-price').dataset.price);

            if (quantity < 10) {
                quantityInput.value = ++quantity;
                this.previousElementSibling.disabled = false; // Sempre reativa o botão de decremento ao aumentar
                if (quantity >= 10) {
                    this.disabled = true; // Desativa o botão de incremento se a quantidade for 10
                }
                updateCart(id, quantity);
                updatePrice(this, quantity, price);
            }
        });
    });

    document.querySelectorAll('.decrement').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const quantityInput = document.getElementById('quantity_' + id);
            let quantity = parseInt(quantityInput.value);
            const price = parseFloat(this.closest('tr').querySelector('.total-price').dataset.price);

            if (quantity > 1) {
                quantityInput.value = --quantity;
                this.nextElementSibling.disabled = false; // Sempre reativa o botão de incremento ao diminuir
                if (quantity <= 1) {
                    this.disabled = false; // Mantém o botão de decremento ativo ao atingir 1
                }
                updateCart(id, quantity);
                updatePrice(this, quantity, price);
            }
        });
    });
}

document.addEventListener('DOMContentLoaded', handleQuantityButtons);

        var search = document.getElementById('pesquisar');

        search.addEventListener("keydown", function(event) {
            if (event.key === "Enter")  
            {
                searchData();
            }
        });

      function searchData() 
      {
          window.location = 'sistema.php?search='+search.value;
      }

      

</script>

</body>
</html>
