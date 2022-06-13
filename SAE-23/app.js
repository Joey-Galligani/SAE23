var now = new Date().getTime();
var lastMonth = new Date().getTime() - (86400000 * 31);


var urlToFetch = `https://api.coincap.io/v2/assets/bitcoin/history?interval=d1&start=${lastMonth}&end=${now}`

var btcData = [];
var btcLabel = [];

fetch(urlToFetch)
    .then(response => response.json())
    .then((response) => {
        response.data.forEach(element => {
            console.log(element)
            btcData.push(element.priceUsd)
            console.log(element.date);
            btcLabel.push(element.date.slice(0, 10))
        });

        const data = {
            labels: btcLabel,
            datasets: [{
                label: 'prix du bitcoin',
                backgroundColor: 'rgb(10,255,50)',
                borderColor: 'rgb(15,125,6)',
                data: btcData,
            }]
        };


        const config = {
            type: 'line',
            data: data,
            options: {}
        };

        const myChart = new Chart(
            document.getElementById('myChart'),
            config
        );
    });

    //document.getElementById("zbi").innerHTML(data);
