window.onload = function load() {
    let actionButton = document.getElementById("actionButton");
    let friendshipStatus = document.getElementById("friendshipStatus");

    if (friendshipStatus.value == 1) {
        actionButton.value = "Remove friend";
        actionButton.classList.add("btn-tertiary");
    } else if (friendshipStatus.value == 0) {
        actionButton.value = "Cancel request";
        actionButton.classList.add("btn-tertiary");
    } else {
        actionButton.value = "Add friend";
        actionButton.classList.add("btn-secondary");
    }
}