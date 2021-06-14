
var id = params.get('classId');

document.getElementById("id").innerHTML = id  ;
if(id == "321")
    document.getElementById("name").innerHTML = "SGDB"  ;
else
    document.getElementById("name").innerHTML = "Tehnologii WEB"  ;


function doAction(action){
    window.location.href = action;// + ".html" + "?username=" + username + "&classId=" + id;
}