

function respondToRequest(request, response) {
    var elem = document.getElementById(request);
    elem.parentNode.removeChild(elem);
}