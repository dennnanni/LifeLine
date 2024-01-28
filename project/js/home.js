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
    sendAction("", "REMOVE"); //Dummy request to load posts without filters
}

function sendAction(category, action) {
    request = $.ajax({
        url: "ajax/home.php",
        type: "POST",
        data: { "category": category, "action": action },
        success: function(response) {
            showPosts(response);
        }
    });
}

function showPosts(data) {
    let result = "";
    let post = JSON.parse(data);
    for (let i = 0; i < post.length; i++) {
        let postElement = `
        <section class="mt-2">
            <span class="d-inline-block text-dark">${post[i]["title"]}</span>
            <span class="d-inline-block text-dark">(${post[i]["author"]})</span>
            <span class="d-inline-block text-dark">${post[i]["datetime"]}</span>
        </section>
        `;
        result += postElement;
    }

    let resultContainer = document.querySelector("#posts");
    resultContainer.innerHTML = result;
}