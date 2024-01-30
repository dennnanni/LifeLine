<?php require("header.php"); ?>
<div class="row w-100 ms-0 mt-2 px-2">
    <?php foreach($templateParams["categories"] as $category): ?>
        <div class="col-3 px-1 mb-2">
            <button id="<?php echo $category["name"]?>" class="filter border border-2 border-tertiary rounded-4 w-100 text-center <?php echo in_array($category["name"], $templateParams["selectedCategories"]) ? 'bg-primary text-light' : 'bg-light text-dark' ?>" type="button">
                <?php echo $category["name"] ?>
            </button>
        </div>
    <?php endforeach; ?>
</div>
<div id="posts" class="mb-7">
</div>
<?php require("footer.php"); ?>