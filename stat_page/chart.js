var numStatPage = parseInt(localStorage.getItem('numStatPage'));
var numIndexPage = parseInt(localStorage.getItem('numIndexPage'));
var numElevatorPage = parseInt(localStorage.getItem('numElevatorPage'));
var numDiagPage = parseInt(localStorage.getItem('numDiagPage'));

if (numStatPage === null) {
    numStatPage = 0;
}

numStatPage++;


localStorage.setItem("numStatPage", numStatPage);

function reset_counter() {
    localStorage.removeItem('numStatPage');
    localStorage.removeItem('numIndexPage');
    localStorage.removeItem('numDiagPage');
    localStorage.removeItem('numElevatorPage');
}

document.getElementById('reset').addEventListener('click', reset_counter);

let myChart = document.getElementById('myChart').getContext('2d');


Chart.defaults.global.defaultFontFamily = 'arial';
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.defaultFontColor = '#777';

let statchart = new Chart(myChart, {
    type: 'pie',
    data: {
        labels: ['Stat Page Visits', 'Index Page Visits', 'Elevator Page Visits', 'Diagnostics Page Visits'],
        datasets: [{
            labels: ["Number of visits : Stats Page"],

            data: [
                numStatPage,
                numIndexPage,
                numElevatorPage,
                numDiagPage,

            ],
            
            backgroundColor: [
                'rgba(255, 99, 132, 0.6)', //red 
                'rgba(54, 162, 235, 0.6)', //blue
                'rgba(255, 206, 86, 0.6)', //yellow
                'rgba(55, 210, 86, 0.6)', //green
            ],
            borderWidth: 1,
            borderColor: '#777',
            hoverBorderWidth: 3,
            hoverBorderColor: '#000'
        }]
    },
    options: {
        title: {
            display: true,
            text: 'Website Stats',
            fontSize: 50
        },
        legend: {
            display: false,
            position: 'right',
            labels: {
                fontColor: '#000'
            }
        },
        layout: {
            padding: {
                left: 50,
                right: 0,
                bottom: 0,
                top: 0
            }
        },
        tooltips: {
            enabled: true
        }
    }
});