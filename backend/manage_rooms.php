<?php
include 'db.php';

$room_number = $_POST['room_number'];
$session = $_POST['session'];
$status = $_POST['status'];
$price = $_POST['price'];
$date = date('Y-m-d');

$sql = "INSERT INTO rooms (room_number, date, session, status, price) 
        VALUES ('$room_number', '$date', '$session', '$status', '$price')";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "Room record saved."]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
