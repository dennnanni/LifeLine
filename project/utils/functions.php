<?php

function updateHistory($pageName) {
    if(!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION["history"])) {
        $_SESSION["history"] = array();
    }

    if(end($_SESSION["history"]) != $pageName) {
        array_push($_SESSION["history"], $pageName);
    }
}

function getPreviousPage() {
    if(!isset($_SESSION)) {
        session_start();
    }

    if(!isset($_SESSION["history"])) {
        $_SESSION["history"] = array();
    }

    end($_SESSION["history"]);
    return prev($_SESSION["history"]);
}

function clearPostData() {
    $_SESSION["title"] = "";
    $_SESSION["description"] = "";
    $_SESSION["location"] = "";
    $_SESSION["category"] = "";
    $_SESSION["taggedUsers"] = array();
}

function composeMessage($type, $sender, $post) {
    $message = "";
    switch($type) {
        case 1:
            $message = "<a href=\"diary.php?username=".$sender."\" class=\"fw-bold\">@".$sender."</a> starred your memory \"<a href=\"post.php?id=".$post["id"]."\" class=\"fw-bold text-dark\">".$post["title"]."</a>\"";
            break;
        case 2:
            $message = "<a href=\"diary.php?username=$sender\" class=\"fw-bold\">@".$sender."</a> commented on your memory \"<a href=\"comments.php?id=".$post["id"]."\" class=\"fw-bold text-dark\">".$post["title"]."</a>\"";
            break;
        case 3:
            $message = "<a href=\"diary.php?username=$sender\" class=\"fw-bold\">@".$sender."</a> sent you a friend request";
            break;
        case 4:
            $message = "<a href=\"diary.php?username=$sender\" class=\"fw-bold\">@".$sender."</a> tagged you in a memory \"<a href=\"post.php?id=".$post["id"]."\" class=\"fw-bold text-dark\">".$post["title"]."</a>\"";
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

    $_SESSION["selectedCategories"] = array();
    
    clearPostData();
}

function validate($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function indexAvailable($path) {
    $acceptedExtensions = array("jpg", "jpeg", "png", "gif");
    foreach($acceptedExtensions as $ext) {
        if(file_exists($path.".".$ext)) {
            return false;
        }
    }
    return true;
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
        while(!indexAvailable($path.$newName));

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

function getCategoryIconClass($category) {
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

function getNotificationIconClass($type) {
    switch ($type) {
        case 1:
            return "fa-star";
        case 2:
            return "fa-comment";
        case 3:
            return "fa-user";
        case 4:
            return "fa-tag";
        default: 
            return "";
    }
}

function groupPostsByDay($posts) {
    $groupedPosts = array();

    foreach ($posts as $post) {
        $dateWithoutTime = convertiData(date("d/m/Y", strtotime($post['timestamp'])));

        if (!isset($groupedPosts[$dateWithoutTime])) {
            $groupedPosts[$dateWithoutTime] = array();
        }
        $groupedPosts[$dateWithoutTime][] = $post;
    }

    return $groupedPosts;
}

function convertiData($data) {
    $dataObj = DateTime::createFromFormat('d/m/Y', $data);

    if ($dataObj === false) {
        return $data;//Restituisci la data originale in caso di errore formato
    }

    $numeroGiorno = $dataObj->format('j');
    $nomeMese = $dataObj->format('F');

    return $numeroGiorno . ' ' . $nomeMese;
}

?>