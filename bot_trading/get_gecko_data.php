<?php
// Define CoinGecko API endpoint (Example: Historical data for Bitcoin in USD)
$api_url = 'https://api.coingecko.com/api/v3/coins/bitcoin/market_chart?vs_currency=usd&days=30'; // Fetching 30 days of data

// Initialize cURL session
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute cURL request and fetch data
$response = curl_exec($ch);
curl_close($ch);

// Decode JSON response
$data = json_decode($response, true);

// Extract price data for the chart
$prices = [];
foreach ($data['prices'] as $price) {
    $prices[] = [
        'timestamp' => $price[0] / 1000,  // Convert timestamp from milliseconds to seconds
        'price' => $price[1]
    ];
}

// Return the data as a JSON response
echo json_encode($prices);
?>
