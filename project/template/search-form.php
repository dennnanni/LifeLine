<?php require("header.php"); ?>
<div class="d-flex vh-100 flex-column">
    <div name="lifeline">
        <?php foreach($templateParams["friends"] as $friend): ?>
            <section class="d-inline-block">
                <div class="ms-0 d-inline-block">
                    <i class="fa-regular fa-user"></i>
                </div>
                <span class="d-inline-block"><?php echo $friend["username"]?></span>
                <span class="d-inline-block"><?php echo $friend["name"]?></span>
            </section>
        <?php endforeach?>
    </div>
    
</div>
<?php require("footer.php"); ?> 