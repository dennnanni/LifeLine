$(document).ready(function() {
    let backLink = document.getElementById("backLink");

    if(backLink) {
        backLink.addEventListener('click', function() {
            history.back();
        });
    }
});