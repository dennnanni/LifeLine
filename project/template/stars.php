<?php require("header.php"); ?>

<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-11 col-md-8 col-lg-6 col-xl-4 position-relative">
        <div class="lifeline ms-9 pt-4 position-absolute h-100">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <div class="ms-5">
                <div class="ms-5">
                    <div class="bg-secondary rounded-4 d-inline-flex justify-content-center icon-medium">
                        <span class="fa-solid fa-star h5 mt-1"></span>
                    </div>
                    <h2 class="form-label ms-4 text-dark bg-light fs-5 d-inline-block"><?php echo $templateParams["post"]["title"]?> stars</h2>
                </div>
                <?php foreach($templateParams["stars"] as $star):?>
                <div class="d-flex align-items-center ms-5 my-4">
                    <div class="d-flex pe-4">
                        <div class="icon-medium d-flex justify-content-center align-items-center bg-secondary rounded-4">
                            <span class="fa-solid fa-star" aria-hidden="true"></span>
                        </div>
                    </div>
                    <div class="d-flex align-items-center">
                            <a class="text-decoration-none text-dark fw-bold" href="diary.php?username=<?php echo $star["username"]?>">@<?php echo $star["username"]?></a>
                    </div>
                </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>

<?php require("footer.php"); ?>