<?php
include '../db.php';

$username = $_POST['username'];
$password = $_POST['password'];
$role = $_POST['role'];

$sql = "INSERT INTO users (username, password, role)
        VALUES ('$username', '$password', '$role')";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "User added."]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
