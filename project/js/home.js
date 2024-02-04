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
            document.querySelectorAll('[name="starButton"]').forEach(button => likeHandler(button));
        }
    });
}

function showPosts(data) {
    let result = "";
    let postByDay = JSON.parse(data);

    for (let date in postByDay) {
        if (postByDay.hasOwnProperty(date)) {
            let postElement = `<h5>${date}</h5>`;

            postByDay[date].forEach(post => {
                let imagePresent = post.image != null;

                let imageIHTML = imagePresent ? `
                <div class="col d-flex align-items-center justify-content-end">
                    <a href="post.php?id=${post.id}" class="text-decoration-none text-dark">
                        <div>
                            <img class="rounded-4 thumbnail" src="upload/${post.image}" alt="post image"/>
                        </div>
                    </a>
                </div>
                ` : "";

                postElement += `
                <div class="row mb-4 px-2">
                    <div class="border border-3 border-tertiary-light rounded-4 position-relative">
                        <div class="lifeline-small position-absolute h-100 ms-1 ms-md-7"> 
                        </div>
                        <div class="row py-2 position-relative">
                            <div class="col-1 ps-2 ps-md-8">
                                <div class="icon-medium bg-secondary rounded-4 d-flex align-items-center justify-content-center">
                                    <i class="fs-5 fa-solid ${getCategoryIconClass(post.category)}"></i>
                                </div>
                            </div>
                            <div class="${imagePresent ? "col-6 col-md-8 pe-1" : "col-11"} ps-2 ps-lg-0">
                                <article class="d-flex flex-column h-100">
                                    <div class="d-flex flex-grow-1 flex-column">
                                        <a href="diary.php?username=${post.author}" class="text-decoration-none text-dark"><h3 class="fs-5">@${post.author}</h3></a>
                                        <a href="post.php?id=${post.id}" class="text-decoration-none text-dark">
                                            <header>
                                                <h4 class="fs-4">${post.title}</h4>
                                            </header>
                                            <p class="text-truncate">${post.description}</p>
                                        </a>
                                    </div>
                                    <footer class="d-flex">
                                        <div class="col-9 d-inline-flex align-items-center fs-5">
                                            <span class="me-1">${post.starsCount}</span>
                                            <button name="starButton" type="button" class="border-0 bg-light">
                                                <input type="hidden" value="${post.id}"/>
                                                <i class="fa-${post.starred ? "solid text-secondary" : "regular"} fa-star"></i>
                                            </button>
                                            <span class="ms-5 me-1">${post.commentsCount}</span>
                                            <i class="fa-regular fa-comment"></i>
                                        </div>
                                        <div class="col d-inline-flex align-items-center justify-content-end fs-5">
                                            ${post.tag.length != 0 ? "<i class=\"fa-solid fa-tags me-1\"></i>" : ""}
                                            ${post.location != null ? "<i class=\"fa-solid fa-location-dot\"></i>" : ""}
                                        </div>
                                    </footer>
                                </article>
                            </div>
                            ${imageIHTML}
                        </div>
                    </div>
                </div>
                `;
            });
            result += postElement;
        }
    }

    let resultContainer = document.querySelector("#posts");
    resultContainer.innerHTML = result;
}


function getCategoryIconClass(category) {
    switch (category) {
        case "Love":
            return "fa-heart";
        case "Fun":
            return "fa-champagne-glasses";
        case "Music":
            return "fa-music";
        case "Art":
            return "fa-palette";
        case "Food":
            return "fa-burger";
        case "Fashion":
            return "fa-shirt";
        case "Sport":
            return "fa-football";
        case "Travel":
            return "fa-plane";
        default:
            return "";
    }
}

function likeHandler(button) {
    button.addEventListener('click', function() {
        let username = document.getElementById("currentUser").value;
        let postId = button.children[0].value;
        let starIcon = button.children[1];
        let action = "";
        if(starIcon.classList.contains("fa-solid")) {
            action = "REMOVE";
        } else {
            action = "ADD";
        }

        $.ajax({
            url: "ajax/star.php",
            type: "POST", 
            data: {"action" : action, "username": username, "postId": postId },
            success: function(response) {
                let data = JSON.parse(response);
                let starsCount = button.parentElement.children[0];
                starsCount.innerHTML = data.starsCount;

                if(action == "ADD") {
                    starIcon.classList.add("fa-solid", "text-secondary");
                    starIcon.classList.remove("fa-regular");
                } else {
                    starIcon.classList.remove("fa-solid", "text-secondary");
                    starIcon.classList.add("fa-regular");
                }
            }
        });
    });
}