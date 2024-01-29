$(document).ready(function() {

    let searchBar = document.querySelector("#searchBar");

    searchBar.addEventListener("input", function() {
        let data = searchBar.value;
        if (data == "") {
            showResult("{}");
        } else {
            request = $.ajax({
                url: "ajax/search.php",
                type: "POST",
                data: JSON.stringify(data),
                success: function(response) {
                    showResult(response);
                }
            });
        }
    });

    function showResult(data) {
        let result = "";
        data = JSON.parse(data);

        data.forEach(user => {
            result += `
            <a href="diary.php?username=${user["username"]}" class="text-decoration-none">
                <div class="mt-2">
                <img name="propic-medium" src="upload/${user["profilePic"]}"/>
                <span class="d-inline-block text-dark">${user.username}</span>
                </div>
            </a>
            `;
        })

        let resultContainer = document.querySelector("#searchResult");
        resultContainer.innerHTML = result;
    }
});