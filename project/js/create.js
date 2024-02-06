window.onload = function load() {
    let imageElement = document.querySelector("#post-image");
    let inputFile = document.querySelector('#postImage');

    imageElement.addEventListener('click', function() {
        inputFile.click();
    });

    inputFile.addEventListener('change', function() {
        const imageFile = this.files[0];
        const reader = new FileReader();

        reader.onload = () => {
            const imgUrl = reader.result;
            imageElement.src = imgUrl;
        }

        if (imageFile) {
            reader.readAsDataURL(imageFile);
        }

        const formData = new FormData();
        formData.append('image', imageFile);
        saveImage(formData);
    });

    let toast = document.querySelector(".toast");

    if (toast) {
        toast.addEventListener('click', function() {
            toast.classList.remove('show');
        });
    }

    let titleArea = document.querySelector('#title');
    let descriptionArea = document.querySelector('#description');
    let locationInput = document.querySelector('#location');
    let categorySelect = document.querySelector('#category');

    titleArea.addEventListener('input', function() {
        titleArea.style.height = "auto";
        titleArea.style.height = titleArea.scrollHeight + "px";
        
        saveField("title", titleArea.value);
    });
    
    descriptionArea.addEventListener('input', function() {
        descriptionArea.style.height = "auto";
        descriptionArea.style.height = descriptionArea.scrollHeight + "px";
        
        saveField("description", descriptionArea.value);
    });

    locationInput.addEventListener('input', function() {
        saveField("location", locationInput.value);
    });

    categorySelect.addEventListener('change', function() {
        saveField("category", categorySelect.value);
    });
}

function saveField(field, value) {
    request = $.ajax({
        url: "ajax/create.php",
        type: "POST",
        data: { "field": field, "value": value }
    });
}

function saveImage(formData) {
    request = $.ajax({
        url: "ajax/create.php",
        type: "POST",
        data: formData,
        processData: false,  // tell jQuery not to process the data
        contentType: false,  // tell jQuery not to set contentType
        success: function(response) {
            // let data = JSON.parse(response);
            console.log(response);
        }
    });
}