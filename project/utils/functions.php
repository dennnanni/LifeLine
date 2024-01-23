<?php

/**
 * Return the active class for the active page on the header.
 */
function isActive($pagename){
    if(basename($_SERVER['PHP_SELF'])==$pagename){
        echo " class='active' ";
    }
}

/**
 * Return if the user is logged in the session.
 */
function isUserLoggedIn(){
    return !empty($_SESSION['username']);
}

/**
 * Log the user data in the session parameters.
 */
function registerUserSession($user){
    $_SESSION["username"] = $user["username"];
    $_SESSION["name"] = $user["name"];
}

?>