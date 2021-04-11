let params = new URLSearchParams(location.search);
var username = params.get('username');
var type = "";

function validateUser() {
    if(username === null || (
        username !== "student" &&
        username != "profesor" )) {
        window.location.href = "../auth.html";
    } 

    if(username == "student")
        type = "student";
    else
        type = "profesor"
}

function goTo(page) {
    window.location.href = page + "?username=" + username;
}
 
validateUser();