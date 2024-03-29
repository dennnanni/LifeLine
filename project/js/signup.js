window.onload = function () {
    let dismiss = document.getElementById("toastDismiss");
    let toast = document.getElementById("toast");
    let errorMessage = document.getElementById("errorMessage");
    let submit = document.getElementById("submit");

    let showMessage = function(message) {
        errorMessage.innerHTML = message;
        toast.classList.add("show");
    }

    dismiss.addEventListener('click', function() {
        var toastElement = dismiss.closest('.toast');

        if (toastElement) {
            toastElement.classList.remove('show');
        }
    });

    submit.addEventListener('click', function() {
        result = $.ajax({
            url: "ajax/signup.php",
            type: "POST",
            data: $("#signupForm").serialize(),
            success: function(response) {
                if (response == "success") {
                    window.location.assign("photo.php")
                } else {
                    let data = JSON.parse(response);
                    showMessage(data.error);
                }
            },
        });
    });
}