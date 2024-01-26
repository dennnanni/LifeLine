<?php require("header.php"); ?>
<div class="d-flex">
    <div class="ms-5 ms-md-6 pt-3 vh-100" name="lifeline">
    </div>
    <div class="flex-grow-1 text-nowrap w-100 pt-3">
        <?php foreach($templateParams["notifications"] as $notification):?>
            <section class="w-100 ms-n40 ms-md-n3 mt-2">
                <img name="search-propic" src="upload/<?php echo $friend["profilePic"]?>"/>
                <span class="d-inline-block text-dark"><?php echo $friend["username"]?></span>
            </section>
        <?php endforeach;?>
    </div>
</div>
<?php require("footer.php"); ?>