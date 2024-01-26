<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $_SESSION[$_POST["field"]] = $_POST["value"];
}

?>