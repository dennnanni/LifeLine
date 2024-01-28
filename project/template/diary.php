<?php require("header.php"); ?>

<div class="d-flex justify-content-center">
    <div class="vh-100 col-11 position-relative">
        <div class="ms-5 ms-md-6 ms-xl-6 pt-3 min-vh-100 position-absolute" name="lifeline">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <!-- heading with propic, username, name, friends/button -->
            <div class="ms-30">
                <div class="d-flex align-items-center">
                    <img name="propic-big" src="upload/default.jpg"/>
                    <span class="ms-5 fw-bold fs-5"><?php echo "@".$templateParams["username"]; ?></span>
                </div>
                
                <?php if (isset($templateParams["posts"])): ?>
                    <?php if (isset($templateParams["personal"])): ?>
                    <!-- show friends count  -->
                    <div>
                    </div>
                    <?php else: ?>
                    <!-- show friendship button -->
                    <div>
                    </div>
                    <?php  endif; ?>
                    <?php foreach($templateParams["posts"] as $post): ?>
                        <div class="d-flex align-items-center ms-31 my-1">
                            <div class="d-flex pe-4">
                                <div name="icon-medium" class="d-flex justify-content-center align-items-center bg-secondary rounded-3">
                                    <!-- TODO: gestire diversa icona per diversa categoria -->
                                    <i class="fa-solid fa-heart"></i>
                                </div>
                            </div>
                            <section class="d-flex align-items-center">
                                <img src="upload/default.jpg" class="float-right w-25 h-25"/>
                                <div class="">
                                    <span class="fw-bold d-block"><?php echo $post["title"]; ?></span>
                                    <span class="d-block small"><?php echo $post["datetime"] ?></span>
                                </div>
                            </section>
                        </div>
                    <?php endforeach; ?>
                <?php else: 
                    echo $templateParams["friendshipStatus"];
                    ?>
                    <!-- show request friendship button or cancel request button -->
                <?php endif; ?>
            </div>
        </div>
        
    </div>
</div>

<?php require("footer.php"); ?>