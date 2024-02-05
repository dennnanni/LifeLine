$(document).ready(function() {

    let searchBar = document.querySelector("#searchBar");

    searchBar.addEventListener("input", function() {
        let data = searchBar.value;
        if (data != "") {
            request = $.ajax({
                url: "ajax/search.php",
                type: "POST",
                data: JSON.stringify(data),
                success: showResult
            });
        } else {
            document.querySelector("#searchResult").innerHTML = "";
        }
    });

    function showResult(data) {
        let result = "";
        data = JSON.parse(data);

        data.forEach(user => {
            result += `
            <a href="diary.php?username=${user["username"]}" class="text-decoration-none pt-2 d-flex align-items-center">
                <div class="rounded-circle propic-wrapper-md d-inline-block"> 
                    <img class="propic" src="upload/${user["profilePic"]}" alt="${user.username}'s profile picture"/>
                </div>    
                <span class="d-inline-block text-dark ms-3">${user.username}</span>
            </a>
            `;
        })

        let resultContainer = document.querySelector("#searchResult");
        resultContainer.innerHTML = result;
    }
});