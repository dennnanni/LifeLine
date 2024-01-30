window.onload = function load() {
    let filter = document.getElementsByClassName("filter");

    for (let i = 0; i < filter.length; i++) {

        filter[i].addEventListener('click', function() {
            let category = filter[i].id;

            if (filter[i].classList.contains("bg-light")) {
                filter[i].classList.remove("bg-light");
                filter[i].classList.remove("text-dark");
                filter[i].classList.add("bg-primary");
                filter[i].classList.add("text-light");

                sendAction("ADD", category);
            } else {
                filter[i].classList.remove("bg-primary");
                filter[i].classList.remove("text-light");
                filter[i].classList.add("bg-light");
                filter[i].classList.add("text-dark");

                sendAction("REMOVE", category);
            }
        });
    }
    sendAction("SHOWALL"); //Dummy request to load posts without filters
}

function sendAction(action, category = "") {
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
    let postByDay = JSON.parse(data);

    for (let date in postByDay) {
        if (postByDay.hasOwnProperty(date)) {
            let postElement = `<h2>${date}</h2>`;

            postByDay[date].forEach(post => {
                postElement += `
                <a href="diary.php?username=${post.author}" class="text-decoration-none pt-2 d-block">
                    <span class="d-inline-block text-dark">${post.title}</span>
                    <span class="d-inline-block text-dark">(${post.author})</span>
                    <span class="d-inline-block text-dark">${post.timestamp}</span>
                </a>
                `;
            });
            result += postElement;
        }
    }

    let resultContainer = document.querySelector("#posts");
    resultContainer.innerHTML = result;
}