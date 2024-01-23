<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"])){
    
    if(!$dbh->checkEmail($_POST["email"])) {
        $templateParams["registrationError"] = "Errore! Esiste già un account con questa mail!";
    }

    if(!$dbh->checkUsername($_POST["username"])) {
        $templateParams["registrationError"] = "Errore! Esiste già un account con questo username!";
    }

    $registration_result = $dbh->createAccount($_POST["username"], $_POST["fullname"], $_POST["email"], $_POST["password"]);
    if(!$registration_result){
        $templateParams["registrationError"] = "Errore! Non è stato possibile creare l'account!"; //Login fallito
    }
    else{
        registerUserSession($_POST["username"], $_POST["fullname"]);
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