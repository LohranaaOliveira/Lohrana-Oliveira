<?php
include 'config.php';

$min_price = isset($_GET['min_price']) ? $_GET['min_price'] : 0;
$max_price = isset($_GET['max_price']) ? $_GET['max_price'] : 10000;

$sql = "SELECT * FROM `products` WHERE `price` BETWEEN ? AND ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $min_price, $max_price);
$stmt->execute();
$result = $stmt->get_result();

$products = [];
while ($row = $result->fetch_assoc()) {
  $products[] = $row;
}

header('Content-Type: application/json');
echo json_encode(['products' => $products]);
?>
