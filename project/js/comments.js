window.onload = function load() {
    let commentArea = document.getElementById('commentArea');
    let sendButton = document.getElementById('sendButton');

    sendButton.addEventListener('click', function() {
        if (commentArea.value != "") {
            let postId = document.getElementById("postId").value;
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
            addComment(response.user.username, response.user.profilePic, comment);
        }
    });
}

function addComment(username, profilePic, text) {
    let newComment = `
    <div class="ms-4">
        <a href="diary.php?username=${username}" class="text-decoration-none d-flex align-items-center">
            <div class="rounded-circle propic-wrapper-sm">
                <img class="propic" src="upload/${profilePic}" alt="friend profile picture"/>
            </div>
            <div class="d-inline-block text-dark ms-2 w-100 mt-3">
                <span class="fw-bold d-block">${username}</span>
                <p class="text-break">${text}</p>
            </div>
        </a>
    </div>`;
    document.getElementById("comments").innerHTML += newComment;
}