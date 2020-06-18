var el;			// Get the message element <textarea>


function charCount(e) {
	var textEntered, charDisplay, counter;
	textEntered = document.getElementById('accessText').value;    	// text input by user 
	charDisplay = document.getElementById('charactersLeft');  	// Get element that displays remaining chars 
	
    counter = (180 - (textEntered.length));						// remaining chars
    if (counter < 0){
        charDisplay.innerHTML = 'Exceeded Limit'; // Show remaining chars
    }
    else {
    charDisplay.innerHTML = 'Characters remaining: ' + counter; // Show remaining chars
    }
    
	
}

function checkInputLength(e, minLength){
    var target = e.target;
    var msg = "cannot be empty!";
    var field;

    //Check target value length
    if (target.value.length <= minLength){
        switch (target.id){
            case "firstname":
                field = "First name";
                break;
            case "lastname":
                field = "Last name";
                break;
            case "username":
                field = "Username";
                break;
            case "email":
                field = "Email";
                break;
            case "pwd1":
                field = "Password";
                break;
            case "pwd2":
                field = "Re-enter password"
                break;
        }

        msg = "<p style=\"color: red; font-weight/: bold;\">" + field + " " + msg + "</p>";
        warning.innerHTML = msg;    //replace warning text
    }
    else{
        warning.innerHTML = "";
    }
}

function change_src(element, new_src){
    element.setAttribute('src', new_src)
}

var warning = document.getElementById('warning');
var el = document.getElementById('accessText');			// Get the message element <textarea>
var firstname = document.getElementById('firstname');
var lastname = document.getElementById('lastname');
var email = document.getElementById('email');
var username = document.getElementById('username');
var password_1 = document.getElementById('pwd1');
var password_2 = document.getElementById('pwd2');
var request_access = document.getElementById("request_access");
var request_access_src1 = "../images/request_access1.png";
var request_access_src2 = "../images/request_access2.png";
var request_access_src3 = "../images/request_access3.png";

el.addEventListener('keypress', charCount, false); 
firstname.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
lastname.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
email.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
username.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
password_1.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
password_2.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);

//image rollover for request access button
request_access.addEventListener('mouseover', function(){change_src(request_access, request_access_src2)}, false);
request_access.addEventListener('mouseout', function(){change_src(request_access, request_access_src1)}, false);
request_access.addEventListener('mousedown', function(){change_src(request_access, request_access_src3)}, false);
