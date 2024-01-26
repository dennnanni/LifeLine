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
function registerUserSession($username, $name){
    $_SESSION["username"] = $username;
    $_SESSION["name"] = $name;
    $_SESSION["taggedUsers"] = array();
}

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function uploadImage($path, $image){
    $imageName = basename($image["name"]);
    $imageFileType = strtolower(pathinfo($path.$imageName,PATHINFO_EXTENSION));
    $imageSize = getimagesize($image["tmp_name"]);

    $maxKB = 5000; //Originale 500
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    $result = 0;
    $msg = "";
    
    if($imageSize === false) {
        $msg .= "File caricato non è un'immagine! ";
    }
    else if ($image["size"] > $maxKB * 1024) {
        $msg .= "File caricato pesa troppo! Dimensione massima è $maxKB KB. ";
    }
    else if(!in_array($imageFileType, $acceptedExtensions)){
        $msg .= "Accettate solo le seguenti estensioni: ".implode(",", $acceptedExtensions);
    }   
    else {
        $newName = 0;
        do{
            $newName++;
            $newPath = $path.$newName.".".$imageFileType;
        }
        while(file_exists($newPath));

        if(!move_uploaded_file($image["tmp_name"], $newPath)){
            $msg.= "Errore nel caricamento dell'immagine.";
        }
        else{
            $result = 1;
            $msg = $newName.".".$imageFileType;
        }
    }
    return array($result, $msg);
}

?>