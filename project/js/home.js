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
            let postElement = `<h5>${date}</h5>`;

            postByDay[date].forEach(post => {
                let imagePresent = post.image != null;

                let imageIHTML = imagePresent ? `
                <div class="col d-flex align-items-center justify-content-end">
                    <div class="rounded-4 thumbnail-wrapper">
                        <img class="rounded-4 w-100" src="upload/${post.image}" alt="post image"/>
                    </div>
                </div>
                ` : "";

                postElement += `
                <div class="row mb-4 px-2">
                    <div class="border border-3 border-tertiary-light rounded-4 position-relative">
                        <div class="lifeline-small position-absolute h-100 ms-1 ms-md-7"> 
                        </div>
                        <a href="post.php?id=${post.id}" class="text-decoration-none text-dark row py-2 position-relative">
                            <div class="col-1 ps-2 ps-md-8">
                                <div class="icon-medium bg-secondary rounded-4 d-flex align-items-center justify-content-center">
                                    <i class="fs-5 fa-solid ${getCategoryIconClass(post.category)}"></i>
                                </div>
                            </div>
                            <div class="${imagePresent ? "col-6 col-md-8 pe-1" : "col-11"} ps-1 ps-md-0">
                                <h3 class="fs-5">@${post.author}</h3>
                                <section>
                                    <header>
                                        <h4 class="fs-4">${post.title}</h4>
                                    </header>
                                    <p class="text-truncate">${post.description}</p>
                                    <footer class="d-flex h-100">
                                        <div class="col-9 d-inline-flex align-items-center fs-5">
                                            <div>
                                                <span class="me-1">${post.starsCount}</span>
                                                <i class="fa-${post.starred ? "solid text-secondary" : "regular"} fa-star"></i>
                                            </div>
                                            <div class="ms-5">
                                                <span class="me-1">${post.commentsCount}</span>
                                                <i class="fa-regular fa-comment"></i>
                                            </div>
                                        </div>
                                        <div class="col d-inline-flex align-items-center justify-content-end fs-5">
                                            ${post.tag.length != 0 ? "<i class=\"fa-solid fa-tags me-1\"></i>" : ""}
                                            ${post.location != null ? "<i class=\"fa-solid fa-location-dot\"></i>" : ""}
                                        </div>
                                    </footer>
                                </section>
                            </div>
                            ${imageIHTML}
                        </a>
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