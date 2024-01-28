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

$_SESSION["current"] = "photo";
$templateParams["title"] = "Photo";
$templateParams["active"] = "photo.php";
$templateParams["js"] = "photo.js";

//Header setting
$templateParams["headerLeftIcon"] = "back"; // null | notifications | back | logout
$templateParams["backPage"] = "diary.php"; // null | notifications | back | logout

//Footer setting
$templateParams["footerActive"] = "diary"; // home | create | diary

require("template/base.php");
?>