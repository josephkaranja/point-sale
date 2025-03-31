<?php
include 'db.php';

$product_id = $_POST['product_id'];
$quantity_sold = $_POST['quantity_sold'];
$date = date('Y-m-d');

$priceResult = $conn->query("SELECT selling_price FROM products WHERE id='$product_id'");
$product = $priceResult->fetch_assoc();
$total_sale = $quantity_sold * $product['selling_price'];

$sql = "INSERT INTO sales (product_id, date, quantity_sold, total_sale)
        VALUES ('$product_id', '$date', '$quantity_sold', '$total_sale')";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Sale recorded."]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
