<?php require("header.php"); ?>
<?php foreach($templateParams["friends"] as $friend): ?>
    <p><?php echo $friend["username"]?></p>
    <p><?php echo $friend["name"]?></p>
<?php endforeach?>
<?php require("footer.php"); ?>