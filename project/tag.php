<?php
require("bootstrap.php");
include("auth_session.php");

$_SESSION["previous"] = $_SESSION["current"];
$_SESSION["current"] = basename($_SERVER["REQUEST_URI"]);
$templateParams["title"] = "Tag friends";
$templateParams["active"] = "tag.php";
$templateParams["js"] = "tag.js";

//Header settings
$templateParams["headerRightIcon"] = "done"; // null | notifications | back | done | logout
$templateParams["backPage"] = "create.php"; // null | file.php  -> the page to address when back or done is pressed

//Footer setting
$templateParams["footerActive"] = "create"; // home | create | diary

$templateParams["friends"] = $dbh->getFriends($_SESSION["username"]);

require("template/base.php");
?>