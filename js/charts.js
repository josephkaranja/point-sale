const ctx = document.getElementById('salesChart').getContext('2d');

const salesChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
        datasets: [{
            label: 'Sales in $',
            data: [500, 700, 800, 650, 900],
            backgroundColor: ['#93c5fd', '#60a5fa', '#3b82f6', '#2563eb', '#1d4ed8'],
            borderRadius: 8,
        }]
    },
    options: {
        plugins: {
            title: {
                display: true,
                text: 'Weekly Sales Overview'
            }
        }
    }
});
