<?php require("header.php"); ?>
<?php if(isset($templateParams["uploadError"])): ?>
    <div class="toast-container position-absolute top-0 start-50 translate-middle-x">
        <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <strong class="me-auto text-secondary">Lifeline</strong>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body"><?php echo $templateParams["uploadError"]; ?></div>
        </div>
    </div>
<?php endif; ?>
<div class="row ms-0 w-100 d-flex justify-content-center">
        <form class="col-xl-5 col-md-6 col-10" method="POST" enctype="multipart/form-data">
            <ul class="list-unstyled">
                <li>
                    <div class="mt-3 w-100 h-100 mb-2">
                        <h5 class="text-dark">Image</h5>
                        <input class="square" type="file" id="immaginePost" name="immaginePost" accept="image/jpg, image/jpeg, image/png, image/gif" hidden>
                        <img id="post-image" src="images/empty-post-photo.jpg" class=" border border-1 border-tertiary-light border-solid rounded-3 w-100 h-100" alt="next profile picture">
                    </div>
                </li>
                <li>
                    <label for="submit" hidden>Change photo</label>
                    <input class="mt-2 mx-0 w-100 rounded-3 border border-2 border-secondary bg-secondary btn-lg text-dark" type="submit" name="submit" id="submit" value="Set photo" />
                </li>
                <?php if($templateParams["skip"]): ?>
                    <li>
                        <a id="skip" href="diary.php" class="mt-3 text-decoration-none text-dark w-25 d-block h4">Skip</a>
                    </li>
                <?php endif; ?>
            </ul>
        </form>
    </div>

<?php if(!$templateParams["skip"]) { require("footer.php"); }?>