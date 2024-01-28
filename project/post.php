<?php
require_once("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "post";
$templateParams["title"] = "Post";
$templateParams["active"] = "post.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | logout
$templateParams["backPage"] = "home.php"; // null | file.php  -> the page to address when back is pressed

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["postId"])) {
        header("Location: 404.php");
        exit();
    }
    else {
        $templateParams["post"] = $dbh->getPost($_GET["postId"]);
        $templateParams["author"] = $dbh->getUser($templateParams["post"]["author"]);
    }
}

require("template/base.php");
?>