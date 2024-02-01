<?php require("header.php"); ?>

<div class="d-flex flex-grow-1 justify-content-center mb-7">
    <div class="col-11 position-relative">
        <div class="lifeline ms-7 pt-3 h-100 position-absolute mt-6">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <div class="ms-4">
                <div class="d-flex align-items-center">
                    <img class="propic-big" src="<?php echo "upload/".$templateParams["user"]["profilePic"]?>" alt="<?php echo $templateParams["user"]["name"] ?>'s profile picture"/>
                    <div class="ms-sm-5 ms-3">
                        <div class="">
                            <span class="fw-bold fs-5 d-block"><?php echo $templateParams["user"]["name"] ?>'s friends</span>
                        </div>
                    </div>
                </div>
                <div class="ms-2">
                    <?php foreach($templateParams["friends"] as $friend):?>
                        <a href="diary.php?username=<?php echo $friend["username"]?>" class="text-decoration-none d-flex align-items-center my-5 d-block">
                            <img class="propic-medium" src="upload/<?php echo $friend["profilePic"]?>" alt="friend profile picture"/>
                            <span class="d-inline-block text-dark ms-2"><?php echo $friend["name"]?> (@<?php echo $friend["username"]?>)</span>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>