
<?php

// Fetch total stock entries per day
$stockData = [];
$result = $conn->query("SELECT date, SUM(quantity) as total FROM stock_entries GROUP BY date ORDER BY date");
while ($row = $result->fetch_assoc()) {
    $stockData[] = $row;
}

// Fetch total closing stock per day
$closingStockData = [];
$result = $conn->query("SELECT date, SUM(remaining_quantity) as total FROM closing_stocks GROUP BY date ORDER BY date");
while ($row = $result->fetch_assoc()) {
    $closingStockData[] = $row;
}

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: index.html');
    exit();
}
include 'backend/db_connection.php';

// Fetch total expenses per day
$expensesData = [];
$result = $conn->query("SELECT date, SUM(amount) as total FROM expenses GROUP BY date ORDER BY date");
while ($row = $result->fetch_assoc()) {
    $expensesData[] = $row;
}

// Fetch total room income per day (assuming fixed prices for simplicity)
$roomIncomeData = [];
$day_price = 50;
$night_price = 80;
$result = $conn->query("SELECT date, SUM(CASE WHEN booking_type='day' THEN $day_price ELSE $night_price END) as total FROM room_bookings GROUP BY date ORDER BY date");
while ($row = $result->fetch_assoc()) {
    $roomIncomeData[] = $row;
}

$conn->close();
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

    <title>Business Analytics</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js">
const stockLabels = <?php echo json_encode(array_column($stockData, 'date')); ?>;
const stockTotals = <?php echo json_encode(array_column($stockData, 'total')); ?>;

const closingStockLabels = <?php echo json_encode(array_column($closingStockData, 'date')); ?>;
const closingStockTotals = <?php echo json_encode(array_column($closingStockData, 'total')); ?>;

new Chart(document.getElementById('stockChart'), {
    type: 'bar',
    data: {
        labels: stockLabels,
        datasets: [{
            label: 'Stock Entries per Day',
            data: stockTotals,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2
        }]
    }
});

new Chart(document.getElementById('closingStockChart'), {
    type: 'line',
    data: {
        labels: closingStockLabels,
        datasets: [{
            label: 'Closing Stock per Day',
            data: closingStockTotals,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 2
        }]
    }
});

</script>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container">
<div class="card">
    <h1>Business Analytics</h1>

    <canvas id="expensesChart"></canvas>

<canvas id="stockChart"></canvas>
<canvas id="closingStockChart"></canvas>

    <canvas id="roomIncomeChart"></canvas>

    <script>
        const expensesLabels = <?php echo json_encode(array_column($expensesData, 'date')); ?>;
        const expensesTotals = <?php echo json_encode(array_column($expensesData, 'total')); ?>;

        const roomIncomeLabels = <?php echo json_encode(array_column($roomIncomeData, 'date')); ?>;
        const roomIncomeTotals = <?php echo json_encode(array_column($roomIncomeData, 'total')); ?>;

        new Chart(document.getElementById('expensesChart'), {
            type: 'line',
            data: {
                labels: expensesLabels,
                datasets: [{
                    label: 'Total Expenses per Day',
                    data: expensesTotals,
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 2
                }]
            }
        });

        new Chart(document.getElementById('roomIncomeChart'), {
            type: 'bar',
            data: {
                labels: roomIncomeLabels,
                datasets: [{
                    label: 'Total Room Income per Day',
                    data: roomIncomeTotals,
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 2
                }]
            }
        });
    
const stockLabels = <?php echo json_encode(array_column($stockData, 'date')); ?>;
const stockTotals = <?php echo json_encode(array_column($stockData, 'total')); ?>;

const closingStockLabels = <?php echo json_encode(array_column($closingStockData, 'date')); ?>;
const closingStockTotals = <?php echo json_encode(array_column($closingStockData, 'total')); ?>;

new Chart(document.getElementById('stockChart'), {
    type: 'bar',
    data: {
        labels: stockLabels,
        datasets: [{
            label: 'Stock Entries per Day',
            data: stockTotals,
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 2
        }]
    }
});

new Chart(document.getElementById('closingStockChart'), {
    type: 'line',
    data: {
        labels: closingStockLabels,
        datasets: [{
            label: 'Closing Stock per Day',
            data: closingStockTotals,
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 2
        }]
    }
});

</script>
</div>
</div>
</body>
</html>
