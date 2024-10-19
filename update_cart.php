<?php
include 'config.php';

$select_cart = mysqli_query($conn, "SELECT * FROM `cart`");
$grand_total = 0;

if (mysqli_num_rows($select_cart) > 0) {
    while ($fetch_cart = mysqli_fetch_assoc($select_cart)) {
        $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
        $grand_total += $sub_total;
    }
}

echo 'R$ ' . number_format($grand_total, 2, ',', '.');


