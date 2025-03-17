
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
$role = $_SESSION['role'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">

<script>
function toggleDarkMode() {
    document.body.classList.toggle('dark-mode');
    localStorage.setItem('darkMode', document.body.classList.contains('dark-mode'));
}

window.onload = function() {
    if (localStorage.getItem('darkMode') === 'true') {
        document.body.classList.add('dark-mode');
    }
}
</script>
<style>
.dark-mode {
    background-color: #121212;
    color: #ffffff;
}
.dark-mode table {
    color: #ffffff;
}
.dark-mode .card {
    background-color: #1e1e1e;
}
</style>
<button onclick="toggleDarkMode()">Toggle Dark Mode</button>
</head>
<body>
<style>
    .card-container {
        display: flex;
        flex-wrap: wrap;
        gap: 20px;
        justify-content: center;
        padding: 20px;
    }
    .card {
        background-color: #f9f9f9;
        border-radius: 12px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        padding: 20px;
        width: 220px;
        text-align: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }
    .card a {
        text-decoration: none;
        color: #333;
        font-size: 18px;
        font-weight: bold;
    }
</style>

<div class="card-container">
    <div class="card"><a href="stock_entry.php">Stock Entry</a></div>
    <div class="card"><a href="closing_stock.php">Closing Stock</a></div>
    <div class="card"><a href="expenses.php">Expenses</a></div>
    <div class="card"><a href="rooms.php">Room Bookings</a></div>
    <div class="card"><a href="analytics.php">Business Analytics</a></div>
    <div class="card"><a href="backend/logout.php">Logout</a></div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<canvas id="salesChart"></canvas>
<script>
fetch('backend/get_sales_data.php')
.then(response => response.json())
.then(data => {
    const ctx = document.getElementById('salesChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: data.labels,
            datasets: [{
                label: 'Daily Sales',
                data: data.values,
                backgroundColor: 'rgba(75, 192, 192, 0.5)'
            }]
        }
    });
});
</script>
</body>
</html>
