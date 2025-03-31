
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>

<style>
    body {
        margin: 0;
        padding: 0;
        font-family: Arial, sans-serif;
        background-color: #f0f2f5;
        color: #333;
        transition: background-color 0.3s, color 0.3s;
    }
    .container {
        padding: 20px;
        max-width: 1200px;
        margin: auto;
    }
    .card {
        background-color: #fff;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin: 20px 0;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 10px;
    }
    th, td {
        padding: 10px;
        border: 1px solid #ddd;
        text-align: center;
    }
    th {
        background-color: #007BFF;
        color: #fff;
    }
    /* Dark Mode */
    .dark-mode {
        background-color: #181818;
        color: #ddd;
    }
    .dark-mode .card {
        background-color: #242424;
        color: #ddd;
    }
    .dark-mode th {
        background-color: #0056b3;
    }
    /* Responsive */
    @media (max-width: 768px) {
        .card {
            padding: 15px;
        }
        th, td {
            padding: 8px;
        }
    }
    .dark-toggle {
        position: fixed;
        top: 20px;
        right: 20px;
        background: #007BFF;
        color: white;
        border: none;
        padding: 10px 20px;
        border-radius: 20px;
        cursor: pointer;
    }
</style>
<script>
    function toggleDarkMode() {
        document.body.classList.toggle('dark-mode');
    }
</script>
<button class="dark-toggle" onclick="toggleDarkMode()">Toggle Dark Mode</button>

    <title>Room Bookings</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
<div class="card">
    <h1>Room Bookings</h1>
    <form method="post" action="backend/save_room_bookings.php">
        <label>Room Number</label><input type="text" name="room_number" required>
<label>Booking Type</label><input type="text" name="booking_type" required>
<label>Date</label><input type="text" name="date" required>
        <button type="submit">Submit</button>
    </form>
    <h2>Room Bookings Records</h2>
    <table>
        <tr><th>Room Number</th><th>Booking Type</th><th>Date</th></tr>
        
<?php
include 'backend/db.php';
$result = $conn->query("SELECT * FROM rooms");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["room_number"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["booking_type"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["booked_date"]) . "</td>";

        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='3'>No records found</td></tr>";
}
$conn->close();
?>

    </table>
</div>
</div>
</body>
</html>
