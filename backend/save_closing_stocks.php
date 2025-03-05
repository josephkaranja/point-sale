
<?php
include 'db_connection.php';

$product_name = $_POST['product_name'];
$remaining_quantity = $_POST['remaining_quantity'];
$date = $_POST['date'];

$stmt = $conn->prepare("INSERT INTO closing_stocks (product_name, remaining_quantity, date) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $product_name, $remaining_quantity, $date);

if ($stmt->execute()) {
    echo "Record saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
header('Location: ../closing_stocks.php');
exit();
?>
