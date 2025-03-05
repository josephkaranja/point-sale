
<?php
session_start();
include 'db_connection.php';

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
    echo "<script>alert('Invalid username or password');window.location.href='../index.html';</script>";
}
$conn->close();
?>
