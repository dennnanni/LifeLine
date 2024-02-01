<footer class="mt-auto bg-light vw-100 position-fixed bottom-0">
    <div class="row">
        <div class="col-sm-12 col-12 d-flex">
            <div id="home" class="footerLink col-4 col-sm-4 nav-link flex-fill text-end">
                <?php if (isset($templateParams["footerActive"]) && $templateParams["footerActive"] == "home"): ?>
                    <i class="bi bi-house-fill h3"></i>
                <?php else: ?>
                    <i class="bi bi-house h3"></i>
                <?php endif; ?>
            </div>
            <div id="create" class="footerLink col-4 col-sm-4 nav-link flex-fill text-center">
                <?php if (isset($templateParams["footerActive"]) && $templateParams["footerActive"] == "create"): ?>
                    <i class="bi bi-plus-circle-fill h3"></i>
                <?php else: ?>
                    <i class="bi bi-plus-circle h3"></i>
                <?php endif; ?>
            </div>
            <div id="diary" class="footerLink col-4 col-sm-4 nav-link flex-fill text-start">
                <?php if (isset($templateParams["footerActive"]) && $templateParams["footerActive"] == "diary"): ?>
                    <i class="bi bi-book-half h3"></i>
                <?php else: ?>
                    <i class="bi bi-book h3"></i>
                <?php endif; ?>
            </div>
        </div>
    </div>
</footer>