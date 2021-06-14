var x = document.getElementById("login");
var y = document.getElementById("register");
var z = document.getElementById("btn");


function moveRegister() {
    x.style.left = "-400px";
    y.style.left = "50px";
    z.style.left = "110px";
}

function moveLogin() {
    x.style.left = "50px";
    y.style.left = "450px";
    z.style.left = "0px";
}

if(window.location.pathname == "/register"){
    moveRegister();
}
else {
    moveLogin();
}

function register() {
    window.location.href = "/register";
}

function login() {
    window.location.href = "/login";
}
