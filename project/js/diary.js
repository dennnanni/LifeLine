window.onload = function load() {
    let actionButton = document.getElementById("actionButton");
    let friendshipStatus = document.getElementById("friendshipStatus");
    let username = document.getElementById("username");
    let acceptFriendship = document.getElementById("acceptFriendship");
    let denyFriendship = document.getElementById("denyFriendship");


    let updateStatus = function(action) {
        $.ajax({
            url: "ajax/diary.php", 
            type: "POST",
            data: {"action": action, "username": username.innerText, "friendshipStatus": friendshipStatus.value},
            success: function(response) {
                console.log(response);
                setUpAction();
            }
        });
    }

    let setUpAction = function() {
        if (acceptFriendship != null) acceptFriendship.attributes.add("hidden", true);
        if (denyFriendship != null) denyFriendship.attributes.add("hidden", true);

        if (friendshipStatus.value == 1) {
            actionButton.value = "Remove friend";
            actionButton.classList.remove("btn-secondary")
            actionButton.classList.add("btn-tertiary");
            window.location.reload();
        } else if (friendshipStatus.value == 0) {
            actionButton.value = "Cancel request";
            actionButton.classList.remove("btn-secondary")
            actionButton.classList.add("btn-tertiary");
        } else {
            actionButton.value = "Add friend";
            actionButton.classList.remove("btn-tertiary");
            actionButton.classList.add("btn-secondary");
        }
    }

    if (acceptFriendship != null) {
        acceptFriendship.addEventListener('click', function() {
            friendshipStatus.value = 1;
            updateStatus("ADD");
        });
    }

    if (denyFriendship != null) {
        denyFriendship.addEventListener('click', function() {
            friendshipStatus.value = -1;
            updateStatus("CANCEL");
        });
    }

    if (actionButton != null) {
        setUpAction();
        actionButton.addEventListener('click', function() {
            if (friendshipStatus.value == 1) {
                friendshipStatus.value = -1;
                updateStatus("REMOVE");
            } else if (friendshipStatus.value == 0) {
                friendshipStatus.value = -1;
                updateStatus("CANCEL");
            } else {
                friendshipStatus.value = 0;
                updateStatus("SEND");
            }            
        });
    }
}