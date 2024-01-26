window.onload = function load() {
    let checks = document.getElementsByClassName("bi-check-circle-fill");

    for (let i = 0; i < checks.length; i++) {

        checks[i].addEventListener('click', function() {
            if (checks[i].classList.contains("text-tertiary")) {
                checks[i].classList.add("text-secondary");
                checks[i].classList.remove("text-tertiary");

                let username = checks[i].previousElementSibling.textContent;
                sendAction(username, "ADD");
            } else {
                checks[i].classList.remove("text-secondary");
                checks[i].classList.add("text-tertiary");

                let username = checks[i].previousElementSibling.textContent;
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