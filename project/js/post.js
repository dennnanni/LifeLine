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
                console.log(response);
                let starsCount = document.getElementById("starsCount");
                if(action == "ADD") {
                    starIcon.classList.add("fa-solid", "text-secondary");
                    starIcon.classList.remove("fa-regular");
                    starsCount.innerHTML = parseInt(starsCount.innerHTML) + 1;
                } else {
                    starIcon.classList.remove("fa-solid", "text-secondary");
                    starIcon.classList.add("fa-regular");
                    starsCount.innerHTML = parseInt(starsCount.innerHTML) - 1;
                }
            }
        });
    });
});