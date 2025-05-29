const graph = document.getElementById('graph').getContext('2d');
const chart = new Chart(graph, {
  type: 'line',
  data: {
    labels: [],
    datasets: [{
      label: 'Price',
      data: [],
      backgroundColor: 'rgba(255, 99, 132, 0.2)',
      borderColor: 'rgba(255, 99, 132, 1)',
      borderWidth: 1
    }]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          beginAtZero: true
        }
      }]
    }
  }
});

const startButton = document.getElementById('start-button');
const stopButton = document.getElementById('stop-button');
const pairInput = document.getElementById('pair-input');
const volumeInput = document.getElementById('volume-input');
const priceInput = document.getElementById('price-input');
const logsList = document.getElementById('logs-list');

let trading = false;
let pair = '';
let volume = 0;
let price = 0;
let buyPrice = 0;
let profit = 0.10;

startButton.addEventListener('click', () => {
  if (!trading) {
    trading = true;
    pair = pairInput.value;
    volume = parseFloat(volumeInput.value);
    price = parseFloat(priceInput.value);

    if (volume !== 0.00001) {
      alert('Only 0.00001 BTC is allowed for trading');
      return;
    }

    startTrading();
  }
});

stopButton.addEventListener('click', () => {
  if (trading) {
    trading = false;
    stopTrading();
  }
});

function startTrading() {
  // Make API request to start trading
  fetch('/start-trading', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      pair: pair,
      volume: volume,
      price: price
    })
  })
  .then(response => response.json())
  .then(data => {
    buyPrice = data.price;
    console.log(`Bought ${volume} ${pair} at ${buyPrice}`);
    updateGraph(data.price);
  })
  .catch(error => console.error(error));

  // Set interval to check for profit
  setInterval(() => {
    fetch('/get-price', {
      method: 'GET',
      headers: {
        'Content-Type': 'application/json'
      }
    })
    .then(response => response.json())
    .then(data => {
      const currentPrice = data.price;
      console.log(`Current price: ${currentPrice}`);

      if (currentPrice >= buyPrice + profit) {
        console.log(`Sold ${volume} ${pair} at ${currentPrice}`);
        updateGraph(currentPrice);
        stopTrading();
      }
    })
    .catch(error => console.error(error));
  }, 1000);
}

function stopTrading() {
  // Make API request to stop trading
  fetch('/stop-trading', {
    method: 'POST',
    headers: {
      'Content-Type': 'application/json'
    },
    body: JSON.stringify({
      pair: pair,
      volume: volume,
      price: price
    })
  })
  .then(response => response.json())
  .then(data => console.log(data))
  .catch(error => console.error(error));
}

function updateGraph(price) {
  chart.data.datasets[0].data.push(price);
  chart.update();
}