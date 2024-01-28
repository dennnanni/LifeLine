<?php
require("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "friends";
$templateParams["title"] = "Friends";
$templateParams["active"] = "friends.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | logout

//Footer setting
$templateParams["footerActive"] = "create"; // home | create | diary

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["username"])) {
        $templateParams["user"] = $dbh->getUser($_SESSION["username"]);
    }
    else {
        $templateParams["user"] = $dbh->getUser($_GET["username"]);
    }
    $templateParams["friends"] = $dbh->getFriends($templateParams["user"]["username"]);
    $templateParams["backPage"] = "diary.php?username=".$templateParams["user"]["username"];
}

require("template/base.php");
?>