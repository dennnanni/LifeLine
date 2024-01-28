<?php require("header.php"); ?>
<div class="d-flex justify-content-center">
    <div class="vh-100 col-11 position-relative">
        <div class="ms-5 ms-md-6 ms-xl-6 pt-3 min-vh-100 position-absolute" name="lifeline">
        </div>
<<<<<<< HEAD
    </div>
    <div class="flex-grow-1 text-nowrap w-100 pt-3">
        <div class="me-40 d-inline-block text-wrap">
            <h6 class="form-label ms-3 text-dark bg-light">Tag a friend in your memory</h6>
        </div>
        <?php foreach($templateParams["friends"] as $friend):?>
            <section class="w-100 ms-n40 ms-md-n3 mt-2 d-flex align-items-center justify-content-between">
                <div class="d-flex justify-content-center align-items-center">
                    <img name="search-propic" src="upload/<?php echo $friend["profilePic"]?>"/>
                    <span class="d-inline-block text-dark"><?php echo $friend["username"]?></span>
=======
        <div class="w-100 pt-3 position-relative justify-content-center">
            <div class="ms-31">
                <div class="ms-4">
                    <div class="ms-n1 bg-secondary rounded-3 d-flex justify-content-center" name="icon-medium">
                        <i class="fa-solid fa-tags h5 mt-1"></i>
                    </div>
                    <div class=" d-inline-block">
                        <h6 class="form-label ms-40 text-dark bg-light">Tag a friend in your memory</h6>
                    </div>
>>>>>>> 19a38b4b7f1296c83e3a19e3331d2ed661a427ca
                </div>
                <div class="ms-2">
                <?php foreach($templateParams["friends"] as $friend):?>
                    <section class="w-100 mt-2 d-flex align-items-center justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <img name="propic-medium" src="upload/<?php echo $friend["profilePic"]?>"/>
                            <span class="d-inline-block text-dark ms-1"><?php echo $friend["name"]?> (@<?php echo $friend["username"]?>)</span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <?php if(!in_array($friend["username"], $_SESSION["taggedUsers"])): ?>
                                <i class="bi bi-check-circle-fill h3 text-tertiary mt-2"></i>
                            <?php else: ?>
                                <i class="bi bi-check-circle-fill h3 text-secondary mt-2"></i>
                            <?php endif; ?>
                        </div>
                    </section>
                <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>