window.onload = function load() {
    let imageElement = document.querySelector("#post-image");
    let inputFile = document.querySelector('#immaginePost');

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
}