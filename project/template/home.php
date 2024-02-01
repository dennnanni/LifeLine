<?php require("header.php"); ?>
<div class="container">
    <div class="row row-cols-4">
        <?php foreach($templateParams["categories"] as $category): ?>
            <div class="col pt-1">
                <button id="<?php echo $category["name"]?>" class="filter border border-2 border-tertiary rounded-4 w-100 text-center p-0 <?php echo in_array($category["name"], $templateParams["selectedCategories"]) ? 'bg-primary text-light' : 'bg-light text-dark' ?>" type="button">
                    <?php echo $category["name"] ?>
                </button>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<!-- <div id="posts" class="mb-7">
</div> -->

<div class="container">
    <div class="row">
        <section class="border border-3 border-tertiary-light rounded-4">
            <div class="lifeline-small"></div>
        </section>
    </div>
</div>
<?php require("footer.php"); ?>