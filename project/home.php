<?php
require_once("bootstrap.php");
include("auth_session.php");

$templateParams["title"] = "Homepage";
$templateParams["active"] = "home.php";

//Header settings
$templateParams["headerLeftIcon"] = "notifications"; // notifications | back
$templateParams["headerRightIcon"] = "search"; // search | settings

//Footer setting
$templateParams["footerActive"] = "home"; //home | create | diary

$templateParams["posts"] = $dbh->loadHomePage($_SESSION["username"]);

require("template/base.php");
?>