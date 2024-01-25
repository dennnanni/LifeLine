$(document).ready(function() {
    
    let searchButton = document.querySelector("#searchButton");
    let searchBar = document.querySelector("#searchBar");
    
    searchButton.addEventListener("click", function() {
        let data = searchBar.value;
        console.log('boiade');
        
        request = $.ajax({
            url: "utils/ajax.php",
            type: "POST",
            data: JSON.stringify(data),
            success: function(response) {
                showResult(response);
            }
        });
    });
    
    function showResult(data) {
        let result = "";
        data = JSON.parse(data);
        console.log(data);
        
        for (let i = 0; i < data.length; i++) {
            let user = `
            <section class="w-100 ms-n40 ms-md-n3 mt-2">
            <img name="search-propic" src="upload/${data[i]["profilePic"]}"/>
            <span class="d-inline-block">${data[i]["username"]}</span>
            </section>
            `;
            result += user;
        }
        
        let resultContainer = document.querySelector("#searchResult");
        resultContainer.innerHTML = result;
    }
});