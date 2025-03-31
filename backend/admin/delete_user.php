<?php
include '../db.php';

$user_id = $_POST['user_id'];

$sql = "DELETE FROM users WHERE id='$user_id'";

if ($conn->query($sql)) {
    echo json_encode(["status" => "success", "message" => "User deleted."]);
} else {
    echo json_encode(["status" => "error", "message" => $conn->error]);
}
?>
