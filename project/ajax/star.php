<?php

require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["action"] == "ADD") {
        $dbh->addStar($_POST["username"], $_POST["postId"]);
    } else if ($_POST["action"] == "REMOVE") {
        $dbh->removeStar($_POST["username"], $_POST["postId"]);
    }
    
    $starsCount = $dbh->getPost($_POST["postId"])["starsCount"];
    echo json_encode(["starsCount" => $starsCount]);
}

?>