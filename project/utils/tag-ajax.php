<?php
session_start();

if (!isset($_SESSION['taggedUsers'])) {
    $_SESSION['taggedUsers'] = array();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION["taggedUsers"][] = $_POST["username"]; //add user from tagged users
}
elseif($_SERVER["REQUEST_METHOD"] === "DELETE") {
    $_SESSION["taggedUsers"] = array_diff($_SESSION["taggedUsers"], [$_SERVER["username"]]);//remove user from tagged users
}

?>