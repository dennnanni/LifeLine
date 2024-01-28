<?php
require_once("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "home";
$templateParams["title"] = "Homepage";
$templateParams["active"] = "home.php";
$templateParams["js"] = "home.js";

//Header settings
$templateParams["headerLeftIcon"] = "notifications"; // null | notifications | back | logout
$templateParams["headerRightIcon"] = "search"; // null | search | photo
$templateParams["notificationsNumber"] = $dbh->getNewNotificationNumber($_SESSION["username"]); // null | integer

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

$templateParams["categories"] = $dbh->getAllCategories();
$templateParams["posts"] = $dbh->loadHomePage($_SESSION["username"]);

require("template/base.php");
?>