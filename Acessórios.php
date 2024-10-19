<?php
@include 'config.php';

if (isset($_POST['add_to_cart'])) {
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_image = $_POST['product_image'];
    $product_quantity = isset($_POST['product_quantity']) ? $_POST['product_quantity'] : 1;

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

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="icon" href="Personalização do site/TopLevelLogo.ico" type="image/x-icon">
    <link rel="stylesheet" href="assents/css/Global.css">
    <link rel="stylesheet" href="assents/css/index.css">
    <link rel="stylesheet" href="assents/css/Produtos.css">
    <link rel="stylesheet" href="assents/css/user.css">
    <link rel="stylesheet" href="assents/css/filter.css"> <!-- Adiciona o CSS do filtro -->
    <title>Acessórios</title>
</head>
<body>


<div class="balao-mensagem" id="balao-mensagem">
    <h1>Não podemos aceitar pedidos online agora</h1>
    <p1>Contate-nos para finalizar sua compra.</p1>
</div>

<div class="textos5">
    <h1>ACESSÓRIOS</h1>
</div>

<div class="container">
    <aside>
        <h1>Filtrar por</h1>
        <hr>
        <h1>
            <button class="categories-expand-btn expand-btn" onclick="toggleCategories()">
                <i class="fas fa-minus"></i>
            </button>
            Categorias
        </h1>
        <div id="categories" class="categories">
            <p><a href="products.php" class="linkb4">Tudo</a></p>
            <p><a href="games.php" class="linkb4">Games</a></p>
            <p><a href="Consoles.php" class="linkb4">Consoles</a></p>
            <p><a href="controles.php" class="linkb4">Controles</a></p>
            <p><a href="Acessórios.php" class="linkb4">Acessórios</a></p>
            <p><a href="promoções.php" class="linkb4">Promoções</a></p>
        </div>
        <hr>
        <h1>
            <button class="price-expand-btn expand-btn" onclick="togglePrice()">
                <i class="fas fa-minus"></i>
            </button>
            Preço
        </h1>
        <div id="price" class="price-selector">
            <div class="range-slider">
                <input type="range" id="minPrice" min="100" max="10000" value="161">
                <input type="range" id="maxPrice" min="100" max="10000" value="199">
            </div>
            <div class="price-labels">
                <span id="minPriceLabel">R$ 100,00</span>
                <span id="maxPriceLabel">R$ 10.000,00</span>
            </div>
            <button id="filterButton" class="filter-button">Filtrar</button>
        </div>
        <hr>
    </aside>

    <div class="image-container1-wrapper">
        <div class="image-container-row" id="productContainer">
            <?php
            
            $select_products = mysqli_query($conn, "SELECT * FROM `products` WHERE `category` = 'Acessórios'");

            if (mysqli_num_rows($select_products) > 0) {
                $product_count = 0; 

                while ($fetch_product = mysqli_fetch_assoc($select_products)) {
                    if ($product_count % 3 == 0 && $product_count != 0) {
                        echo '</div>'; 
                        echo '<div class="image-container-row">'; 
                    }
                    ?>
                    <div class="image-container1">
                        <form action="" method="post">
                            <div class="image-wrapper">
                                <a href="<?php echo $fetch_product['name']; ?>.php">
                                    <img src="uploaded_img/<?php echo $fetch_product['image']; ?>" alt="">
                                </a>
                                <?php if ($fetch_product['promotion']) { ?>
                                    <span class="promo-tag">Promoção</span>
                                <?php } ?>
                            </div>
                            <h3 class="image-text"><?php echo $fetch_product['name']; ?></h3>
                            <div class="image-text2">
                                <?php
                                if ($fetch_product['promotion']) {
                                   
                                    echo '<span style="text-decoration: line-through;">R$ ' . number_format($fetch_product['previous_price'], 2, ',', '.') . '</span> ';
                                    echo '<span>R$ ' . number_format($fetch_product['price'], 2, ',', '.') . '</span>';
                                } else {
                                    echo 'R$ ' . number_format($fetch_product['price'], 2, ',', '.');
                                }
                                ?>
                            </div>
                            <div class="cart-container">
                                <a href="<?php echo $fetch_product['name']; ?>.php" class="buy-now-bubble">Comprar Agora</a>
                                <input type="hidden" name="product_name" value="<?php echo $fetch_product['name']; ?>">
                                <input type="hidden" name="product_price" value="<?php echo $fetch_product['price']; ?>">
                                <input type="hidden" name="product_image" value="<?php echo $fetch_product['image']; ?>">
                                <button class="cart-icon" type="submit" name="add_to_cart">
                                    <i class="fas fa-cart-plus"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                    <?php
                    $product_count++; 
                }

                
                if ($product_count % 3 != 0) {
                    echo '</div>';
                }
            }
            ?>
        </div>
    </div>
</div>

<?php include 'cartsidebar.php'; ?> 
        


    <?php include 'rodape.php'; ?>  


  </body>
  </html>