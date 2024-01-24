window.onload = function load() {
    let toast = document.querySelector(".toast");
    let imageElement = document.querySelector("#post-image");
    let inputFile = document.querySelector('#immaginePost');
    let textArea = document.querySelector('#description');

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

    textArea.addEventListener('input', function() {
        textArea.style.height = "auto";
        textArea.style.height = textArea.scrollHeight + "px";
    });

    if (toast) {
        toast.addEventListener('click', function() {
            toast.classList.remove('show');
        });
    }
}