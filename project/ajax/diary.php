<?php 

require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if ($_POST["action"] == "ADD") {
        $dbh->acceptRequest($_POST["username"], $_SESSION["username"]);
    } else if ($_POST["action"] == "SEND") {
        $dbh->sendFriendship($_SESSION["username"], $_POST["username"]);
    } else if ($_POST["action"] == "REMOVE") {
        $dbh->removeFriend($_SESSION["username"], $_POST["username"]);
    } else if ($_POST["action"] == "CANCEL") {
        $dbh->removeRequest($_SESSION["username"], $_POST["username"]);
    }
}

?>