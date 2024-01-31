window.addEventListener('load', function() {
    let backArrow = document.getElementById("backArrow");
    let done = document.getElementById("done");

    console.log(backArrow);
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
});

function requestBackPage() {
    $.ajax({
        url: "ajax/history.php",
        type: "GET",
        data: { "action": "getBackPageUrl" },
        success: function(response) {
            let data = JSON.parse(response);
            location.href = data;
        }
    });
}