window.onload = function load() {
    let postId = document.getElementById("postId").value;
    let postComment = document.getElementById("postComment");
    let input = document.getElementById("comment");

    postComment.addEventListener('click', function() {
        if(input.value != "") {
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
        success: function() {
            addComment(comment);
        }
    });
}

function addComment(text) {
    let comment = document.createElement("p");
    comment.textContent = text;
    document.getElementById("comments").appendChild(comment);
}