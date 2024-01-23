<?php
require_once("bootstrap.php");

if(isset($_POST["email"]) && isset($_POST["password"])){
    $login_result = $dbh->login($_POST["email"], $_POST["password"]);
    if(count($login_result)==0){
        $templateParams["loginError"] = "Errore! Username o password errati!"; //Login fallito
    }
    else{
        registerLoggedUser($login_result[0]);
    }
}

if(isUserLoggedIn()){
    header("Location: home.php");
    exit();
}

$templateParams["title"] = "Login";
$templateParams["active"] = "signin-form.php";

require("template/base.php");
?>