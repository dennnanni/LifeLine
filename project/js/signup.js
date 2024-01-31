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
            url: "ajax/authentication.php",
            type: "POST",
            data: $("#signupForm").serialize(),
            success: function(response) {
                let data = JSON.parse(response);
                // response contains the first field that failed validation and the reason
                showMessage(data.error);
            },
        });
    });
}