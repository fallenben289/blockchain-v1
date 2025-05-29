<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Blockchain UI</title>
    <style>
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
        <div class="blockchain" id="blockchain"></div>
        <div class="form-container">
            <input type="text" id="blockData" placeholder="Enter block data">
            <button onclick="addBlock()">Add Block</button>
        </div>
    </div>

    <script>
        const blockchainContainer = document.getElementById('blockchain');

        // Initialize blockchain in PHP and get it as JSON (for demonstration purposes, we use an array)
        let blockchain = [
            {
                index: 0,
                timestamp: new Date().getTime(),
                data: "Genesis Block",
                previousHash: "0",
                hash: "hash of genesis block"
            }
        ];

        function displayBlockchain() {
            blockchainContainer.innerHTML = '';
            blockchain.forEach(block => {
                const blockElement = document.createElement('div');
                blockElement.className = 'block';
                blockElement.innerHTML = `
                    <h3>Block ${block.index}</h3>
                    <pre>${JSON.stringify(block, null, 2)}</pre>
                `;
                blockchainContainer.appendChild(blockElement);
            });
        }

        function addBlock() {
            const blockData = document.getElementById('blockData').value;
            if (!blockData) {
                alert('Please enter block data');
                return;
            }

            const previousBlock = blockchain[blockchain.length - 1];
            const newBlock = {
                index: blockchain.length,
                timestamp: new Date().getTime(),
                data: blockData,
                previousHash: previousBlock.hash,
                hash: `hash of block ${blockchain.length}`
            };

            // Add the new block to the blockchain
            blockchain.push(newBlock);
            displayBlockchain();

            // Clear input field
            document.getElementById('blockData').value = '';
        }

        // Initial display
        displayBlockchain();
    </script>
</body>
</html>
