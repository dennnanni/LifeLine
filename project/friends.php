<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Friends";
$templateParams["active"] = "friends.php";

//Header settings
$templateParams["headerLeftIcon"] = "back";

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"]; // home | create | diary

$requestedUser = isset($_GET["username"]) ? $_GET["username"] : $_SESSION["username"];
$templateParams["user"] = $dbh->getUser($requestedUser);
$templateParams["friends"] = $dbh->getFriends($templateParams["user"]["username"]);

require("template/base.php");
?>