$(document).ready(function() {
    let star = document.getElementById("star");
    let username = document.getElementById("currentUser").value;
    let postId = document.getElementById("postId").value;

    star.addEventListener("click", function() {

        let starIcon = star.children[0];
        let action = "";
        if(starIcon.classList.contains("fa-solid")) {
            action = "REMOVE";
        } else {
            action = "ADD";
        }

        $.ajax({
            url: "ajax/star.php",
            type: "POST", 
            data: {"action" : action, "username": username, "postId": postId },
            success: function(response) {
                let data = JSON.parse(response);
                let starsCount = document.getElementById("starsCount");
                starsCount.innerHTML = data.starsCount;

                if(action == "ADD") {
                    starIcon.classList.add("fa-solid", "text-secondary");
                    starIcon.classList.remove("fa-regular");
                } else {
                    starIcon.classList.remove("fa-solid", "text-secondary");
                    starIcon.classList.add("fa-regular");
                }
            }
        });
    });
});