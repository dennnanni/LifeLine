<?php 

require("../bootstrap.php");

if($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_POST["username"])) {
        $dbh->deleteComment($_POST["postId"], $_POST["username"], $_POST["timestamp"]);
    } else {
        $dbh->deletePost($_POST["postId"]);
    }
}

?>