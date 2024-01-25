<?php require("header.php"); ?>
<div class="d-flex">
    <div class="ms-5 ms-md-6 pt-3 vh-100" name="lifeline">
    </div>
    <div class="flex-grow-1 text-nowrap w-100 pt-3">
        <div class="input-group ms-n40">
            <div class="form-outline">
                <input type="search" id="form1" class="form-control rounded-0 rounded-start" placeholder="Search" />
                <label class="form-label" for="form1" hidden>Search</label>
            </div>
            <button type="button" class="btn btn-primary">
                <i class="fas fa-search"></i>
            </button>
        </div>
        <?php foreach($templateParams["friends"] as $friend): ?>
            <section class="w-100 ms-n40 ms-md-n3 mt-2">
                <img name="search-propic" src="<?php echo 'upload/'.$friend["profilePic"] ?>"/>
                <span class="d-inline-block"><?php echo $friend["username"]?></span>
                <span class="d-inline-block"><?php echo $friend["name"]?></span>
            </section>
        <?php endforeach?>
    </div>
</div>
<?php require("footer.php"); ?>