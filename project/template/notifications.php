<?php require("header.php"); ?>
<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-11 col-md-8 col-xl-6 position-relative">
        <div class="lifeline ms-9 pt-4 position-absolute h-100">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <div class="ms-5">
                <div class="ms-5">
                    <div class="bg-secondary rounded-3 d-inline-flex justify-content-center icon-medium">
                        <span class="fa-solid fa-tags h5 mt-1"></span>
                    </div>
                    <h2 class="form-label ms-4 text-dark fs-5 d-inline-block">Your notifications</h2>
                </div>
                <?php foreach($templateParams["notifications"] as $notification):?>
                    <div class="d-flex align-items-center ms-5 my-4">
                        <div class="d-flex pe-4">
                            <div class="icon-medium d-flex justify-content-center align-items-center bg-secondary rounded-3">
                                <span class="fa-solid <?php echo getNotificationIconClass($notification["type"]); ?>"></span>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <span class="d-inline-block text-dark"><?php echo $notification["text"]?></span>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>