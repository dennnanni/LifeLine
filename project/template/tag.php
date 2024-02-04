<?php require("header.php"); ?>
<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-11 col-md-8 col-lg-6 col-xl-4 position-relative">
        <div class="lifeline ms-9 pt-4 h-100 position-absolute">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <div class="ms-7 pe-4">
                <div class="ms-3">
                    <div class="bg-secondary rounded-3 d-inline-flex justify-content-center icon-medium">
                        <i class="fa-solid fa-tags h5 mt-1"></i>
                    </div>
                    <h2 class="form-label ms-4 text-dark bg-light fs-5 d-inline-block">Tag a friend</h2>
                </div>
                <?php foreach($templateParams["friends"] as $friend):?>
                    <div class="w-100 mt-2 d-flex align-items-center justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <img class="propic-medium" src="upload/<?php echo $friend["profilePic"]?>" alt="friend profile picture"/>
                            <span id = "<?php echo $friend["username"]?>" class="d-inline-block text-dark ms-1"><?php echo $friend["name"]?> (@<?php echo $friend["username"]?>)</span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <i class="bi bi-check-circle-fill h3 <?php echo (in_array($friend["username"], $_SESSION["taggedUsers"]) ? "text-secondary" : "text-tertiary") ?> mt-2"></i>
                        </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>