<?php
require_once("bootstrap.php");
include("auth_session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeFile = validate($_FILES["immaginePost"]["name"]);
    
    if (!empty($nomeFile)) {
        list($result, $nuovoNomeFile) = uploadImage(UPLOAD_DIR, $_FILES["immaginePost"]);
        $dbh->changeUserPhoto($_SESSION["username"], $nuovoNomeFile);
    }

    header("Location: diary.php");
}

$_SESSION["previous"] = $_SESSION["current"];
$_SESSION["current"] = basename($_SERVER["REQUEST_URI"]);

$templateParams["title"] = $_SESSION["previous"];
$templateParams["active"] = "photo.php";
$templateParams["js"] = "photo.js";

if($_SESSION["previous"] == "signup.php") {
    $templateParams["headerRightIcon"] = "diary";
}
else {
    //Header setting
    $templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout
    $templateParams["backPage"] = "diary.php";
}

//Footer setting
$templateParams["footerActive"] = "diary"; // home | create | diary

require("template/base.php");
?>