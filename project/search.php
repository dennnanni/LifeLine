<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Search";
$templateParams["active"] = "search-form.php";
$templateParams["js"] = "search.js";

//Header settings
$templateParams["headerLeftIcon"] = "back";

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

require("template/base.php");
?>