<?php
require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["action"] == "ADD") {
        $_SESSION["selectedCategories"][] = $_POST["category"]; //add user from tagged users
    }
    elseif($_POST["action"] == "REMOVE") {
        $_SESSION["selectedCategories"] = array_diff($_SESSION["selectedCategories"], [$_POST["category"]]);//remove user from tagged users
    }

    $queryResult = $dbh->loadHomePage($_SESSION["username"], $_SESSION["selectedCategories"]);
    echo json_encode($queryResult);
}

?>