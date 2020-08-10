var numDiagPage = localStorage.getItem('numDiagPage');

if (numDiagPage === null) {
    numDiagPage = 0;
}

numDiagPage++;

localStorage.setItem("numDiagPage", numDiagPage);

document.getElementById('numDiagPage').innerHTML = numDiagPage;
localStorage.setItem("numDiagPage", numDiagPage);