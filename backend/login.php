
<?php
session_start();
include 'db.php';

$username = $_POST['username'];
$password = $_POST['password'];

$sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];

    if ($user['role'] === 'admin') {
        header('Location: ../dashboard.php');
        exit();
    } else {
        header('Location: ../user_dashboard.php');
        exit();
    }
} else {
    echo json_encode(['status'=> 'error', 'message' => 'Invalid username or password']);
}
$conn->close();
?>
