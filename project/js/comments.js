let commentId = null;

window.onload = function load() {
    let commentArea = document.getElementById("commentArea");
    let sendButton = document.getElementById("sendButton");
    let confirmDelete = document.getElementById("confirmDelete");
    let toast = document.getElementById("toast");
    let dismiss = document.getElementById("toastDismiss");
    let postId = document.getElementById("postId").value;

    confirmDelete.addEventListener("click", function() {
        if (commentId == null) {
            dismiss.click();
        }

        $.ajax({
            url: "ajax/delete.php",
            type: "POST",
            data: { "commentId": commentId, "postId": postId },
            success: function() {
                window.location.reload();
            }
        })
    })

    document.querySelectorAll('[name="deleteButton"]').forEach(function(button) {
        button.addEventListener('click', function() {
            toast.classList.add("show");
            toast.parentElement.classList.add("display-overlapped");
            commentId = button.parentElement.children[0].value;
        });
    })

    dismiss.addEventListener("click", function() {
        var toastElement = dismiss.closest('.toast');

        if (toastElement) {
            toastElement.classList.remove("show");
            toastElement.parentElement.classList.remove("display-overlapped");
            commentId = null;
        }
    });

    sendButton.addEventListener('click', function() {
        if (commentArea.value != "") {
            sendComment(commentArea.value, postId);
            commentArea.value = "";
        }
    });
}

function sendComment(comment, postId) {
    request = $.ajax({
        url: "ajax/comments.php",
        type: "POST",
        data: { "comment": comment, "postId": postId },
        success: function(data) {
            let response = JSON.parse(data);
            addComment(response.user.username, response.user.profilePic, comment, response.commentId);
        }
    });
}

function addComment(username, profilePic, text, id) {
    let newComment = `
    <div class="ms-4 d-flex align-items-center">
        <div class="rounded-circle propic-wrapper-sm">
            <img class="propic" src="upload/${profilePic}" alt="friend profile picture"/>
        </div>
        <div class="d-inline-flexbox flex-grow-1 text-dark ms-2 mt-3">
            <div class="d-flex justify-content-between">
                <input type="hidden" value="${id}" />
                <a href="diary.php?username=${username}" class="d-block text-dark fw-bold text-decoration-none d-flex align-items-center">
                    ${username}
                </a>
                <label for="${id}" hidden>Delete the comment</label>
                <button id="${id}" class="btn bg-light border-0" name="deleteButton">
                    <span class="fa-solid fa-trash"></span>
                </button>
            </div>
            <p class="text-break">
                ${text}
            </p>
        </div>
    </div>`;
    document.getElementById("comments").innerHTML += newComment;

    let toast = document.getElementById("toast");
    document.querySelectorAll('[name="deleteButton"]').forEach(function(button) {
        button.addEventListener('click', function() {
            toast.classList.add("show");
            toast.parentElement.classList.add("display-overlapped");
            commentId = button.parentElement.children[0].value;
        });
    })
}