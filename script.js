//define a function to handle the window load event
window.onload = function() {
    //get all the seat input elements
    var seats = document.querySelectorAll(".seat input");
    //loop through the seats and assign a random state to each seat
    for (var i = 0; i < seats.length; i++) {
        //generate a random number between 0 and 1
        var random = Math.random();
        //if the random number is less than 0.2, disable the seat and check the input
        if (random < 0.2) {
            seats[i].disabled = true;
            seats[i].checked = true;
        }
        //if the random number is between 0.2 and 0.4, check the seat and uncheck the input
        else if (random < 0.4) {
            seats[i].checked = true;
            seats[i].checked = false;
        }
        //if the random number is greater than 0.4, uncheck the seat and the input
        else {
            seats[i].checked = false;
            seats[i].checked = false;
        }
    }
}

//define a function to handle the seat input change event
function seatChange(event) {
    //get the target element of the event
    var target = event.target;
    //check if the target is an input element
    if (target.tagName == "INPUT") {
        //check if the target is checked
        if (target.checked) {
            //alert the user that they have selected the seat
            alert("You have selected seat " + target.id.split("-")[1]);
        } else {
            //alert the user that they have deselected the seat
            alert("You have deselected seat " + target.id.split("-")[1]);
        }
    }
}

//get the seats ordered list element
var seats = document.querySelector(".seats");
//attach a function to handle the change event of the seats element
seats.addEventListener("change", seatChange);
