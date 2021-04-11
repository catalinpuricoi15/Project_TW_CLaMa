
var actions = document.getElementById("actions");
var classes = document.getElementById("classes");


function addClass(){
    var input = document.getElementById("class_id");
    input.value = "";
}

function goToClass(id){
    window.location.href = "./clasa.html" + "?username=" + username + "&classId=" + id;
}