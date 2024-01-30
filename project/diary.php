<?php
require_once("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "diary";
$templateParams["title"] = "Diary";
$templateParams["active"] = "diary.php";
$templateParams["js"] = "diary.js";

//Header settings
$templateParams["headerLeftIcon"] = "logout"; // null | notifications | back | done | logout
$templateParams["headerRightIcon"] = "photo"; // null | search | photo

$requestedUser = isset($_GET["username"]) ? $_GET["username"] : $_SESSION["username"];

if ($requestedUser == $_SESSION["username"]) {
    $templateParams["personal"] = true;
    $templateParams["posts"] = $dbh->getDiary($requestedUser);

    //Footer setting
    $templateParams["footerActive"] = "diary"; // home | create | diary
} else {
    $templateParams["friendship"] = $dbh->getFriendshipStatus($requestedUser, $_SESSION["username"]);
    if (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 1) { 
        $templateParams["posts"] = $dbh->getFriendDiary($_SESSION["username"], $requestedUser);

        //Footer setting
        $templateParams["footerActive"] = "home"; // home | create | diary
    }
}

$templateParams["username"] = $dbh->getUser($requestedUser);

require("template/base.php");
?>