<?php
require("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

$templateParams["title"] = "Stars";
$templateParams["active"] = "stars.php";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (empty($_GET["id"])) {
        header("Location: 404.php");
        exit();
    }
    else {
        $templateParams["post"] = $dbh->getPost($_GET["id"]);
        $templateParams["stars"] = $dbh->getStars($_GET["id"]);
        $templateParams["starCounter"] = count($templateParams["stars"]);
    }
}

require("template/base.php");
?>