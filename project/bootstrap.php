<?php

require_once("db/database.php");
$dbh = new DatabaseHelper("localhost", "root", "", "lifeline", 3306);
define("UPLOAD_DIR", "./upload/")
# NOTA: creare la cartella upload
?>