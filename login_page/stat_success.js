var numlogin = localStorage.getItem('numlogin');
if (numlogin === null) {
    numlogin = 0;
}

numlogin++;

localStorage.setItem("numlogin", numlogin);

document.getElementById('numlogin').innerHTML = numlogin;
localStorage.setItem("p1", "numlogin");
localStorage.setItem("numlogin", numlogin);