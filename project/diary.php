<?php
require_once("bootstrap.php");
include("auth_session.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($_POST["friendshipStatus"] == 1 || $_POST["friendshipStatus"] == 0) {
        $dbh->removeFriendOrRequest($_SESSION["username"], $_GET["user"]);
    } else {
        $dbh->sendFriendship($_SESSION["username"], $_GET["user"]);
    }
}

$_SESSION["current"] = "diary";
$templateParams["title"] = "Diary";
$templateParams["active"] = "diary.php";
$templateParams["js"] = "diary.js";

//Header settings
$templateParams["headerLeftIcon"] = "logout"; // null | notifications | back | logout
$templateParams["headerRightIcon"] = "photo"; // null | search | photo

$requestedUser = isset($_GET["user"]) ? $_GET["user"] : $_SESSION["username"];

if ($requestedUser == $_SESSION["username"]) {
    $templateParams["personal"] = true;
    $templateParams["posts"] = $dbh->getDiary($requestedUser);
    $templateParams["friendshipStatus"] = 1;

    //Footer setting
    $templateParams["footerActive"] = "diary"; // home | create | diary
} else {
    $templateParams["friendshipStatus"] = $dbh->getFriendshipStatus($requestedUser, $_SESSION["username"]);
    if ($templateParams["friendshipStatus"] == 1) { 
        $templateParams["posts"] = $dbh->getDiary($requestedUser);

        //Footer setting
        $templateParams["footerActive"] = "home"; // home | create | diary
    }
}

$templateParams["user"] = $dbh->getUser($requestedUser);

require("template/base.php");
?>