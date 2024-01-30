<?php
require_once("bootstrap.php");
include("auth_session.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = validate($_POST["title"]);
    $description = validate($_POST["description"]);
    $location = validate($_POST["location"]);
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
            $registration_result = $dbh->createPost($_SESSION["username"], $title, $description, $location, $category, $_SESSION["taggedUsers"], $nuovoNomeFile);
        }
        else {
            $registration_result = $dbh->createPost($_SESSION["username"], $title, $description, $location, $category, $_SESSION["taggedUsers"]);
        }
    }
}

$_SESSION["previous"] = $_SESSION["current"];
$_SESSION["current"] = basename($_SERVER["REQUEST_URI"]);

if($_SESSION["previous"] != "tag.php") {
    //Clear the post data if the user exited from the creation process
    $_SESSION["title"] = "";
    $_SESSION["description"] = "";
    $_SESSION["location"] = "";
    $_SESSION["category"] = "";
    $_SESSION["taggedUsers"] = array();
}

$templateParams["title"] = "Create";
$templateParams["active"] = "create-form.php";
$templateParams["js"] = "create.js";

//Footer setting
$templateParams["footerActive"] = "create"; // home | create | diary

$templateParams["categories"] = $dbh->getAllCategories();
$templateParams["tag-number"] = count($_SESSION["taggedUsers"]);

require("template/base.php");
?>