<?php
require("bootstrap.php");
include("auth_session.php");

$templateParams["title"] = "Search";
$templateParams["active"] = "search-form.php";
$templateParams["js"] = "search.js";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back
$templateParams["backPage"] = "home.php"; // null | file.php  -> the page to address when back is pressed
$templateParams["headerRightIcon"] = null; // null | search | settings

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

$templateParams["friends"] = $dbh->getFriends($_SESSION["username"]);

require("template/base.php");
?>