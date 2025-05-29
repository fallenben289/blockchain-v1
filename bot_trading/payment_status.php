<?php
include 'config.php';
use GuzzleHttp\Client;
$pdo = new PDO('mysql:host=localhost;dbname=bitcoin_payments_db', 'username', 'password'); // Your database credentials

if (isset($_GET['transaction_id'])) {
    $transaction_id = $_GET['transaction_id'];

    try {
        $client = new Client();

        // Check the status of the payment
        $response = $client->get(LUNO_API_URL . 'transactions/' . $transaction_id, [
            'auth' => [LUNO_API_KEY, LUNO_API_SECRET]
        ]);

        // Decode the response
        $body = json_decode($response->getBody(), true);

        if (isset($body['status'])) {
            $status = $body['status'];

            // Update the status in your database
            $stmt = $pdo->prepare("UPDATE bitcoin_payments SET status = ? WHERE transaction_id = ?");
            $stmt->execute([$status, $transaction_id]);

            echo "Transaction Status: " . $status;
        } else {
            echo "Error: Unable to fetch transaction status.";
        }
    } catch (\GuzzleHttp\Exception\RequestException $e) {
        echo "Error: " . $e->getMessage();
    }
} else {
    echo "No transaction ID provided.";
}
?>
