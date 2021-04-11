
var template = document.getElementById("post").innerHTML;

function postNews(){
    var checkBox = document.getElementById("check-assignment");
    var date = document.getElementById("date-assignment");

    if(document.getElementById("post_title").value && document.getElementById("post_content").value && 
        (!checkBox.checked || date.value != null)) {

        var post = document.createElement("div");
        var id = "post-" + getRandomInt(1000000);
        if(checkBox.checked)
            id = "assignment-" + getRandomInt(1000000);
        post.setAttribute("id", id);

        if(checkBox.checked){
            post.setAttribute("class", "post assignment");
            post.setAttribute("onClick", "assignmentClick('" + id + "')");
        }
        else
            post.setAttribute("class", "post news");

        post.innerHTML = template;
        document.getElementById("news").insertBefore(post, document.getElementById("news").firstChild);

        var currentdate = new Date(); 

        post.getElementsByClassName("post-title")[0].innerHTML = document.getElementById("post_title").value;

        if(checkBox.checked)
          post.getElementsByClassName("post-date")[0].innerHTML = 
                  "deadline: " + date.value;
        else
          post.getElementsByClassName("post-date")[0].innerHTML = 
                  "Posted on: " + currentdate.getDate() + "/"
                  + (currentdate.getMonth()+1)  + "/" 
                  + currentdate.getFullYear() + " @ "  
                  + currentdate.getHours() + ":"  
                  + currentdate.getMinutes() + ":" 
                  + currentdate.getSeconds();

        post.getElementsByClassName("post-author")[0].innerHTML = username;
        post.getElementsByClassName("post-content")[0].innerHTML = document.getElementById("post_content").value;

        if(checkBox.checked)
          post.getElementsByClassName("post-content")[0].setAttribute("class", "post-content assignment-description");
        else
          post.getElementsByClassName("post-content")[0].setAttribute("class", "post-content news-description");
    }

    document.getElementById("post_title").value = "";
    document.getElementById("post_content").value = "";
}

function postTypeChanged() {
    var checkBox = document.getElementById("check-assignment");
    var date = document.getElementById("date-assignment-div");
  
    if (checkBox.checked == true){
      date.style.display = "block";
    } else {
      date.style.display = "none";
    }
  }

function assignmentClick(assignment) {
  window.location.href = "assignment.html?username=" + username + "&classId=" + id + "&assignment=" + assignment;
}