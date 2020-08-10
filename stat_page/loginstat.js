var numlogin = localStorage.getItem('numlogin');
var numfail = localStorage.getItem('numfail');



function reset_counter() {
    localStorage.removeItem('numlogin');
    localStorage.removeItem('numfail');
 
}

document.getElementById('reset2').addEventListener('click', reset_counter);

let myChart2 = document.getElementById('myChart2').getContext('2d');


Chart.defaults.global.defaultFontFamily = 'Sans-serif';
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.defaultFontColor = '#777';

let loginChart = new Chart(myChart2, {
    type: 'bar',
    data: {
        labels: ['Successful Logins', 'Failed Logins'],
        datasets: [{
            labels: ["Number of successful logins"],

            data: [
                numlogin,
                numfail,
                

            ],

            backgroundColor: [
                
                'rgba(54, 162, 235, 0.6)',
                'rgba(255, 99, 132, 0.6)',
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
            text: 'Successful Logins',
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