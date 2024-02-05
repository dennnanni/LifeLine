<?php require("header.php"); ?>

<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-11 col-md-8 col-lg-6 col-xl-4 position-relative">
        <div class="lifeline ms-9 pt-4 h-100 position-absolute mt-7">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <div class="ms-5">
                <div class="d-flex align-items-center">
                    <div class="rounded-circle propic-wrapper-lg">
                        <img class="propic" src="<?php echo "upload/".$templateParams["user"]["profilePic"]?>" alt="<?php echo $templateParams["user"]["name"] ?>'s profile picture"/>
                    </div>
                    <div class="ms-sm-6 ms-4">
                        <div class="">
                            <span class="fw-bold fs-5 d-block"><?php echo $templateParams["user"]["name"] ?>'s friends</span>
                        </div>
                    </div>
                </div>
                <div class="ms-2">
                    <?php foreach($templateParams["friends"] as $friend):?>
                        <a href="diary.php?username=<?php echo $friend["username"]?>" class="text-decoration-none d-flex align-items-center my-6 d-block">
                            <div class="rounded-circle propic-wrapper-md rounded-circle">
                                <img class="propic" src="upload/<?php echo $friend["profilePic"]?>" alt="friend profile picture"/>
                            </div>
                            <span class="d-inline-block text-dark ms-2"><?php echo $friend["name"]?> (@<?php echo $friend["username"]?>)</span>
                        </a>
                    <?php endforeach;?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>