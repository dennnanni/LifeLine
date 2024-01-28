<?php if(isset($templateParams["loginError"])): ?>
    <div class="toast-container position-absolute top-0 start-50 translate-middle-x">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto text-secondary">Lifeline</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close" onclick="closeToast(this)"></button>
            </div>
            <div class="toast-body"><?php echo $templateParams["loginError"]; ?></div>
        </div>
    </div>
<?php endif; ?>
<header class="mt-4">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="text-primary">LifeLine</h1>
            </div>
        </div>
    </div>
</header>
<main class="mt-5">
    <div class="row justify-content-center mb-4">
        <div class="col-xl-5 col-md-6 col-10">
            <ul class="nav nav-pills">
                <li class="nav-item col-5 col-xl-5">
                    <a class="nav-link text-secondary btn-lg fw-bold" id="signin" href="signin.php">Sign in</a>
                </li>
                <li class="nav-item col-5 col-xl-5">
                    <a class="nav-link text-dark btn-lg fw-bold" id="signup" href="signup.php">Sign up</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
        <form class="col-xl-5 col-md-6 col-10" action="signin.php" method="POST" id="signinForm">
            <ul class="list-unstyled">
                <li>
                    <label for="email" hidden>Email</label>
                    <input class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="text" id="email" name="email" placeholder="Email" required/>
                </li>
                <li>
                    <label for="password" hidden>Password</label>
                    <input class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="password" id="password" name="password" placeholder="Password" required/>
                </li>
                <li>
                    <label for="submit" hidden>Login</label>
                    <input class="w-100 rounded-3 border-0 bg-secondary btn-lg text-dark" type="submit" name="submit" id="submit" value="Submit" />
                </li>
            </ul>
        </form>
    </div>
</main>