
var actions = document.getElementById("actions");
var classes = document.getElementById("classes");


function goToClass(id){
    window.location.href = "./clasa.html" + "?username=" + username + "&classId=" + id;
}