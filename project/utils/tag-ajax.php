<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["action"] == "ADD") {
        $_SESSION["taggedUsers"][] = $_POST["username"]; //add user from tagged users
    }
    elseif($_POST["action"] == "REMOVE") {
        $_SESSION["taggedUsers"] = array_diff($_SESSION["taggedUsers"], [$_POST["username"]]);//remove user from tagged users
    }   
}

?>