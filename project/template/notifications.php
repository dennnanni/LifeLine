<?php require("header.php"); ?>
<div class="d-flex flex-grow-1 justify-content-center mb-7">
    <div class="col-11 col-md-6 position-relative">
        <div class="ms-7 pt-3 position-absolute h-100" id="lifeline">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <div class="ms-4">
                <?php foreach($templateParams["notifications"] as $notification):?>
                    <div class="d-flex align-items-center ms-4 my-3">
                        <div class="d-flex pe-3">
                            <div name="icon-medium" class="d-flex justify-content-center align-items-center bg-secondary rounded-3">
                                <i class="fa-solid <?php echo getNotificationIconClass($notification["type"]); ?>"></i>
                            </div>
                        </div>
                        <section class="d-flex align-items-center">
                            <!-- <img name="search-propic" src="upload/<?php echo $notification["profilePic"]?>"/> -->
                            <span class="d-inline-block text-dark"><?php echo $notification["text"]?></span>
                        </section>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>