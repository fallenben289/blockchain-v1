<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trading Graph</title>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<canvas id="tradingChart" width="600" height="400"></canvas>

<script>
// Fetch the data from PHP backend
fetch('get_gecko_data.php')  // Adjust the URL as necessary
    .then(response => response.json())
    .then(data => {
        // Prepare data for chart
        const labels = data.map(price => new Date(price.timestamp * 1000).toLocaleTimeString()); // Time as label
        const prices = data.map(price => price.price);

        // Create the chart
        const ctx = document.getElementById('tradingChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'line',  // You can change the chart type
            data: {
                labels: labels,
                datasets: [{
                    label: 'Bitcoin Price (USD)',
                    data: prices,
                    borderColor: 'blue',
                    fill: false
                }]
            },
            options: {
                responsive: true,
                scales: {
                    x: {
                        title: {
                            display: true,
                            text: 'Time'
                        }
                    },
                    y: {
                        title: {
                            display: true,
                            text: 'Price (USD)'
                        }
                    }
                }
            }
        });
    })
    .catch(error => console.error('Error fetching data:', error));
</script>

</body>
</html>
