<?php
require_once("bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);

    if (empty($email)) {
        $templateParams["loginError"] = "Error! You can't use empty information!";
    }
    else {
        $login_result = $dbh->login($email, $password);
        if(is_null($login_result)){
            $templateParams["loginError"] = "Error! Incorrect email or password!"; //Login fallito
        }
        else{
            registerUserSession($login_result["username"], $login_result["name"]);
        }
    }
}

if(isUserLoggedIn()){
    header("Location: home.php");
    exit();
}

$_SESSION["current"] = "signin";
$templateParams["title"] = "Login";
$templateParams["active"] = "signin-form.php";
$templateParams["js"] = "authentication.js";

require("template/base.php");
?>