<?php require("header.php"); ?>
<?php 

foreach($templateParams["posts"] as $post) {
    echo $post['title'];
}

?>
<?php require("footer.php"); ?>
