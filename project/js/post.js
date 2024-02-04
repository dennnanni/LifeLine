$(document).ready(function() {
    let star = document.getElementById("star");
    let username = document.getElementById("currentUser").value;
    let postId = document.getElementById("postId").value;
    let sendButton = document.getElementById("sendButton");
    let commentArea = document.getElementById("commentArea");

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

    sendButton.addEventListener('click', function() {
        if (commentArea.value != "") {
            let postId = document.getElementById("postId").value;
            sendComment(commentArea.value, postId);
            commentArea.value = "";
        }
    });


});

function sendComment(comment, postId) {
    request = $.ajax({
        url: "ajax/comments.php",
        type: "POST",
        data: { "comment": comment, "postId": postId },
        success: function(data) {
            let response = JSON.parse(data);
            addComment(response.user.username, response.user.profilePic, comment, response.commentsCount);
        }
    });
}

function addComment(username, profilePic, text, commentsCount) {
    let newComment = `
    <div class="d-flex align-items-center ms-3">
        <img class="propic-small" src="upload/${profilePic}" alt="Your profile picture" aria-hidden="true"/>
        <div class="d-inline-block text-dark ms-2 w-100 mt-3">
            <span class="fw-bold d-block">${username}</span>
            <p class="text-break">${text}</p>
        </div>
    </div>
    `;

    document.getElementById("comment").innerHTML = newComment;
    document.getElementById("commentsCount").innerHTML = commentsCount;
}