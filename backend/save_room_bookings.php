
<?php
include 'db_connection.php';

$room_number = $_POST['room_number'];
$booking_type = $_POST['booking_type'];
$date = $_POST['date'];

$stmt = $conn->prepare("INSERT INTO room_bookings (room_number, booking_type, date) VALUES (?, ?, ?)");
$stmt->bind_param('sss', $room_number, $booking_type, $date);

if ($stmt->execute()) {
    echo "Record saved successfully.";
} else {
    echo "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();
header('Location: ../room_bookings.php');
exit();
?>
