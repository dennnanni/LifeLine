<?php
require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if(isset($_FILES["image"])) {
        $nomeFile = $_FILES["image"]["name"];
        if (!empty($nomeFile)) {
            list($result, $nuovoNomeFile) = uploadImage("../".UPLOAD_DIR, $_FILES["image"]);
            $_SESSION["imageName"] = $nuovoNomeFile;
        }
    }
    else {
        $_SESSION[$_POST["field"]] = $_POST["value"];
    }
}

?>