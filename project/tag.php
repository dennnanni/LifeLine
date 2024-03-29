<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Tag friends";
$templateParams["active"] = "tag.php";
$templateParams["js"] = "tag.js";

//Header settings
$templateParams["headerRightIcon"] = "done";

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

$templateParams["friends"] = $dbh->getFriends($_SESSION["username"]);

require("template/base.php");
?>