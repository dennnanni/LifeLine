<?php require("header.php"); ?>
<p>post: <?php echo implode(" ", $templateParams["post"])?></p>
<p>author: <?php echo implode(" ", $templateParams["author"])?></p>

<a href="comments.php?id=<?php echo $templateParams["post"]["id"]?>">Commenti</a>
<?php require("footer.php"); ?>