<?php
require_once("bootstrap.php");

if(isset($_POST["username"]) && isset($_POST["password"])){
    $login_result = $dbh->login($_POST["username"], $_POST["password"]);
    if(count($login_result)==0){
        $templateParams["errorelogin"] = "Errore! Username o password errati!"; //Login fallito
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
$templateParams["active"] = "enter-form.php";
$templateParams["js"] = ['enter.js'];

require("template/base.php");
?>