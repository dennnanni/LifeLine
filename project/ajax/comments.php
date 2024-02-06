<?php
require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["comment"]) && isset($_POST["postId"])) {
    $dbh->createComment($_SESSION["username"], $_POST["postId"], $_POST["comment"]);
    $response["user"] = $dbh->getUser($_SESSION["username"]);
    $response["commentsCount"] = $dbh->getPost($_POST["postId"])["commentsCount"];
    $response["commentId"] = $dbh->getLastCommentInPost($_POST["postId"])["id"];
    echo json_encode($response);
}

?>