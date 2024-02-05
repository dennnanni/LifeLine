<?php
require_once("bootstrap.php");
include("auth_session.php");

updateHistory(basename($_SERVER["REQUEST_URI"]));

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = validate($_POST["title"]);
    $description = validate($_POST["description"]) == "" ? null : validate($_POST["description"]);
    $location = validate($_POST["location"]) == "" ? null : validate($_POST["location"]);
    $category = validate($_POST["category"]);
    $nomeFile = validate($_FILES["immaginePost"]["name"]);
    
    if (empty($title)) {
        $templateParams["uploadError"] = "Error! You must insert a title for the post!";
    }
    else if ($category == "0") {
        $templateParams["uploadError"] = "Error! You must select a category for the post!";
    }
    else {
        if (!empty($nomeFile)) {
            list($result, $nuovoNomeFile) = uploadImage(UPLOAD_DIR, $_FILES["immaginePost"]);
            $_SESSION["imageName"] = $nuovoNomeFile;
            $registration_result = $dbh->createPost($_SESSION["username"], $title, $description, $location, $category, $_SESSION["taggedUsers"], $nuovoNomeFile);
        }
        else {
            $registration_result = $dbh->createPost($_SESSION["username"], $title, $description, $location, $category, $_SESSION["taggedUsers"]);
        }
        $_SESSION["footerActivePage"] = "diary";
        header("Location: diary.php");
    }
}

$templateParams["title"] = "Create";
$templateParams["active"] = "create-form.php";
$templateParams["js"] = "create.js";

$templateParams["imageName"] = $_SESSION["imageName"];
$templateParams["title"] = $_SESSION["title"];
$templateParams["description"] = $_SESSION["description"];
$templateParams["location"] = $_SESSION["location"];
$templateParams["category"] = $_SESSION["category"];

//Footer setting
$templateParams["footerActive"] = $_SESSION["footerActivePage"];

$templateParams["categories"] = $dbh->getAllCategories();
$templateParams["tag-number"] = count($_SESSION["taggedUsers"]);

require("template/base.php");
?>