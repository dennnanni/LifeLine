<?php
require_once("bootstrap.php");
include("auth_session.php");

$_SESSION["previous"] = $_SESSION["current"];
$_SESSION["current"] = basename($_SERVER["REQUEST_URI"]);

$templateParams["title"] = "Diary";
$templateParams["active"] = "diary.php";
$templateParams["js"] = "diary.js";

$requestedUser = isset($_GET["username"]) ? $_GET["username"] : $_SESSION["username"];

if ($requestedUser == $_SESSION["username"]) {
    //Header settings
    $templateParams["headerLeftIcon"] = "logout"; // null | notifications | back | done | logout
    $templateParams["headerRightIcon"] = "photo"; // null | search | photo

    //Footer setting
    $templateParams["footerActive"] = "diary"; // home | create | diary

    $templateParams["personal"] = true;
    $templateParams["posts"] = $dbh->getDiary($requestedUser);
} else {
    //Header settings
    $templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout
    $templateParams["backPage"] = "friends.php";

    //Footer setting
    $templateParams["footerActive"] = $_SESSION["previous"] == "friends.php" ? "diary" : "home"; // home | create | diary

    $templateParams["friendship"] = $dbh->getFriendshipStatus($requestedUser, $_SESSION["username"]);
    if (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 1) { 
        $templateParams["posts"] = $dbh->getFriendDiary($_SESSION["username"], $requestedUser);
    }
}

$templateParams["username"] = $dbh->getUser($requestedUser);

require("template/base.php");
?>