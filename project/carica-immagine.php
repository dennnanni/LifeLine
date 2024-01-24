<?php 
require_once("bootstrap.php");

// list($result, $msg) = uploadImage(UPLOAD_DIR, $_FILES["immaginePost"]);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = validate($_POST["title"]);
    $description = validate($_POST["description"]);
    $location = validate($_POST["location"]);
    $category = validate($_POST["category"]);
    
    if (empty($title)) {
        $templateParams["uploadError"] = "Error! You must insert a title for the post!";
    }
    else if ($category == "0") {
        $templateParams["uploadError"] = "Error! You must select a category for the post!";
    }
    else {
        // $registration_result = $dbh->createPost($_SESSION["username"], $title, $description, $location, $category, $image, $taggedUsernameList);
        // if(!$registration_result){
        //     $templateParams["uploadError"] = "Error while creating the accoutn!";
        // }
        // else{
        //     registerUserSession($username, $fullname);
        // }
    }
}

$templateParams["title"] = "Create";
$templateParams["active"] = "create-form.php";
$templateParams["js"] = "create.js";

$templateParams["categories"] = $dbh->getAllCategories();
$templateParams["tag-number"] = 0;

require("template/base.php");
?>