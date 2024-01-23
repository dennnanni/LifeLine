function closeToast(button) {
    var toastElement = button.closest('.toast');

    if (toastElement) {
        toastElement.classList.remove('show');
    }
}