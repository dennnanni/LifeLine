<?php


function composeMessage($type, $sender, $post) {
    $message = "";
    switch($type) {
        case 1:
            $message = "<strong>@".$sender."</strong> starred you memory \"".$post["title"]."\"";
            break;
        case 2:
            $message = "<strong>@".$sender."</strong> commented on your memory \"".$post["title"]."\"";
            break;
        case 3:
            $message = "<strong>@".$sender."</strong> sent you a friend request";
            break;
        case 4:
            $message = "<strong>@".$sender."</strong> tagged you in a memory \"".$post["title"]."\"";
            break;
    }
    return $message;
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
    $_SESSION["current"] = "";

    $_SESSION["title"] = "";
    $_SESSION["description"] = "";
    $_SESSION["location"] = "";
    $_SESSION["category"] = "";
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

function getIconClass($category) {
    switch ($category) {
        case "Love":
            return "fa-heart";
        case "Fun":
            return "fa-champagne-glasses";
        case "Music":
            return "fa-music";
        case "Art":
            return "fa-palette";
        case "Food":
            return "fa-burger";
        case "Fashion":
            return "fa-shirt";
        case "Sport":
            return "fa-football";
        case "Travel":
            return "fa-plane";
        default: 
            return "";
    }
}

function groupPostsByDay($posts) {
    $groupedPosts = array();

    foreach ($posts as $post) {
        $dateWithoutTime = date("d/m/Y", strtotime($post['timestamp']));

        if (!isset($groupedPosts[$dateWithoutTime])) {
            $groupedPosts[$dateWithoutTime] = array();
        }
        $groupedPosts[$dateWithoutTime][] = $post;
    }

    return $groupedPosts;
}

?>