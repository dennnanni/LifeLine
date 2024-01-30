<?php
require_once("bootstrap.php");
include("auth_session.php");

$_SESSION["previous"] = $_SESSION["current"];
$_SESSION["current"] = basename($_SERVER["REQUEST_URI"]);
$templateParams["title"] = "Post";
$templateParams["active"] = "post.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout
$templateParams["backPage"] = $_SESSION["previous"]; // null | file.php  -> the page to address when back or done is pressed

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

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