<?php
require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "GET") {
    if($_GET["action"] == "getBackPageUrl") {
        array_pop($_SESSION["history"]);
        echo json_encode(end($_SESSION["history"]));
    }
}

?>