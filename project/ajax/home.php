<?php
require_once("../bootstrap.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if($_POST["action"] == "ADD") {
        $_SESSION["selectedCategories"][] = $_POST["category"]; //add user from tagged users
    }
    elseif($_POST["action"] == "REMOVE") {
        $_SESSION["selectedCategories"] = array_diff($_SESSION["selectedCategories"], [$_POST["category"]]);//remove user from tagged users
    }

    $queryResult = groupPostsByDay($dbh->loadHomePage($_SESSION["username"], $_SESSION["selectedCategories"]));

    foreach ($queryResult as $key => $value) {
        $posts[$key] = array();
        foreach ($value as $post) {
            $posts[$key][] = array(
                "id" => $post["id"],
                "author" => $post["author"],
                "title" => $post["title"],
                "description" => $post["description"],
                "image" => $post["image"],
                "location" => $post["location"],
                "category" => $post["category"],
                "starsCount" => $post["starsCount"],
                "commentsCount" => $post["commentsCount"],
                "tag" => $dbh->getPostTaggedUsers($post["id"]),
                "starred" => $dbh->isPostStarredByUser($post["id"], $_SESSION["username"]) 
            );
        }
    }

    echo json_encode(isset($posts) ? $posts : array());
}

?>