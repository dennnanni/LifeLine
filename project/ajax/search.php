<?php

require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $data = json_decode(file_get_contents("php://input"), true);
    $queryResult = $dbh->searchUsers($_SESSION["username"],$data);
    echo json_encode($queryResult);
}

?>