<?php
require("bootstrap.php");
include("auth_session.php");

$_SESSION["current"] = "notifications";
$templateParams["title"] = "Notifications";
$templateParams["active"] = "notifications.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | logout
$templateParams["backPage"] = "home.php"; // null | file.php  -> the page to address when back is pressed

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

$templateParams["notifications"] = array();

foreach($dbh->getNotifications($_SESSION["username"]) as $notification) {
    $post = $notification["type"] == 3 ? null : $dbh->getPost($notification["postId"]);
    $templateParams["notifications"][] = array(
        "type" => $notification["type"],
        "text" => composeMessage($notification["type"], $notification["sender"], !is_null($post) ? $post[0] : null),
        "id" => $notification["type"] == "FOLLOW" ? $notification["sender"] : $notification["postId"]
    );
}

require("template/base.php");
?>