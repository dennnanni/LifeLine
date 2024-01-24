<?php
require_once("bootstrap.php");
include("auth_session.php");

$templateParams["title"] = "Homepage";
$templateParams["active"] = "home.php";
$templateParams["footerActive"] = "home"; //home, create or diary
$templateParams["posts"] = $dbh->loadHomePage($_SESSION["username"]);

require("template/base.php");
?>