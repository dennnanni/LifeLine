<?php
require_once("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "diary";
$templateParams["title"] = "Diary";
$templateParams["active"] = "diary.php";

//Header settings
$templateParams["headerLeftIcon"] = "logout"; // null | notifications | back | logout
$templateParams["headerRightIcon"] = "photo"; // null | search | photo

//Footer setting
$templateParams["footerActive"] = "diary"; // home | create | diary

require("template/base.php");
?>