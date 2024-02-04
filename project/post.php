<?php
require_once("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Post";
$templateParams["active"] = "post.php";

//Header settings
$templateParams["headerLeftIcon"] = "back";

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

$templateParams["js"] = "post.js";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["id"])) {
        header("Location: 404.php");
        exit();
    }
    else {
        $templateParams["currentUser"] = $_SESSION["username"];
        $templateParams["post"] = $dbh->getPost($_GET["id"]);
        $templateParams["post"]["tagged"] = $dbh->getPostTaggedUsers($_GET["id"]) ?? [];
        $templateParams["post"]["starred"] = $dbh->isPostStarredByUser($_GET["id"], $_SESSION["username"]);
        $templateParams["author"] = $dbh->getUser($templateParams["post"]["author"]);
        $templateParams["lastComment"] = $dbh->getLastCommentInPost($_GET["id"]);
        if (isset($templateParams["lastComment"])) {
            $templateParams["lastComment"]["profilePic"] = $dbh->getUser($templateParams["lastComment"]["username"])["profilePic"];
        }
    }
}

require("template/base.php");
?>