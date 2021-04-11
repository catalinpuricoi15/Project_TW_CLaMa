
var info = document.getElementById("info");
var actions = document.getElementById("actions");

var id = params.get('classId');

document.getElementById("id").innerHTML = id  ;

function doAction(action){
    window.location.href = action + ".html" + "?username=" + username + "&classId=" + id;
}