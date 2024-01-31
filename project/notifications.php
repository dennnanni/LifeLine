<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Notifications";
$templateParams["active"] = "notifications.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

$templateParams["notifications"] = array();

foreach($dbh->getNotifications($_SESSION["username"]) as $notification) {
    $post = $notification["type"] == 3 ? null : $dbh->getPost($notification["postId"]);
    $templateParams["notifications"][] = array(
        "type" => $notification["type"],
        "text" => composeMessage($notification["type"], $notification["sender"], !is_null($post) ? $post : null),
        "id" => $notification["type"] == "FOLLOW" ? $notification["sender"] : $notification["postId"]
    );
}

$dbh->readAllNotifications($_SESSION["username"]);

require("template/base.php");
?>