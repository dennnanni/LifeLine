<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Search";
$templateParams["active"] = "search-form.php";
$templateParams["js"] = "search.js";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

require("template/base.php");
?>