<?php
require_once("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

clearPostData();
$templateParams["title"] = "Homepage";
$templateParams["active"] = "home.php";
$templateParams["js"] = "home.js";

//Header settings
$templateParams["headerLeftIcon"] = "notifications"; // null | notifications | back | done | logout
$templateParams["headerRightIcon"] = "search"; // null | search | photo
$templateParams["notificationsNumber"] = $dbh->getNewNotificationNumber($_SESSION["username"]); // null | integer

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

$templateParams["categories"] = $dbh->getAllCategories();
$templateParams["selectedCategories"] = $_SESSION["selectedCategories"];

require("template/base.php");
?>