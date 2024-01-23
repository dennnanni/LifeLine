<header class="mt-4">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1>LifeLine</h1>
            </div>
        </div>
    </div>
</header>
<main class="mt-5">
    <div class="row justify-content-center mb-4">
        <div class="col-xl-5 col-md-6 col-10">
            <ul class="nav nav-pills">
                <li class="nav-item col-4 col-xl-5">
                    <a class="nav-link text-secondary btn-lg fw-bold" id="signin">Sign in</a>
                </li>
                <li class="nav-item col-4 col-xl-5">
                    <a class="nav-link text-tertiary btn-lg fw-bold" id="signup">Sign up</a>
                </li>
            </ul>
        </div>
    </div>

    <div class="row justify-content-center">
        <form class="col-xl-5 col-md-6 col-10" action="#" method="POST" id="signinForm">
            <ul class="list-unstyled">
                <li>
                    <label for="email-login" hidden>Email</label>
                    <input class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg" type="text" id="email-login" name="email-login" placeholder="Email"/>
                </li>
                <li>
                    <label for="password-login" hidden>Password</label>
                    <input class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg" type="password" id="password-login" name="password-login" placeholder="Password"/>
                </li>
                <li>
                    <label for="submit-login" hidden>Login</label>
                    <input class="w-100 rounded-3 border-0 bg-secondary btn-lg" type="submit" name="submit" id="submit-login" value="Submit" />
                </li>
            </ul>
            <?php if(isset($templateParams["errorelogin"])): ?>
                <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
        </form>
    </div>

    <div class="row justify-content-center">
        <form class="col-xl-5 col-md-6 col-10" action="#" method="POST" id="signupForm" hidden>
            <ul class="list-unstyled">
                <li>
                   <label for="username" hidden>Username</label>
                   <input required class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg" type="text" id="username" name="username" placeholder="Username"/>
                </li>
                <li>
                   <label for="fullname-registration" hidden>Full Name</label>
                   <input required class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg" type="text" id="fullname-registration" name="fullname-registration" placeholder="Full Name"/>
                </li>
                <li>
                   <label for="email-registration" hidden>Email</label>
                   <input required class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg" type="text" id="email-registration" name="email-registration" placeholder="Email"/>
                </li>
                <li>
                    <label for="password" hidden>Password</label>
                    <input required class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg" type="text" id="password" name="password" placeholder="Password"/>
                </li>
                <li>
                    <label for="submit-registration" hidden>Submit</label>
                    <input class="w-100 rounded-3 border-0 bg-secondary btn-lg" type="submit" name="submit" id="submit-registration" value="Submit" />
                </li>
            </ul>
            <?php if(isset($templateParams["errorelogin"])): ?>
                <p><?php echo $templateParams["errorelogin"]; ?></p>
            <?php endif; ?>
        </form>
    </div>

</main>