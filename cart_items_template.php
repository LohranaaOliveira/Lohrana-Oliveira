<?php
$grand_total = 0;
if (!empty($cart_items)) {
    foreach ($cart_items as $item) {
        $sub_total = $item['price'] * $item['quantity'];
        $grand_total += $sub_total;
        ?>
        <div class="product">
            <img src="uploaded_img/<?php echo $item['image']; ?>" alt="Produto" height="100">
            <div class="product-details">
                <h3><?php echo $item['name']; ?></h3>
                <p class="price">R$ <?php echo number_format($item['price'], 2, ',', '.'); ?></p>
                <div class="quantity-input">
                    <form action="" method="post">
                        <input type="hidden" name="update_quantity_id" value="<?php echo $item['id']; ?>">
                        <button type="submit" name="decrement" class="decrement">-</button>
                        <input type="number" name="update_quantity" class="quantityblock" min="1" max="10" value="<?php echo $item['quantity']; ?>">
                        <button type="submit" name="increment" class="increment">+</button>
                    </form>
                </div>
            </div>
            <a href="#" class="delete-btn" data-id="<?php echo $item['id']; ?>">
                <i class="fas fa-trash"></i>
            </a>
        </div>
        <?php
    }
} else {
    echo "<p>Carrinho vazio</p>";
}
?>
