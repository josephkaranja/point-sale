
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

    <title>Stock Entries</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
<div class="card">
    <h1>Stock Entries</h1>
    <form method="post" action="backend/save_stock_entries.php">
        <label>Product Name</label><input type="text" name="product_name" required>
<label>Quantity</label><input type="text" name="quantity" required>
<label>Date</label><input type="text" name="date" required>
        <button type="submit">Submit</button>
    </form>
    <h2>Stock Entries Records</h2>
    <table>
        <tr><th>Product Name</th><th>Quantity</th><th>Date</th></tr>
        
<?php
include 'backend/db.php';
$result = $conn->query("SELECT * FROM stock_entries");
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row["product_name"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["quantity"]) . "</td>";
        echo "<td>" . htmlspecialchars($row["date"]) . "</td>";

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
