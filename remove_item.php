<?php
include 'config.php'; 

if (isset($_POST['cart_item_id'])) {
    $cart_item_id = $_POST['cart_item_id'];
    
    $delete_item = mysqli_query($conn, "DELETE FROM `cart` WHERE id = '$cart_item_id'");
    
}
?>
