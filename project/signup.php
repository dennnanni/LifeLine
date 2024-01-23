<?php
require_once("bootstrap.php");

// if(isset($_POST["email"]) && isset($_POST["password"])){
    
//     if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//     $emailErr = "Invalid email format";
//     }
//     if($dbh->checkUsername($_POST["username"])) {
//         $templateParams["registrationError"] = "Error! Username already in use!";
//     }

//     if($dbh->checkEmail($_POST["email"])) {
//         $templateParams["registrationError"] = "Error! Email already in use!";
//     }

//     $registration_result = $dbh->createAccount($_POST["username"], $_POST["fullname"], $_POST["email"], $_POST["password"]);
//     // if(!$registration_result){
//     //     $templateParams["registrationError"] = "Error while creating the accoutn!";
//     // }
//     // else{
//     //     registerUserSession($_POST["username"], $_POST["fullname"]);
//     // }
// }

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = validate($_POST["username"]);
    $fullname = validate($_POST["fullname"]);
    $email = validate($_POST["email"]);
    $password = validate($_POST["password"]);
    
    $templateParams["registrationError"] = array();

    if (empty($username) || empty($fullname) || empty($email) || empty($password)) {
        $templateParams["registrationError"][] = "Error! You can't use empty information!";
    }
    if(!preg_match("/^[a-zA-Z0-9._]*$/",$username)) {
        $templateParams["registrationError"][] = "Error! Username can only contain letters, numbers, periods, and underscores!";
    }
    if(!preg_match("/^[a-zA-Z' ]*$/",$username)) {
        $templateParams["registrationError"][] = "Error! Name can't contain numer or special character!";
    }
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $templateParams["registrationError"][] = "Error! Invalid email format!";
    }
    if($dbh->checkUsername($username)) {
        $templateParams["registrationError"][] = "Error! Username already in use!";
    }
    if($dbh->checkEmail($email)) {
        $templateParams["registrationError"][] = "Error! Email already in use!";
    }
    if(false){
        $registration_result = $dbh->createAccount($username, $fullname, $email, $password);
        if(!$registration_result){
            $templateParams["registrationError"] = "Error while creating the accoutn!";
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

$templateParams["title"] = "Registration";
$templateParams["active"] = "signup-form.php";

require("template/base.php");
?>