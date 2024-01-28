<?php
require("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "friends";
$templateParams["title"] = "Friends";
$templateParams["active"] = "friends.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | logout
$templateParams["backPage"] = "diary.php";

//Footer setting
$templateParams["footerActive"] = "diary"; // home | create | diary

$templateParams["user"] = $dbh->getUser($_SESSION["username"]);
$templateParams["friends"] = $dbh->getFriends($templateParams["user"]["username"]);

require("template/base.php");
?>