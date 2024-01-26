<?php require("header.php"); ?>
<div class="d-flex">
    <div class="ms-5 ms-md-6 pt-3 vh-100" name="lifeline">
    </div>
    <div class="flex-grow-1 text-nowrap w-100 pt-3">
        <div class="ms-n40 me-40">
            <div class="form-outline">
                <h4 class="form-label text-dark bg-light border border-1 border-tertiary-light">Tag a friend in your memory</h4>
            </div>
        </div>
        <?php foreach($templateParams["friends"] as $friend):?>
            <section class="w-100 ms-n40 ms-md-n3 mt-2">
                <img name="search-propic" src="upload/<?php echo $friend["profilePic"]?>"/>
                <span class="d-inline-block text-dark"><?php echo $friend["username"]?></span>
                <?php if(!in_array($friend["username"], $_SESSION["taggedUsers"])): ?>
                    <i class="bi bi-check-circle-fill h3 text-tertiary"></i>
                <?php else: ?>
                    <i class="bi bi-check-circle-fill h3 text-secondary"></i>
                <?php endif; ?>
            </section>
        <?php endforeach;?>
    </div>
</div>
<?php require("footer.php"); ?>