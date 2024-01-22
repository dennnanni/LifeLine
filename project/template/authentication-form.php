<header class="mt-4">

    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="">LifeLine</h1>
            </div>
        </div>
    </div>

</header>
<main class="mt-5">

    <input type="button" value="Sign in" id="signin">
    <input type="button" value="Sign up" id="signup">

    <form action="#" method="POST" id="signinForm">
        <?php if(isset($templateParams["errorelogin"])): ?>
        <p><?php echo $templateParams["errorelogin"]; ?></p>
        <?php endif; ?>
        <ul class="list-unstyled p-3">
            <li>
                <input class="w-100 mb-1 rounded-3 border-1 border-secondary border-solid border" type="text" id="email-login" name="email-login" placeholder="Email"/>
            </li>
            <li>
                <input class="w-100 mb-1 rounded-3 border-1 border-secondary border-solid border" type="password" id="password-login" name="password-login" placeholder="Password"/>
            </li>
            <li>
                <input class="w-100 rounded-3 border-0 bg-secondary" type="submit" name="submit" value="Submit" />
            </li>
        </ul>
    </form>

    <form action="#" method="POST" id="signupForm" hidden>
        <?php if(isset($templateParams["errorelogin"])): ?>
        <p><?php echo $templateParams["errorelogin"]; ?></p>
        <?php endif; ?>
        <ul>
            <li>
                <label for="username"></label><input type="text" id="username" name="username" placeholder="Username"/>
            </li>
            <li>
                <label for="fullname-registration"></label><input type="text" id="fullname-registration" name="fullname-registration" placeholder="Full Name"/>
            </li>
            <li>
                <label for="birthdate"></label><input type="date" id="birthdate" name="birthdate" placeholder="Birth Date"/>
            </li>
            <li>
                <label for="email-registration"></label><input type="text" id="email-registration" name="email-registration" placeholder="Email"/>
            </li>
            <li>
                <label for="password"></label><input type="text" id="password" name="password" placeholder="Password"/>
            </li>
            <li>
                <input type="submit" name="submit" value="Submit" />
            </li>
        </ul>
    </form>

</main>