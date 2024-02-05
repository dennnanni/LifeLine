<?php require("header.php"); ?>
<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-11 col-md-8 col-lg-6 col-xl-4 position-relative">
        <div class="lifeline ms-9 pt-4 h-100 position-absolute">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <div class="ms-7 pe-4">
                <div class="ms-3">
                    <div class="bg-secondary rounded-3 d-inline-flex justify-content-center icon-medium">
                        <span class="fa-solid fa-tags h5 mt-1"></span>
                    </div>
                    <h2 class="form-label ms-4 text-dark bg-light fs-5 d-inline-block">Tag a friend</h2>
                </div>
                <?php foreach($templateParams["friends"] as $friend):?>
                    <div class="w-100 mt-2 d-flex align-items-center justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="d-inline-block rounded-circle propic-wrapper-md">
                                <img class="propic" src="upload/<?php echo $friend["profilePic"]?>" alt="friend profile picture"/>
                            </div>
                            <span id = "<?php echo $friend["username"]?>" class="d-inline-block text-dark ms-1"><?php echo $friend["name"]?> (@<?php echo $friend["username"]?>)</span>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <?php if (in_array($friend["username"], $_SESSION["taggedUsers"])): ?>
                                <label for="<?php echo $friend["username"] ?>Button" hidden>Deselect <?php echo $friend["name"] ?></label>
                            <?php else: ?>                                
                                <label for="<?php echo $friend["username"] ?>Button" hidden>Select <?php echo $friend["name"] ?></label>
                            <?php endif; ?>
                            <button id="<?php echo $friend["username"] ?>Button" class="btn border-0 bg-light shadow-none" name="userSelector">
                                <span class="bi bi-check-circle-fill h3 <?php echo (in_array($friend["username"], $_SESSION["taggedUsers"]) ? "text-secondary" : "text-tertiary") ?> mt-2"></span>
                            </button>
                        </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>