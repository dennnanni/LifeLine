<footer class="mt-auto bg-light fixed-bottom vw-100">
    <div class="row">
        <div class="col-sm-12 col-12 d-flex">
            <div class="col-4 col-sm-4">
                <a class="nav-link flex-fill text-end" aria-current="page" href="home.php">
                <?php if (isset($templateParams["footerActive"]) && $templateParams["footerActive"] == "home"): ?>
                    <i class="bi bi-house-fill h3"></i>
                <?php else: ?>
                    <i class="bi bi-house h3"></i>
                <?php endif; ?>
                </a>
            </div>
            <div class="col-4 col-sm-4">
            <a class="nav-link flex-fill text-center" href="create.php">
                <?php if (isset($templateParams["footerActive"]) && $templateParams["footerActive"] == "create"): ?>
                    <i class="bi bi-plus-circle-fill h3"></i>
                <?php else: ?>
                    <i class="bi bi-plus-circle h3"></i>
                <?php endif; ?>
            </a>
            </div>
            <div class="col-4 col-sm-4">
                <a class="nav-link flex-fill text-start" href="diary.php">
                    <?php if (isset($templateParams["footerActive"]) && $templateParams["footerActive"] == "diary"): ?>
                        <i class="bi bi-book-half h3"></i>
                    <?php else: ?>
                        <i class="bi bi-book h3"></i>
                    <?php endif; ?>
                </a>
            </div>
        </div>
    </div>
</footer>