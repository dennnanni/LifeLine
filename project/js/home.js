window.onload = function load() {
    let filter = document.getElementsByClassName("filter");

    for (let i = 0; i < filter.length; i++) {

        filter[i].addEventListener('click', function() {
            let category = filter[i].id;

            if (filter[i].classList.contains("bg-light")) {
                filter[i].classList.remove("bg-light");
                filter[i].classList.add("bg-primary");

                sendAction(category, "ADD");
            } else {
                filter[i].classList.remove("bg-primary");
                filter[i].classList.add("bg-light");

                sendAction(category, "REMOVE");
            }
        });
    }
}

function sendAction(category, action) {
    request = $.ajax({
        url: "ajax/home.php",
        type: "POST",
        data: { "category": category, "action": action }
    });
}