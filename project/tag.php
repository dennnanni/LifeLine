<?php
require("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "tag";
$templateParams["title"] = "Tag friends";
$templateParams["active"] = "tag.php";
$templateParams["js"] = "tag.js";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | logout
$templateParams["backPage"] = "create.php"; // null | file.php  -> the page to address when back is pressed

//Footer setting
$templateParams["footerActive"] = "create"; // home | create | diary

$templateParams["friends"] = $dbh->getFriends($_SESSION["username"]);

require("template/base.php");
?>