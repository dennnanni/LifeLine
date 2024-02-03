window.onload = function load() {
    let postId = document.getElementById("postId").value;
    let postComment = document.getElementById("postComment");
    let input = document.getElementById("comment");

    postComment.addEventListener('click', function() {
        if (input.value != "") {
            sendComment(input.value, postId);
            input.value = "";
        }
    });

}

function sendComment(comment, postId) {
    request = $.ajax({
        url: "ajax/comments.php",
        type: "POST",
        data: { "comment": comment, "postId": postId },
        success: function(data) {
            let user = JSON.parse(data);
            addComment(user.username, user.profilePic, comment);
        }
    });
}

function addComment(username, profilePic, text) {
    let newComment = `
    <div class="ms-4">
        <a href="diary.php?username=${username}" class="text-decoration-none d-flex align-items-center">
            <img class="propic-small" src="upload/${profilePic}" alt="friend profile picture"/>
            <div class="d-inline-block text-dark ms-2 w-100 mt-3">
                <span class="fw-bold d-block">${username}</span>
                <p class="text-break">${text}</p>
            </div>
        </a>
    </div>`;
    document.getElementById("comments").innerHTML += newComment;
}