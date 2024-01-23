<?php
require_once("bootstrap.php");

if(isset($_POST["email-registration"]) && isset($_POST["password-registration"])){
    
    if(!$dbh->checkEmail($_POST["email"])) {
        $templateParams["authenticationError"] = "Errore! Esiste già un account con questa mail!";
    }

    if(!$dbh->checkUsername($_POST["username"])) {
        $templateParams["authenticationError"] = "Errore! Esiste già un account con questo username!";
    }

    $login_result = $dbh->createAccount($_POST["username"], $_POST["fullname"], $_POST["email"], $_POST["password"]);
    if(!$login_result){
        $templateParams["registrationError"] = "Errore! Non è stato possibile creare l'account!"; //Login fallito
    }
    else{
        registerUserSession($login_result[0]);
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