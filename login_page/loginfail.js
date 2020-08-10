var numfail = localStorage.getItem('numfail');
if (numfail === null) {
    numfail = 0;
}

numfail++;

localStorage.setItem("numfail", numfail);

document.getElementById('numfail').innerHTML = numfail;
localStorage.setItem("p1", "numfail");
localStorage.setItem("numfail", numfail);