var pos = 0;    //this is the current position of the elevator

function myMove(floor, pot) 
{
    var target_raw_floor_number;
    if(floor == "1"){
        target_raw_floor_number = 465;
    }
    else if(floor == "2"){
        target_raw_floor_number = 240;
    }
    else if(floor == "3"){
        target_raw_floor_number = 15;
    }

    var elem = document.getElementById("elevator1");   
    var id = setInterval(frame, 10);        //sets speed

    function frame() {
      if (pos == target_raw_floor_number) { //this is target
        clearInterval(id);
        floor_sign(floor);
        cha_back(pot); 

      } else if(pos < target_raw_floor_number) {
        pos++; 
        elem.style.top = pos + 'px'; 
      }
      else if(pos > target_raw_floor_number){
          pos--;
          elem.style.top = pos + 'px'; 
      }
    }
}


function floor_sign(floor)
{
    switch(floor){
        case 1:
           document.getElementById('flrnbr').src='../images/1.png';
      break;

      case 2:
          document.getElementById('flrnbr').src='../images/2.png';
      break;

      case 3:
         document.getElementById('flrnbr').src='../images/3.png';
        break;
    }
}

function cha_col(pot)
{
    switch(pot){
        case "dwnfl3":
            document.getElementById('dwnfl3').src='../images/Buttons/Buttons for Eduard/Buttons--10.png';
            setTimeout(cha_col1, 1000);
        break;

        case "dwnfl2":
            document.getElementById('dwnfl2').src='../images/Buttons/Buttons for Eduard/Buttons--10.png';
            setTimeout(cha_col2, 1000);
        break;

        case "upfl2":
            document.getElementById('upfl2').src='../images/Buttons/Buttons for Eduard/Buttons--09.png';
            setTimeout(cha_col3, 1000);
        break;

        case "upfl1":
            document.getElementById('upfl1').src='../images/Buttons/Buttons for Eduard/Buttons--09.png';
            setTimeout(cha_col4, 1000);
        break;

        case "elv1":
            document.getElementById('elv1').src='../images/Buttons/Buttons for Eduard/Buttons--02.png';
            myMove(1, pot);
        break;

        case "elv2":
            document.getElementById('elv2').src='../images/Buttons/Buttons for Eduard/Buttons--04.png';
            myMove(2, pot);
        break;

        case "elv3":
            document.getElementById('elv3').src='../images/Buttons/Buttons for Eduard/Buttons--06.png';
            myMove(3, pot);
        break;
    }
}

function cha_back(pot)
{
    switch(pot){
        case "dwnfl3":
            document.getElementById('dwnfl3').src='../images/Buttons/Buttons for Eduard/Buttons--08.png';    
        break;

        case "dwnfl2":
            document.getElementById('dwnfl2').src='../images/Buttons/Buttons for Eduard/Buttons--08.png';    
        break;

        case "upfl2":
            document.getElementById('upfl2').src='../images/Buttons/Buttons for Eduard/Buttons--07.png';    
        break;

        case "upfl1":
            document.getElementById('upfl1').src='../images/Buttons/Buttons for Eduard/Buttons--07.png';    
        break;

        case "elv1":
            document.getElementById('elv1').src='../images/Buttons/Buttons for Eduard/Buttons--01.png';    
        break;

        case "elv2":
            document.getElementById('elv2').src='../images/Buttons/Buttons for Eduard/Buttons--03.png';    
        break;

        case "elv3":
            document.getElementById('elv3').src='../images/Buttons/Buttons for Eduard/Buttons--05.png';    
        break;
    }
}







//delay functions.  Can be taken out later 
function cha_col1()
{
    document.getElementById('dwnfl3').src='../images/Buttons/Buttons for Eduard/Buttons--08.png';    
}

function cha_col2()
{
    document.getElementById('dwnfl2').src='../images/Buttons/Buttons for Eduard/Buttons--08.png';    
}

function cha_col3()
{
    document.getElementById('upfl2').src='../images/Buttons/Buttons for Eduard/Buttons--07.png';    
}

function cha_col4()
{
    document.getElementById('upfl1').src='../images/Buttons/Buttons for Eduard/Buttons--07.png';    
}

function cha_col5()
{
    document.getElementById('elv1').src='../images/Buttons/Buttons for Eduard/Buttons--01.png';    
}

function cha_col6()
{
    document.getElementById('elv2').src='../images/Buttons/Buttons for Eduard/Buttons--03.png';    
}

function cha_col7()
{
    document.getElementById('elv3').src='../images/Buttons/Buttons for Eduard/Buttons--05.png';    
}