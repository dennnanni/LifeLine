<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Comments";
$templateParams["active"] = "comments.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

$templateParams["comments"] = array();

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["id"])) {
        header("Location: 404.php");
        exit();
    }
    else {
        $templateParams["post"] = $dbh->getPost($_GET["id"]);
        $templateParams["comments"] = $dbh->getComments($_GET["id"]);
    }
}



require("template/base.php");
?>