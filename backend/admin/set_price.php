<?php
include '../db.php';

$product_id = $_POST['product_id'];
$new_price = $_POST['new_price'];

$sql = "UPDATE products SET selling_price='$new_price' WHERE id='$product_id'";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Price updated."]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
