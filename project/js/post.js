$(document).ready(function() {
    
    let star = document.getElementById("star");
    let username = document.getElementById("currentUser").value;
    let postId = document.getElementById("postId").value;
    let sendButton = document.getElementById("sendButton");
    let commentArea = document.getElementById("commentArea");
    let confirmDelete = document.getElementById("confirmDelete");
    let deleteButton = document.getElementById("deleteButton");
    let toast = document.getElementById("toast");
    let dismiss = document.getElementById("toastDismiss")

    confirmDelete.addEventListener("click", function() {
        $.ajax({
            url: "ajax/delete.php", 
            type: "POST", 
            data: {"postId": postId}, 
            success: function() {
                window.location.href = "diary.php";
            }
        })
    })

    deleteButton.addEventListener('click', function() {
        toast.classList.add("show");
        toast.parentElement.classList.add("display-overlapped");
    });

    dismiss.addEventListener("click", function() {
        var toastElement = dismiss.closest('.toast');

        if (toastElement) {
            toastElement.classList.remove("show");
            toastElement.parentElement.classList.remove("display-overlapped");
        }
    });

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

                if(data.starsCount > 0) {
                    starsCount.setAttribute("href", "stars.php?id=" + postId);
                } else {
                    starsCount.removeAttribute("href");
                }

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
            addComment(response.user.username, response.user.profilePic, comment, response.commentsCount, postId);
        }
    });
}

function addComment(username, profilePic, text, commentsCount, postId) {
    let newComment = `
    <div class="d-flex align-items-center ms-3">
        <div class="rounded-circle propic-wrapper-sm">
            <img class="propic" src="upload/${profilePic}" alt="Your profile picture" aria-hidden="true"/>
        </div>    
        <a class="d-flexbox flex-grow-1 text-decoration-none text-dark ms-2 mt-3" href="comments.php?id=${postId}" title="See comment in comments page">
            <span class="fw-bold d-block">${username}</span>
            <p class="text-break">${text}</p>
        </a>
    </div>
    `;

    document.getElementById("comment").innerHTML = newComment;
    document.getElementById("commentsCount").innerHTML = commentsCount;
}