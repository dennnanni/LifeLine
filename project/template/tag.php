<?php require("header.php"); ?>
<div class="d-flex flex-grow-1 justify-content-center mb-7">
    <div class="col-11 position-relative">
        <div class="lifeline ms-7 pt-3 h-100 position-absolute">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <div class="ms-6">
                <div class="todo"> <!--TODO: configure bootstrap .7rem spacing -->
                    <div class="bg-secondary rounded-3 d-inline-flex justify-content-center icon-medium">
                        <i class="fa-solid fa-tags h5 mt-1"></i>
                    </div>
                    <h2 class="form-label ms-3 text-dark bg-light fs-5 d-inline-block">Tag a friend</h2>
                </div>
                <?php foreach($templateParams["friends"] as $friend):?>
                    <section class="w-100 mt-2 d-flex align-items-center justify-content-between">
                        <div class="d-flex justify-content-center align-items-center">
                            <img class="propic-medium" src="upload/<?php echo $friend["profilePic"]?>" alt="friend profile picture"/>
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
<?php require("footer.php"); ?>