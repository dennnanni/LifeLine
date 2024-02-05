window.onload = function load() {
    let checks = document.getElementsByName("userSelector");

    for (let i = 0; i < checks.length; i++) {
        checks[i].addEventListener('click', function() {
            let username = checks[i].closest('div').previousElementSibling.querySelector('span').id;
            let icon = checks[i].children[0];

            if (icon.classList.contains("text-tertiary")) {
                icon.classList.add("text-secondary");
                icon.classList.remove("text-tertiary");

                sendAction(username, "ADD");
            } else {
                icon.classList.remove("text-secondary");
                icon.classList.add("text-tertiary");

                sendAction(username, "REMOVE");
            }
        });
    }
}

function sendAction(username, action) {
    request = $.ajax({
        url: "ajax/tag.php",
        type: "POST",
        data: { "username": username, "action": action }
    });
}