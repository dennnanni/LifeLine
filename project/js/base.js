window.addEventListener('load', function() {
    let title = document.getElementById("title");
    let backArrow = document.getElementById("backArrow");
    let done = document.getElementById("done");

    if (title) {
        title.addEventListener("click", function() {
            changeFooterActivePage("home");
        });
    }

    if (backArrow) {
        backArrow.addEventListener("click", function() {
            requestBackPage();
        });
    }

    if (done) {
        done.addEventListener("click", function() {
            requestBackPage();
        });
    }

    let footerLinks = document.getElementsByClassName("footerLink");
    for(let i = 0; i < footerLinks.length; i++) {
        footerLinks[i].addEventListener("click", function() {
            changeFooterActivePage(footerLinks[i].id);
        });
    }
});

function requestBackPage() {
    $.ajax({
        url: "ajax/base.php",
        type: "GET",
        data: { "action": "getBackPageUrl" },
        success: function(response) {
            let data = JSON.parse(response);
            location.href = data;
        }
    });
}

function changeFooterActivePage(page) {
    $.ajax({
        url: "ajax/base.php",
        type: "GET",
        data: { "action": "setFooterActivePage", "page": page },
        success: function() {
            location.href = page + ".php";
        }
    });
}