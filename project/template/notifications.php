<?php require("header.php"); ?>
<div class="d-flex flex-grow-1 justify-content-center mb-7">
    <div class="col-11 col-md-6 position-relative">
        <div class="ms-7 pt-3 position-absolute h-100" id="lifeline">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <div class="ms-4">
                <div class="ms-3">
                    <div class="bg-secondary rounded-3 d-inline-flex justify-content-center icon-medium">
                        <i class="fa-solid fa-tags h5 mt-1"></i>
                    </div>
                    <h2 class="form-label ms-3 text-dark bg-light fs-5 d-inline-block">Your notifications</h2>
                </div>
                <?php foreach($templateParams["notifications"] as $notification):?>
                    <div class="d-flex align-items-center ms-4 my-3">
                        <div class="d-flex pe-3">
                            <div class="icon-medium d-flex justify-content-center align-items-center bg-secondary rounded-3">
                                <i class="fa-solid <?php echo getNotificationIconClass($notification["type"]); ?>"></i>
                            </div>
                        </div>
                        <section class="d-flex align-items-center">
                            <span class="d-inline-block text-dark"><?php echo $notification["text"]?></span>
                        </section>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>