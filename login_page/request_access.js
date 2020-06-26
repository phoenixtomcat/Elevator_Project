var el;			// Get the message element <textarea>

function charCount(e) {
    /*Count remaining allowed char in text box
    return: true  --within allowed limit
            false --exceed limit */
	var textEntered, charDisplay, counter;
	textEntered = document.getElementById('accessText').value;    	// text input by user 
	charDisplay = document.getElementById('charactersLeft');  	// Get element that displays remaining chars 
	
    counter = (180 - (textEntered.length));						// remaining chars
    if (counter < 0){
        charDisplay.innerHTML = 'Exceeded Limit'; // Show remaining chars
        return false;
    }
    else {
        charDisplay.innerHTML = 'Characters remaining: ' + counter; // Show remaining chars
        return true;
    }
    
	
}

function checkInputLength(e, minLength){
    /* check value length of input field
    return: true  --value length > minLength
            false --value length <= minLength
    */
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
        warning.style.color = "red";
        return false;
    }
    else{
        warning.innerHTML = "";
        return true;
    }
}

function change_src(element, new_src){
    element.setAttribute('src', new_src)
}


function comparePassword() {
    /* to compare password and re-enter password
    return: true  -- two passwords match
            false -- two passwords do not match*/
    if (password_1.value != password_2.value) {
        warning.innerHTML = "Re-entered password does not match!";
        warning.style.color = "red";
        return false;
    } else {
        warning.innerHTML = "";
        return true;
    }

}

function checkUsernameDuplicate() {
    /* to Check if username already exists at database
    return: true  -- no duplicate
            false -- duplicated or username length is zero */
    if (username.value.length != 0) {
        //Only send request when username value is not empty
        var xmlhttpShow = new XMLHttpRequest();
        xmlhttpShow.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                var resp = this.responseText;
                if (resp == true) {
                    //no duplicate
                    warning.innerHTML = "Username is ok";
                    warning.style.color = "blue";
                    return true;
                } else {
                    //found duplicated username
                    warning.innerHTML = "Username already exists";
                    warning.style.color = "red";
                    return false;
                }

            }
        }
        xmlhttpShow.open('GET', 'username_duplication_check.php?q='+username.value, true);
        xmlhttpShow.send();
    }else{
        warning.innerHTML = "";
        return false;
    }

}

function validateForm(e){
    /* Check everything before submitting the form
    return: true  --all requirements met
            false --any requirement violated */

    var result = checkUsernameDuplicate() &&
                comparePassword() &&
                firstname.value.length > 0 &&
                lastname.value.length > 0 &&
                username.value.length > 0 &&
                email.value.length > 0 &&
                password_2.value.length > 0;

    if (!result) {
        e.preventDefault();
        return false;
    } else
        return true;
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

el.addEventListener('keydown', charCount, false); 
firstname.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
lastname.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
email.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
username.addEventListener('blur', function(e){checkInputLength(e, 0), checkUsernameDuplicate()}, false);
password_1.addEventListener('blur', function(e){checkInputLength(e, 0)}, false);
password_2.addEventListener('blur', function(e){checkInputLength(e, 0), comparePassword()}, false);

//image rollover for request access button
request_access.addEventListener('mouseover', function(){change_src(request_access, request_access_src2)}, false);
request_access.addEventListener('mouseout', function(){change_src(request_access, request_access_src1)}, false);
request_access.addEventListener('mousedown', function(){change_src(request_access, request_access_src3)}, false);
