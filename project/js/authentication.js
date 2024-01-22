window.onload = function load() {
    console.log("prova");
    var signin = document.getElementById("signin");
    var signup = document.getElementById("signup");
    var signinForm = document.getElementById("signinForm");
    var signupForm = document.getElementById("signupForm");

    signin.addEventListener("click", function() {
        signupForm.classList.add("hidden");
        signinForm.classList.remove("hidden");
    });

    signup.addEventListener("click", function() {
        signinForm.classList.add("hidden");
        signupForm.classList.remove("hidden");
    });
}