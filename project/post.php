<?php
require_once("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Post";
$templateParams["active"] = "post.php";

//Header settings
$templateParams["headerLeftIcon"] = "back";

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["id"])) {
        header("Location: 404.php");
        exit();
    }
    else {
        $templateParams["post"] = $dbh->getPost($_GET["id"]);
        $templateParams["author"] = $dbh->getUser($templateParams["post"]["author"]);
    }
}

require("template/base.php");
?>