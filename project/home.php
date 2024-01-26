<?php
require_once("bootstrap.php");
include("auth_session.php");

$templateParams["title"] = "Homepage";
$templateParams["active"] = "home.php";

//Header settings
$templateParams["headerLeftIcon"] = "notifications"; // null | notifications | back | logout
$templateParams["backPage"] = null; // null | file.php  -> the page to address when back is pressed
$templateParams["headerRightIcon"] = "search"; // null | search | settings

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

$templateParams["posts"] = $dbh->loadHomePage($_SESSION["username"]);

require("template/base.php");
?>