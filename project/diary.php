<?php
require_once("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

clearPostData();
$templateParams["title"] = "Diary";
$templateParams["active"] = "diary.php";
$templateParams["js"] = "diary.js";

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

$requestedUser = isset($_GET["username"]) ? $_GET["username"] : $_SESSION["username"];

if ($requestedUser == $_SESSION["username"]) {
    if($_SESSION["footerActivePage"] == "home") {
        $templateParams["headerLeftIcon"] = "back";
    }
    else {
        $templateParams["headerLeftIcon"] = "logout";
        $templateParams["headerRightIcon"] = "photo";
    }

    $templateParams["personal"] = true;
    $templateParams["posts"] = $dbh->getDiary($requestedUser);
} else {
    
    //Header settings
    $templateParams["headerLeftIcon"] = "back";

    $templateParams["friendship"] = $dbh->getFriendshipStatus($requestedUser, $_SESSION["username"]);
    if (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 1) { 
        $templateParams["posts"] = $dbh->getFriendDiary($_SESSION["username"], $requestedUser);
    }

    $templateParams["personal"] = false;
}

$templateParams["username"] = $dbh->getUser($requestedUser);

require("template/base.php");
?>