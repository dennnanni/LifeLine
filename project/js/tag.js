window.onload = function load() {
    let checks = document.getElementsByClassName("bi-check-circle-fill");

    for (let i = 0; i < checks.length; i++) {
        // console.log(checks[i]);
        checks[i].addEventListener('click', function() {
            console.log(checks[i]);
            let username = checks[i].closest('div').previousElementSibling.querySelector('span').id;

            if (checks[i].classList.contains("text-tertiary")) {
                checks[i].classList.add("text-secondary");
                checks[i].classList.remove("text-tertiary");

                sendAction(username, "ADD");
            } else {
                checks[i].classList.remove("text-secondary");
                checks[i].classList.add("text-tertiary");

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