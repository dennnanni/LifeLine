window.onload = function load() {
    let toast = document.querySelector(".toast");
    let imageElement = document.querySelector("#post-image");
    let inputFile = document.querySelector('#immaginePost');
    let titleArea = document.querySelector('#title');
    let descriptionArea = document.querySelector('#description');

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
    });

    titleArea.addEventListener('input', function() {
        titleArea.style.height = "auto";
        titleArea.style.height = titleArea.scrollHeight + "px";
    });
    
    descriptionArea.addEventListener('input', function() {
        descriptionArea.style.height = "auto";
        descriptionArea.style.height = descriptionArea.scrollHeight + "px";
    });

    if (toast) {
        toast.addEventListener('click', function() {
            toast.classList.remove('show');
        });
    }
}

function saveField(field, value) {
    request = $.ajax({
        url: "ajax/create.php",
        type: "POST",
        data: { "field": field, "value": value }
    });
}