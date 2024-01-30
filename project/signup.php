<?php
require_once("bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validate($_POST["username"]);
    $fullname = validate($_POST["fullname"]);
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);

    if (empty($username) || empty($fullname) || empty($email) || empty($password)) {
        $templateParams["registrationError"] = "Error! You can't use empty information!";
    }
    else if(!preg_match("/^[a-zA-Z0-9._]*$/",$username)) {
        $templateParams["registrationError"] = "Error! Username can only contain letters, numbers, periods, and underscores!";
    }
    else if(!preg_match("/^[a-zA-Z' ]*$/",$username)) {
        $templateParams["registrationError"] = "Error! Name can't contain numer or special character!";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $templateParams["registrationError"] = "Error! Invalid email format!";
    }
    else if($dbh->checkUsername($username)) {
        $templateParams["registrationError"] = "Error! Username already in use!";
    }
    else if($dbh->checkEmail($email)) {
        $templateParams["registrationError"] = "Error! Email already in use!";
    }
    else {
        $registration_result = $dbh->createAccount($username, $fullname, $email, $password);
        if(!$registration_result){
            $templateParams["registrationError"] = "Error while creating the account!";
        }
        else{
            registerUserSession($username, $fullname);
        }
    }
}

if(isUserLoggedIn()){
    header("Location: home.php");
    exit();
}

$_SESSION["current"] = basename($_SERVER["REQUEST_URI"]);
$templateParams["title"] = "Registration";
$templateParams["active"] = "signup-form.php";
$templateParams["js"] = "authentication.js";

require("template/base.php");
?>