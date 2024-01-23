<div class="toast-container position-absolute top-0 start-50 translate-middle-x">
    <?php
    if(isset($templateParams["registrationError"])):
        foreach($templateParams["registrationError"] as $error):
    ?>
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto">Lifeline</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"><?php echo $error; ?></div>
        </div>
    <?php
        endforeach;
    endif;
    ?>
</div>
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
                <li class="nav-item col-4 col-xl-5">
                    <a class="nav-link text-dark btn-lg fw-bold" id="signin" href="signin.php">Sign in</a>
                </li>
                <li class="nav-item col-4 col-xl-5">
                    <a class="nav-link text-secondary btn-lg fw-bold" id="signup" href="signup.php">Sign up</a>
                </li>
            </ul>
        </div>
    </div>
    <div class="row justify-content-center">
        <form class="col-xl-5 col-md-6 col-10" action="signup.php" method="POST" id="signupForm">
            <ul class="list-unstyled">
                <li>
                   <label for="username" hidden>Username</label>
                   <input required class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="text" id="username" name="username" placeholder="Username"/>
                </li>
                <li>
                   <label for="fullname" hidden>Full Name</label>
                   <input required class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="text" id="fullname" name="fullname" placeholder="Full Name"/>
                </li>
                <li>
                   <label for="email" hidden>Email</label>
                   <input required class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="text" id="email" name="email" placeholder="Email"/>
                </li>
                <li>
                    <label for="password" hidden>Password</label>
                    <input required class="w-100 mb-1 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="password" id="password" name="password" placeholder="Password"/>
                </li>
                <li>
                    <label for="submit" hidden>Submit</label>
                    <input class="w-100 rounded-3 border-0 bg-secondary btn-lg text-dark" type="submit" name="submit" id="submit" value="Submit" />
                </li>
            </ul>
            <!-- <?php if(isset($templateParams["registrationError"])): ?>
                <p class="text-danger"><?php echo $templateParams["registrationError"]; ?></p>
            <?php endif; ?> -->
        </form>
    </div>
</main>