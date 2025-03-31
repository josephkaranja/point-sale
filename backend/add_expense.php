<?php
include 'db.php';

$description = $_POST['description'];
$amount = $_POST['amount'];
$user_id = $_POST['user_id'];
$date = date('Y-m-d');

$sql = "INSERT INTO expenses (description, amount, date, created_by) 
        VALUES ('$description', '$amount', '$date', '$user_id')";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Expense recorded."]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
