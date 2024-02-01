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
    //Header settings
    $templateParams["headerLeftIcon"] = "logout"; // null | notifications | back | done | logout
    $templateParams["headerRightIcon"] = "photo"; // null | search | photo



    $templateParams["personal"] = true;
    $templateParams["posts"] = $dbh->getDiary($requestedUser);
} else {
    //Header settings
    $templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout

    $templateParams["friendship"] = $dbh->getFriendshipStatus($requestedUser, $_SESSION["username"]);
    if (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 1) { 
        $templateParams["posts"] = $dbh->getFriendDiary($_SESSION["username"], $requestedUser);
    }

    $templateParams["personal"] = false;
}

$templateParams["username"] = $dbh->getUser($requestedUser);

require("template/base.php");
?>