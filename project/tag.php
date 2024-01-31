<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Tag friends";
$templateParams["active"] = "tag.php";
$templateParams["js"] = "tag.js";

//Header settings
$templateParams["headerRightIcon"] = "done"; // null | notifications | back | done | logout

//Footer setting
$templateParams["footerActive"] = "create"; // home | create | diary

$templateParams["friends"] = $dbh->getFriends($_SESSION["username"]);

require("template/base.php");
?>