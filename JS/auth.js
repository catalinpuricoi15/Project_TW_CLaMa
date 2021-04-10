var x = document.getElementById("login");
var y = document.getElementById("register");
var z = document.getElementById("btn");


function register() {

        x.style.left = "-400px";
    y.style.left = "50px";
    z.style.left = "110px";
}

function login() {
        x.style.left = "50px";
    y.style.left = "450px";
    z.style.left = "0px";
}

var password = document.getElementById("password")
var confirm_password = document.getElementById("confirm_password");

function validatePassword() {
    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;