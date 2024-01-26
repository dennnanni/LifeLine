window.onload = function load() {
    let checks = document.getElementsByClassName("bi-check-circle-fill");

    for (let i = 0; i < checks.length; i++) {

        checks[i].addEventListener('click', function() {
            if (checks[i].classList.contains("text-tertiary")) {
                checks[i].classList.add("text-secondary");
                checks[i].classList.remove("text-tertiary");

                let username = checks[i].previousElementSibling.textContent;
                send(username, "POST");
            } else {
                checks[i].classList.remove("text-secondary");
                checks[i].classList.add("text-tertiary");

                let username = checks[i].previousElementSibling.textContent;
                send(username, "DELETE");
            }
        });
    }
}

function send(username, method) {
    request = $.ajax({
        url: "utils/tag-ajax.php",
        type: method,
        data: { "username": username }
    });
}