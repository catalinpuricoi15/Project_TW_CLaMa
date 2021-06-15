function respondToRequest(idRequest, accepted) {
    let request = new XMLHttpRequest();
    request.open("post", `/class/request/${idRequest}`, true);
    request.responseType = "json";
    request.onreadystatechange = function () {
        if (this.readyState === 4 && this.status === 200) {
            location.reload();
        }
    }
    let data = new FormData();
    data.append("idRequest", idRequest);
    data.append("accepted", accepted);
    request.send(data);
}