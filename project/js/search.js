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

        for (let i = 0; i < data.length; i++) {
            let user = `
            <section class="w-100 ms-n40 ms-md-n3 mt-2">
            <img name="search-propic" src="upload/${data[i]["profilePic"]}"/>
            <span class="d-inline-block text-dark">${data[i]["username"]}</span>
            </section>
            `;
            result += user;
        }

        let resultContainer = document.querySelector("#searchResult");
        resultContainer.innerHTML = result;
    }
});