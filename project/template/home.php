<?php require("header.php"); ?>
<div class="container">
    <div class="row row-cols-4">
        <input id="currentUser" type="hidden" value="<?php echo $templateParams["currentUser"] ?>"/>
        <?php foreach($templateParams["categories"] as $category): ?>
            <div class="col pt-1 px-1 px-md-4">
                <button id="<?php echo $category["name"]?>" class="filter border border-2 border-tertiary rounded-4 w-100 text-center p-0 <?php echo in_array($category["name"], $templateParams["selectedCategories"]) ? 'bg-primary text-light' : 'bg-light text-dark' ?>" type="button">
                    <?php echo $category["name"] ?>
                </button>
            </div>
        <?php endforeach; ?>
    </div>
</div>
<div id="posts" class="container mt-5 mb-9 px-2 ps-sm-0">
</div>

<?php require("footer.php"); ?>