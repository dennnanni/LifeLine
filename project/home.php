<?php
require_once("bootstrap.php");
include("auth_session.php");

$templateParams["title"] = "Homepage";
$templateParams["active"] = "home.php";

require("template/base.php");
?>