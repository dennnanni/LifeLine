<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Comments";
$templateParams["active"] = "comments.php";
$templateParams["js"] = "comments.js";

//Header settings
$templateParams["headerLeftIcon"] = "back";

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

$templateParams["comments"] = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["id"])) {
        header("Location: 404.php");
        exit();
    }
    else {
        $templateParams["currentUser"] = $_SESSION["username"];
        $templateParams["post"] = $dbh->getPost($_GET["id"]);
        $templateParams["comments"] = $dbh->getComments($_GET["id"]);
        foreach ($templateParams["comments"] as &$comment) {
            $comment["author"] = $dbh->getUser($comment["username"]);
        }
        unset($comment);
    }
}

require("template/base.php");
?>