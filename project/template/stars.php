<?php require("header.php"); ?>
<div class="d-flex flex-grow-1 justify-content-center mb-7">
    <div class="col-11 col-md-6 position-relative">
        <div class="lifeline ms-7 pt-3 position-absolute h-100">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <div class="ms-4">
                <?php foreach($templateParams["stars"] as $star):?>
                <div class="d-flex align-items-center ms-4 my-3">
                    <div class="d-flex pe-3">
                        <div class="icon-medium d-flex justify-content-center align-items-center bg-secondary rounded-3">
                            <i class="fa-solid fa-star" aria-hidden="true"></i>
                        </div>
                    </div>
                    <section class="d-flex align-items-center">
                        <span class="d-inline-block text-dark"><a class="text-decoration-none text-dark" href="diary.php?username=<?php echo $star["username"]?>" class="fw-bold">@<?php echo $star["username"]?></a></span>
                    </section>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>