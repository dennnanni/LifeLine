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

$templateParams["username"] = isset($_GET["user"]) ? $_GET["user"] : $_SESSION["username"];

if ($templateParams["username"] == $_SESSION["username"]) {
    $templateParams["personal"] = true;
    $templateParams["posts"] = $dbh->getDiary($templateParams["username"]);
} else if ($templateParams["friendshipStatus"] = $dbh->areFriends($_GET["user"], $_SESSION["username"])) {
    $templateParams["posts"] = $dbh->getDiary($templateParams["username"]);
}


require("template/base.php");
?>