<?php
require_once("bootstrap.php");


if(isUserLoggedIn()){
    header("Location: home.php");
    exit();
}

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Registration";
$templateParams["active"] = "signup-form.php";
$templateParams["js"] = "signup.js";

require("template/base.php");
?>