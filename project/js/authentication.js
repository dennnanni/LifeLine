window.onload = function load() {
    var signin = document.getElementById("signin");
    var signup = document.getElementById("signup");
    var signinForm = document.getElementById("signinForm");
    var signupForm = document.getElementById("signupForm");

    signin.addEventListener("click", function() {
        signupForm.setAttribute('hidden', true);
        signinForm.removeAttribute('hidden');
        
    });

    signup.addEventListener("click", function() {
        signinForm.setAttribute('hidden', true);
        signupForm.removeAttribute('hidden');
    });
}