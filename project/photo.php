<?php
require_once("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nomeFile = validate($_FILES["immaginePost"]["name"]);
    
    if (!empty($nomeFile)) {
        list($result, $nuovoNomeFile) = uploadImage(UPLOAD_DIR, $_FILES["immaginePost"]);
        $dbh->changeUserPhoto($_SESSION["username"], $nuovoNomeFile);
    }

    header("Location: diary.php");
}

$templateParams["title"] = "Photo";
$templateParams["active"] = "photo.php";
$templateParams["js"] = "photo.js";

//Footer setting
$templateParams["footerActive"] = "diary"; // home | create | diary

if(getPreviousPage() == "signup.php") {
    $templateParams["skip"] = true;
}
else {
    //Header setting
    $templateParams["headerLeftIcon"] = "back"; // null | notifications | back | done | logout
    
    $templateParams["skip"] = false;
}

require("template/base.php");
?>