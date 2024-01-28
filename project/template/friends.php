<?php require("header.php"); ?>

<div class="d-flex justify-content-center">
    <div class="vh-100 col-11 position-relative">
        <div class="ms-5 ms-md-6 ms-xl-6 pt-3 min-vh-100 position-absolute" name="lifeline">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <div class="ms-31">
                <div class="d-flex align-items-center">
                    <img name="propic-big" src="<?php echo "upload/".$templateParams["user"]["profilePic"]?>"/>
                    <div class="ms-sm-4 ms-3">
                        <div class="">
                            <span class="fw-bold fs-5 d-block"><?php echo $templateParams["user"]["name"]; ?>'s friends</span>
                        </div>
                    </div>
                </div>
                <div class="ms-2">
                    <?php foreach($templateParams["friends"] as $friend):?>
                        <a href="diary.php?username=<?php echo $friend["username"]?>" class="text-decoration-none">
                            <div class="d-flex align-items-center my-4">
                                <div class="justify-content-center ">
                                    <img name="propic-medium" src="upload/<?php echo $friend["profilePic"]?>"/>
                                    <span class="d-inline-block text-dark"><?php echo $friend["name"]?> (@<?php echo $friend["username"]?>)</span>
                                </div>
                            </div>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>