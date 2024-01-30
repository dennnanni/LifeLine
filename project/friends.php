<?php
require("bootstrap.php");
include("auth_session.php");

$_SESSION["previous"] = $_SESSION["current"];
$_SESSION["current"] = basename($_SERVER["REQUEST_URI"]);
$templateParams["title"] = "Friends";
$templateParams["active"] = "friends.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout
$templateParams["backPage"] = "diary.php";

//Footer setting
$templateParams["footerActive"] = "diary"; // home | create | diary

$templateParams["user"] = $dbh->getUser($_SESSION["username"]);
$templateParams["friends"] = $dbh->getFriends($templateParams["user"]["username"]);

require("template/base.php");
?>