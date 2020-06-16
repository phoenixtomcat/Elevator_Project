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
var el = document.getElementById('accessText');			// Get the message element <textarea>

el.addEventListener('keypress', charCount, false); 