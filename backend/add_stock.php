<?php
include 'db.php';

$product_id = $_POST['product_id'];
$added_stock = $_POST['added_stock'];
$date = date('Y-m-d');

$sql = "INSERT INTO stocks (product_id, date, added_stock, opening_stock, closing_stock) 
        VALUES ('$product_id', '$date', '$added_stock', 0, 0)";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Stock added successfully."]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
