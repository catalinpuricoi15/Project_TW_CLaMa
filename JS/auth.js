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

var username = document.getElementById("username");
var login_pass = document.getElementById("loginPassword");

var password = document.getElementById("password");
var confirm_password = document.getElementById("confirmPassword");

function validatePassword() {
    if (password.value != confirm_password.value) {
        confirm_password.setCustomValidity("Passwords Don't Match");
    } else {
        confirm_password.setCustomValidity('');
    }
}

password.onchange = validatePassword;
confirm_password.onkeyup = validatePassword;

function validate() {
    if (username.value === "profesor")
        return true;

    if (username.value === "student")
        return true;

    return false;
}

function getType(user) {
    if (user === "student")
        return "students";
    return "profs";
}

function submitLogin() {

    if (!validate())
        alert("username and password don't match");
    else {
        var type = getType(username.value);
        window.location.href = type + "/home.html?username=" + username.value;
    }
}