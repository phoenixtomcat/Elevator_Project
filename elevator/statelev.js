var numElevatorPage = localStorage.getItem('numElevatorPage');

if (numElevatorPage === null) {
    numElevatorPage = 6;
}

numElevatorPage++;

localStorage.setItem("numElevatorPage", numElevatorPage);

document.getElementById('numElevatorPage').innerHTML = numElevatorPage;
localStorage.setItem("numElevatorPage", numElevatorPage);