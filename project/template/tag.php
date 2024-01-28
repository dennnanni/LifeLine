<?php require("header.php"); ?>
<div class="d-flex justify-content-center">
    <div class="vh-100 col-11 position-relative">
        <div class="ms-5 ms-md-6 ms-xl-6 pt-3 min-vh-100 position-absolute" name="lifeline">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <div class="ms-31">
                <div class="ms-4">
                    <div class="ms-n1 bg-secondary rounded-3 d-flex justify-content-center" name="icon-medium">
                        <i class="fa-solid fa-tags h5 mt-1"></i>
                    </div>
                    <div class=" d-inline-block">
                        <h6 class="form-label ms-40 text-dark bg-light">Tag a friend in your memory</h6>
                    </div>
                </div>
                <div class="ms-2">
                <?php foreach($templateParams["friends"] as $friend):?>
                    <section class="w-100 mt-2 d-flex align-items-center justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <img name="propic-medium" src="upload/<?php echo $friend["profilePic"]?>"/>
                            <span id = "<?php echo $friend["username"]?>" class="d-inline-block text-dark ms-1"><?php echo $friend["name"]?> (@<?php echo $friend["username"]?>)</span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="bi bi-check-circle-fill h3 <?php echo (in_array($friend["username"], $_SESSION["taggedUsers"]) ? "text-secondary" : "text-tertiary") ?> mt-2"></i>
                        </div>
                    </section>
                <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>