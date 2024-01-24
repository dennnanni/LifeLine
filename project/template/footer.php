<footer class="mt-auto bg-light">
    <div class="row ">
        <div class="col-4 ">
            <a class="nav-link flex-fill text-end" aria-current="page" href="home.php">
            <?php if ($templateParams["footerActive"] == "home"): ?>
                <i class="bi bi-house-fill h3"></i>
            <?php else: ?>
                <i class="bi bi-house h3"></i>
            <?php endif; ?>
            </a>
        </div>
        <div class="col-4 ">
        <a class="nav-link flex-fill text-center" href="create.php">
            <?php if ($templateParams["footerActive"] == "create"): ?>
                <i class="bi bi-plus-circle-fill h3"></i>
            <?php else: ?>
                <i class="bi bi-plus-circle h3"></i>
            <?php endif; ?>
        </a>
        </div>
        <div class="col-4 ">
            <a class="nav-link flex-fill text-start" href="diary.php">
                <?php if ($templateParams["footerActive"] == "diary"): ?>
                    <i class="bi bi-book-half h3"></i>
                <?php else: ?>
                    <i class="bi bi-book h3"></i>
                <?php endif; ?>
            </a>
        </div>
    </div>
</footer>