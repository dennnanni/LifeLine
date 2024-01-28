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

$requestedUser = isset($_GET["user"]) ? $_GET["user"] : $_SESSION["username"];

if ($requestedUser == $_SESSION["username"]) {
    $templateParams["personal"] = true;
    $templateParams["posts"] = $dbh->getDiary($requestedUser);
    $templateParams["friendshipStatus"] = 1;
} else {
    $templateParams["friendshipStatus"] = $dbh->getFriendshipStatus($requestedUser, $_SESSION["username"]);
    if ($templateParams["friendshipStatus"] == 1) { 
        $templateParams["posts"] = $dbh->getDiary($requestedUser);
    }
}

$templateParams["user"] = $dbh->getUser($requestedUser);

require("template/base.php");
?>