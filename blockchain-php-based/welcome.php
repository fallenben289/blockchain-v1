
---

## 2. Commented Code for `welcome.php`

Below is your code with in-line comments from a senior developer’s perspective:

```php
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blockchain UI</title>
    <style>
        /* Basic UI styling for the blockchain demo */
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: 0 auto;
        }
        h1 {
            text-align: center;
        }
        .blockchain {
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: 20px;
        }
        .block {
            background-color: #ffffff;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
        .block h3 {
            margin: 0 0 10px 0;
            color: #333;
        }
        .block pre {
            background-color: #f9f9f9;
            padding: 10px;
            border-radius: 5px;
            overflow-x: auto;
        }
        .form-container {
            margin-top: 20px;
        }
        .form-container input, .form-container button {
            padding: 10px;
            margin-top: 10px;
            width: 100%;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        .form-container button {
            background-color: #28a745;
            color: white;
            cursor: pointer;
            border: none;
        }
        .form-container button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Simple Blockchain UI</h1>
        <!-- Blockchain data will be rendered here -->
        <div class="blockchain" id="blockchain"></div>
        <!-- Form to add a new block -->
        <div class="form-container">
            <input type="text" id="blockData" placeholder="Enter block data">
            <button onclick="addBlock()">Add Block</button>
        </div>
    </div>

    <script>
        // Reference to the blockchain display container
        const blockchainContainer = document.getElementById('blockchain');

        // Initialize a simple in-browser blockchain (array of blocks)
        // In real-world, blockchain data would come from server-side (e.g., PHP backend)
        let blockchain = [
            {
                index: 0, // Block position in the chain
                timestamp: new Date().getTime(), // Block creation time
                data: "Genesis Block", // The first block is always the genesis block
                previousHash: "0", // Genesis block has no previous hash
                hash: "hash of genesis block" // Placeholder for block hash
            }
        ];

        // Render the blockchain on the page
        function displayBlockchain() {
            blockchainContainer.innerHTML = ''; // Clear previous display
            blockchain.forEach(block => {
                const blockElement = document.createElement('div');
                blockElement.className = 'block';
                // Show block number and its full JSON content
                blockElement.innerHTML = `
                    <h3>Block ${block.index}</h3>
                    <pre>${JSON.stringify(block, null, 2)}</pre>
                `;
                blockchainContainer.appendChild(blockElement);
            });
        }

        // Add a new block to the blockchain
        function addBlock() {
            const blockData = document.getElementById('blockData').value;
            if (!blockData) {
                alert('Please enter block data'); // Basic validation
                return;
            }

            const previousBlock = blockchain[blockchain.length - 1];

            // Dummy hash generation for demonstration; not secure!
            const newBlock = {
                index: blockchain.length, // Next block index
                timestamp: new Date().getTime(), // Current time
                data: blockData, // User-entered data
                previousHash: previousBlock.hash, // Link to previous block
                hash: `hash of block ${blockchain.length}` // Placeholder hash
            };

            blockchain.push(newBlock); // Append new block
            displayBlockchain(); // Refresh UI

            // Clear the input field for next entry
            document.getElementById('blockData').value = '';
        }

        // Initial rendering of the blockchain on page load
        displayBlockchain();
    </script>
</body>
</html>
