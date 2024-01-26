<?php
require("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "notifications";
$templateParams["title"] = "Notifications";
$templateParams["active"] = "notifications.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | logout
$templateParams["backPage"] = "home.php"; // null | file.php  -> the page to address when back is pressed
$templateParams["headerRightIcon"] = null; // null | search | settings

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

$templateParams["notifications"] = $dbh->getNotifications($_SESSION["username"]);

require("template/base.php");
?>