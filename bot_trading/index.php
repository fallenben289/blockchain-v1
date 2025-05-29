<?php
require_once 'vendor/autoload.php';
use Luno\Client as LunoClient;
use Luno\Request\GetBalances;

// Read the API credentials
$json_data = file_get_contents('new_wor.json');
$credentials = json_decode($json_data, true);

// Initialize the Luno client
$client = new LunoClient();
$client->setAuth($credentials['LUNO_API_KEY'], $credentials['LUNO_API_SECRET']);

// Asset Balance Checker
try {
    // Create the GetBalances request
    $request = new GetBalances();
    $response = $client->GetBalances($request);

    // Start HTML
    echo '<!DOCTYPE html>
    <html>
    <head>
        <title>Crypto Balances</title>
        <style>
            body { font-family: Arial, sans-serif; background: #f4f4f9; margin: 0; padding: 20px; }
            table { width: 50%; margin: auto; border-collapse: collapse; background: #fff; }
            th, td { border: 1px solid #ddd; padding: 8px; text-align: center; }
            th { background-color: #4CAF50; color: white; }
            tr:nth-child(even) { background-color: #f2f2f2; }
        </style>
    </head>
    <body>
        <h2 style="text-align: center;">Cryptocurrency Balances</h2>
        <table>
            <tr>
                <th>Asset</th>
                <th>Balance</th>
            </tr>';

    // Populate table rows with balance data
    foreach ($response->getBalance() as $balance) {
        echo '<tr>
                <td>' . htmlspecialchars($balance->getAsset()) . '</td>
                <td>' . htmlspecialchars($balance->getBalance()) . '</td>
              </tr>';
    }

    // End HTML
    echo '</table>
    </body>
    </html>';
} catch (Exception $e) {
    echo 'Error: ' . htmlspecialchars($e->getMessage());
}
?>


<!DOCTYPE html>
<html>
<head>
    <title>Live Crypto Price Tracker</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 20px;
            text-align: center;
        }
        h1 {
            color: #333;
        }
        table {
            width: 60%;
            margin: auto;
            border-collapse: collapse;
            background: #fff;
            margin-top: 20px;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
            text-align: center;
        }
        th {
            background-color: #4CAF50;
            color: white;
        }
        tr:nth-child(even) {
            background-color: #f2f2f2;
        }


        h1 {
            margin: 20px 0;
            color: #333;
        }
        .tradingview-widget {
            margin: 20px auto;
            display: flex;
            justify-content: center;
        }
    </style>
</head>
<body>
    <h1>Live Cryptocurrency Prices</h1>
    <table id="priceTable">
        <thead>
            <tr>
                <th>Cryptocurrency</th>
                <th>Price (USD)</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Bitcoin (BTC)</td>
                <td id="btc-price">Loading...</td>
            </tr>
            <tr>
                <td>Ethereum (ETH)</td>
                <td id="eth-price">Loading...</td>
            </tr>
        </tbody>
    </table>

    

    <script>
        async function fetchPrices() {
            try {
                const response = await fetch('https://api.coingecko.com/api/v3/simple/price?ids=bitcoin,ethereum&vs_currencies=usd');
                const data = await response.json();

                // Update table with new prices
                document.getElementById('btc-price').innerText = `$${data.bitcoin.usd.toLocaleString()}`;
                document.getElementById('eth-price').innerText = `$${data.ethereum.usd.toLocaleString()}`;
            } catch (error) {
                console.error('Error fetching prices:', error);
            }
        }

        // Fetch prices every 5 seconds
        fetchPrices();
        setInterval(fetchPrices, 5000);
    </script>
</body>
</html>


