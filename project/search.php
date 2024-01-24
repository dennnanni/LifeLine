<?php
require_once("bootstrap.php");
include("auth_session.php");

$templateParams["title"] = "Search";
$templateParams["active"] = "search-form.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back
$templateParams["backPage"] = "home.php"; // null | file.php  -> the page to address when back is pressed
$templateParams["headerRightIcon"] = null; // null | search | settings

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

require("template/base.php");
?>