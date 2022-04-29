function checkPass()
{
    //Store the password field objects into variables
    var pass1 = document.getElementById('password_entry');
    var pass2 = document.getElementById('pass2');
    //Store the Confirmation Message Object
    var message = document.getElementById('confirmMessage');
    //Compare the values in the password field
    //and the confirmation field
    if(pass1.value === pass2.value){
        //The passwords match.
        //Set the color to the good color and inform
        //the user that they have entered the correct password
        pass2.style.backgroundColor = "#66cc66";
        message.style.color = "#66cc66";
        message.innerHTML = "Passwords Match!"
    }else{
        //The passwords do not match.
        //Set the color to the bad color and
        //notify the user.
        pass2.style.backgroundColor = "#ff6666";
        message.style.color = "#ff6666";
        message.innerHTML = "Passwords Do Not Match!"
    }
}

function validateEmail()
{
    var mailformat = /[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?/;
    var email = document.getElementById('email');
    var message = document.getElementById('confirmEmail');
    if(email.value.match(mailformat))
    {
        email.style.backgroundColor = "#66cc66";
        message.style.color = "#66cc66";
        message.innerHTML = "Valid Email Address."
        return true;
    }
    else
    {
        email.style.backgroundColor = "#ff6666";
        message.style.color = "#ff6666";
        message.innerHTML = "Invalid Email Address!"
        return false;
    }
}