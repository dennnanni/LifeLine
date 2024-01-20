<?php
require_once("bootstrap.php");

// if(isset($_POST["username"]) && isset($_POST["password"])){
//     $login_result = $dbh->checkLogin($_POST["username"], $_POST["password"]);

//     if(count($login_result)==0){
//         //Login fallito
//         $templateParams["errorelogin"] = "Errore! Verificare username e/o password";
//         }
//     else {
//         registerLoggedUser($login_result[0]);
//     }
// }

$templateParams["title"] = "Blog TW - Admin";
$templateParams["active"] = "login-form.php";

require("template/base.php");

?>