
<?php
include 'db_connection.php';

$description = $_POST['description'];
$amount = $_POST['amount'];
$date = $_POST['date'];

$stmt = $conn->prepare("INSERT INTO expenses (description, amount, date) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $description, $amount, $date);

if ($stmt->execute()) {
    echo "Record saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
header('Location: ../expenses.php');
exit();
?>
