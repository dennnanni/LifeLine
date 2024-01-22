<input type="button" value="Sign in" id="signin">
<input type="button" value="Sign up" id="signup">

<form action="#" method="POST" id="signinForm">
    <h2>Login</h2>
    <?php if(isset($templateParams["errorelogin"])): ?>
    <p><?php echo $templateParams["errorelogin"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="username">Username:</label><input type="text" id="username" name="username" />
        </li>
        <li>
            <label for="password">Password:</label><input type="password" id="password" name="password" />
        </li>
        <li>
            <input type="submit" name="submit" value="Submit" />
        </li>
    </ul>
</form>

<form action="#" method="POST" id="signupForm" class="hidden">
    <h2>Register</h2>
    <?php if(isset($templateParams["errorelogin"])): ?>
    <p><?php echo $templateParams["errorelogin"]; ?></p>
    <?php endif; ?>
    <ul>
        <li>
            <label for="username">Username:</label><input type="text" id="username" name="username" />
        </li>
        <li>
            <label for="password">Full Name:</label><input type="password" id="password" name="password" />
        </li>
        <li>
            <label for="password">Birth Date:</label><input type="password" id="password" name="password" />
        </li>
        <li>
            <label for="password">Email:</label><input type="password" id="password" name="password" />
        </li>
        <li>
            <label for="password">Password:</label><input type="password" id="password" name="password" />
        </li>
        <li>
            <input type="submit" name="submit" value="Submit" />
        </li>
    </ul>
</form>