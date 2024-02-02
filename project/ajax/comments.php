<?php
require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comment"]) && isset($_POST["postId"])) {
    $dbh->createComment($_SESSION["username"], $_POST["postId"], $_POST["comment"]);
    echo "success";
}

?>