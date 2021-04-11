
var info = document.getElementById("info");
var actions = document.getElementById("actions");

var id = params.get('classId');

if(type !== "student") {
    info.innerHTML = 'Id Clasa: ' + id;
} else {
    actions.innerHTML = 'Buna!';
}

function addClass(){
    var input = document.getElementById("class_id");
    input.value = "";
}
