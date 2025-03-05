<?php
include '../db.php';

$date = $_GET['date'];

$sales = $conn->query("SELECT SUM(total_sale) AS total_sales FROM sales WHERE date='$date'");
$expenses = $conn->query("SELECT SUM(amount) AS total_expenses FROM expenses WHERE date='$date'");
$rooms = $conn->query("SELECT SUM(price) AS room_income FROM rooms WHERE date='$date' AND status='booked'");

echo json_encode([
    "total_sales" => $sales->fetch_assoc()['total_sales'],
    "total_expenses" => $expenses->fetch_assoc()['total_expenses'],
    "room_income" => $rooms->fetch_assoc()['room_income']
]);
?>
