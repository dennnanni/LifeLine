<?php 

require("../bootstrap.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["commentId"])) {
        $dbh->deleteComment($_POST["commentId"], $_POST["postId"]);
    } else {
        $dbh->deletePost($_POST["postId"]);
    }
}

?>