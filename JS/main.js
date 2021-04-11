let params = new URLSearchParams(location.search);
var username = params.get('username');
var type = "";

function getRandomInt(max) {
    return Math.floor(Math.random() * max);
}
  
function validateUser() {
    if(username === null || (
        username !== "student" &&
        username !== "profesor" )) {
        window.location.href = "../auth.html";
    } 

    if(username == "student")
        type = "studenti";
    else
        type = "profesori";
}

function goTo(page) {
    if(page ==="orar.html")
    window.location.href = "https://profs.info.uaic.ro/~orar/participanti/orar_I2B3.html";
    else
    window.location.href =  page + "?username=" + username;
}
 
validateUser();