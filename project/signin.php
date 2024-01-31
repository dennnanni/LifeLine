<?php
require_once("bootstrap.php");

if(isUserLoggedIn()){
    header("Location: home.php");
    exit();
}

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Login";
$templateParams["active"] = "signin-form.php";
$templateParams["js"] = "signin.js";

require("template/base.php");
?>