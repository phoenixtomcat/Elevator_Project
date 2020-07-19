var pos = 465; //this is the current position of the elevator
var floor_db;
var warning = document.getElementById('warning');

//AJAX functions to communicate with the backend/database
function setFloorDB(floor){
    var xmlhttpShow = new XMLHttpRequest();
    // xmlhttpShow.onreadystatechange = function(){
    //     if (this.readyState == 4 && this.status == 200){
    //         if (typeof callback === 'function')
    //             callback(this.responseText);
    //     }
    // }
    xmlhttpShow.open('GET', 'elevator_control.php?q='+floor, true);
    xmlhttpShow.send();
}

function setLogic(button_id){
    var xmlhttpShow = new XMLHttpRequest();
    // xmlhttpShow.onreadystatechange = function(){
    //     if (this.readyState == 4 && this.status == 200){
    //         if (typeof callback === 'function')
    //             callback(this.responseText);
    //     }
    // }
    xmlhttpShow.open('GET', 'elevator_logic.php?x=' + button_id, true);
    xmlhttpShow.send();
}

function getFloorDB(callback){
    var xmlhttpShow = new XMLHttpRequest();
    xmlhttpShow.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if (typeof callback === 'function')
                callback(this.responseText);
        }
    }
    xmlhttpShow.open('GET', 'elevator_control.php?q=null', true);
    xmlhttpShow.send();

}

//Callback function to init elevator position
function elevatorInitCallback(result){
    floor_db = result;
    initElevator();
}

function countlogin(elevatorInit){
    if (elevatorInitCallback >= 0){
        counter++;
    }

}

//Functions for GUI animation
function initElevator(){
    //Since AJAX is async, this function has to be called inside the callback function

    //update GUI floor number
    floor_sign(parseInt(floor_db));

    //Move GUI elevator to corrent floor
    var elem = document.getElementById("elevator1");
    switch (floor_db){
        case "1":
            elem.style.top = "465px";
            pos = 465;
            break;
        case "2":
            elem.style.top = "240px";
            pos = 240;
            break;
        case "3":
            elem.style.top = "15px";
            pos = 15;
            break;
    }
}


function myMove(floor) {
    var target_raw_floor_number;
    if (floor == "1") {
        target_raw_floor_number = 465;
    } else if (floor == "2") {
        target_raw_floor_number = 240;
    } else if (floor == "3") {
        target_raw_floor_number = 15;
    }

    var elem = document.getElementById("elevator1");
    var id = setInterval(frame, 5); //sets speed

    function frame() {
        close_door();
        if (pos == target_raw_floor_number) { //this is target
            clearInterval(id);
            floor_sign(floor);
            floor_audio(floor);
            open_door();
           // setTimeout(close_door(), 1000);

        } else if (pos < target_raw_floor_number) {
            pos++;
            if (pos == 240)
            {
                floor_sign(2);
            }
            elem.style.top = pos + 'px';
        } else if (pos > target_raw_floor_number) {
            pos--;
            if (pos == 240)
            {
                floor_sign(2);
            }
            elem.style.top = pos + 'px';
        }
    }
}

function floor_audio(floor){
    var x; 
    switch (floor) {
        case 1:
           x = document.getElementById('audio_f1');
           x.play();
            break;

        case 2:
            x = document.getElementById('audio_f2');
            x.play();
            break;

        case 3:
            x = document.getElementById('audio_f3');
            x.play();
            break;
    }
}

function open_door(){
    document.getElementById('elevator1').src = '../images/image001.png';
}

function close_door(){
    document.getElementById('elevator1').src = '../images/elevator1.png';
}

var play_music = document.getElementById('music');

function elevator_music(){
    var x = document.getElementById('music_toggle');
    var y = document.getElementById('music_toggle_label');

    if(x.style.backgroundColor == 'green'){
        x.style.backgroundColor = 'red';
        y.innerHTML = 'OFF';
        play_music.pause();

    }else{
        x.style.backgroundColor = 'green';
        y.innerHTML = 'ON';
        play_music.loop = true;
        play_music.play();
        
    }
    
}

function floor_sign(floor) {
    switch (floor) {
        case 1:
            document.getElementById('flrnbr').src = '../images/1.png';
            break;

        case 2:
            document.getElementById('flrnbr').src = '../images/2.png';
            break;

        case 3:
            document.getElementById('flrnbr').src = '../images/3.png';
            break;
    }
}

function cha_col(pot) {
    switch (pot) {
        case "dwnfl3":
            document.getElementById('dwnfl3').src = '../images/Buttons/Buttons for Eduard/Buttons--10.png';
            setLogic(pot);
            setTimeout(cha_col1, 1000);
            break;

        case "dwnfl2":
            document.getElementById('dwnfl2').src = '../images/Buttons/Buttons for Eduard/Buttons--10.png';
            setLogic(pot);           
            //setTimeout(cha_col2, 1000);
            break;

        case "upfl2":
            document.getElementById('upfl2').src = '../images/Buttons/Buttons for Eduard/Buttons--09.png';
            setLogic(pot);
            //setTimeout(cha_col3, 1000);
            break;

        case "upfl1":
            document.getElementById('upfl1').src = '../images/Buttons/Buttons for Eduard/Buttons--09.png';
            setLogic(pot);
            //setTimeout(cha_col4, 1000);
            break;

        case "elv1":
            document.getElementById('elv1').src = '../images/Buttons/Buttons for Eduard/Buttons--02.png';
            //setFloorDB(1);
            setLogic(pot);
            //myMove(1, pot);
            break;

        case "elv2":
            document.getElementById('elv2').src = '../images/Buttons/Buttons for Eduard/Buttons--04.png';
            //setFloorDB(2);      
            setLogic(pot);
            //myMove(2, pot);
            break;

        case "elv3":
            document.getElementById('elv3').src = '../images/Buttons/Buttons for Eduard/Buttons--06.png';
            //setFloorDB(3);
            setLogic(pot);
            //myMove(3, pot);
            break;
    }
}

function cha_back(pot) {
    switch (pot) {
        case "dwnfl3":
            document.getElementById('dwnfl3').src = '../images/Buttons/Buttons for Eduard/Buttons--08.png';
            break;

        case "dwnfl2":
            document.getElementById('dwnfl2').src = '../images/Buttons/Buttons for Eduard/Buttons--08.png';
            break;

        case "upfl2":
            document.getElementById('upfl2').src = '../images/Buttons/Buttons for Eduard/Buttons--07.png';
            break;

        case "upfl1":
            document.getElementById('upfl1').src = '../images/Buttons/Buttons for Eduard/Buttons--07.png';
            break;

        case "elv1":
            document.getElementById('elv1').src = '../images/Buttons/Buttons for Eduard/Buttons--01.png';
            break;

        case "elv2":
            document.getElementById('elv2').src = '../images/Buttons/Buttons for Eduard/Buttons--03.png';
            break;

        case "elv3":
            document.getElementById('elv3').src = '../images/Buttons/Buttons for Eduard/Buttons--05.png';
            break;
    }
}

function GUIgetFloorDB(callback){
    var xmlhttpShow = new XMLHttpRequest();
    xmlhttpShow.onreadystatechange = function(){
        if (this.readyState == 4 && this.status == 200){
            if (typeof callback === 'function')
                callback(this.responseText);
        }
    }
    xmlhttpShow.open('GET', 'updateGui.php?q=null', true);
    xmlhttpShow.send();

}

//Callback function to init elevator position
function elevatorRunCallback(result){
    floor_db = result;
    moveElevator();
}

function moveElevator(){
    //Since AJAX is async, this function has to be called inside the callback function

    //update GUI floor number
    floor_sign(parseInt(floor_db));

    //Move GUI elevator to corrent floor
    var elem = document.getElementById("elevator1");
    switch (floor_db){
        case "3":
            myMove(3)
            cha_back("dwnfl3");
            cha_back("elv3");

            break;
        case "2":
            myMove(2)
            cha_back("dwnfl2");
            cha_back("upfl2");
            cha_back("elv2");
            break;
        case "1":
            myMove(1)
            cha_back("upfl1");
            cha_back("elv1");
            break;
    }
}

var statusIntervalId = window.setInterval(function(){GUIgetFloorDB(elevatorRunCallback)}, 1000);

//document.addEventListener("DOMContentLoaded", function(){updatGui()}, false);

//Update elevator info when page loads
document.addEventListener("DOMContentLoaded", function(){getFloorDB(elevatorInitCallback)}, false);

//document.addEventListener("DOMContentLoaded", function(){countlogin(elevatorInitCallback)}, false);


//delay functions.  Can be taken out later 
function cha_col1() {
    document.getElementById('dwnfl3').src = '../images/Buttons/Buttons for Eduard/Buttons--08.png';
}

function cha_col2() {
    document.getElementById('dwnfl2').src = '../images/Buttons/Buttons for Eduard/Buttons--08.png';
}

function cha_col3() {
    document.getElementById('upfl2').src = '../images/Buttons/Buttons for Eduard/Buttons--07.png';
}

function cha_col4() {
    document.getElementById('upfl1').src = '../images/Buttons/Buttons for Eduard/Buttons--07.png';
}

function cha_col5() {
    document.getElementById('elv1').src = '../images/Buttons/Buttons for Eduard/Buttons--01.png';
}

function cha_col6() {
    document.getElementById('elv2').src = '../images/Buttons/Buttons for Eduard/Buttons--03.png';
}

function cha_col7() {
    document.getElementById('elv3').src = '../images/Buttons/Buttons for Eduard/Buttons--05.png';
}

