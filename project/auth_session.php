<?php
    if(!isset($_SESSION)) 
    { 
        session_start(); 
    }
    
    if(!isset($_SESSION["username"])) {
        header("Location: enter.php");
        exit();
    }
?>