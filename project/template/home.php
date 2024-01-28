<?php require("header.php"); ?>
<div class="row w-100 ms-0 mt-2 px-2">
    <?php foreach($templateParams["categories"] as $category): ?>
        <div class="col-3 px-1 mb-2">
            <button id="<?php echo $category["name"]?>" class="filter bg-light border border-2 border-tertiary rounded-4 text-dark w-100 text-center" type="button"><?php echo $category["name"] ?></button>
        </div>
    <?php endforeach; ?>
</div>
<?php require("footer.php"); ?>