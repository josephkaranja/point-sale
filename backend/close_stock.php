<?php
include 'db.php';

$product_id = $_POST['product_id'];
$closing_stock = $_POST['closing_stock'];
$date = date('Y-m-d');

$sql = "UPDATE stocks SET closing_stock = '$closing_stock' 
        WHERE product_id = '$product_id' AND date = '$date'";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Closing stock updated."]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
