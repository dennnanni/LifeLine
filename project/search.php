<?php
require("db/database.php");
require_once("bootstrap.php");
include("auth_session.php");

$templateParams["title"] = "Search";
$templateParams["active"] = "search-form.php";
$templateParams["js"] = "search.js";

//Header settings
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back
$templateParams["backPage"] = "home.php"; // null | file.php  -> the page to address when back is pressed
$templateParams["headerRightIcon"] = null; // null | search | settings

//Footer setting
$templateParams["footerActive"] = "home"; // home | create | diary

$templateParams["friends"] = $dbh->getFriends($_SESSION["username"]);

function search($text) {
    global $dbh;
    $queryResult = $dbh->searchUsers($text);
    echo json_encode($queryResult);
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    search($data);
}

require("template/base.php");
?>