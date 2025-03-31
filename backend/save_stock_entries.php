
<?php
include 'db_connection.php';

$product_name = $_POST['product_name'];
$quantity = $_POST['quantity'];
$date = $_POST['date'];

$stmt = $conn->prepare("INSERT INTO stock_entries (product_name, quantity, date) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $product_name, $quantity, $date);

if ($stmt->execute()) {
    echo "Record saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
header('Location: ../stock_entries.php');
exit();
?>
