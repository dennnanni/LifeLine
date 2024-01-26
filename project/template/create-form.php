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
<div class="row justify-content-center">
        <form class="col-xl-5 col-md-6 col-10" method="POST" enctype="multipart/form-data">
            <ul class="list-unstyled">
                <li>
                    <div class="mt-3 w-50 h-50 mb-2">
                        <h5 class="text-dark">Image</h5>
                        <input class="square" type="file" id="immaginePost" name="immaginePost" accept="image/jpg, image/jpeg, image/png, image/gif" hidden>
                        <div class="w-100 h-100">
                            <img id="post-image" src="images/empty-post-photo.jpg" class=" border border-1 border-tertiary-light border-solid rounded-3" alt="photo image">
                        </div>
                    </div>
                </li>
                <!-- <li>
                   <label for="title" hidden>Title</label>
                   <input required class="w-100 mb-2 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="text" id="title" name="title" placeholder="Title" maxlength="64"/>
                </li> -->
                <li>
                   <label for="title" hidden>Title</label>
                   <textarea class="d-block w-100 mb-2 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" id="title" name="title" placeholder="Title" maxlength="25"></textarea>
                </li>
                <li>
                   <label for="description" hidden>Description</label>
                   <textarea class="d-block w-100 mb-2 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" id="description" name="description" placeholder="Description" maxlength="180"></textarea>
                </li>
                <li>
                   <label for="location" hidden>Location</label>
                   <input class="w-100 mb-2 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="text" id="location" name="location" placeholder="Location"/>
                </li>
                <li>
                    <select class="form-select w-100 mb-2 border border-1 border-tertiary-light border-solid btn-lg bg-light text-dark" id="category" name="category">
                        <option value="0" selected>Category</option>
                        <?php foreach($templateParams["categories"] as $category): ?>
                            <option value="<?php echo $category["name"]; ?>"><?php echo $category["name"]; ?></option>
                        <?php endforeach; ?>
                    </select>
                </li>
                <li>
                    <div class="justify-content-end">
                        <label for="tag"><?php echo $templateParams["tag-number"];?> Tag</label>
                        <a href="tag.php" class="w-75 mb-2 rounded-3 border-0 bg-secondary text-dark text-center p-1 text-decoration-none">Tag friends</a>
                    </div>
                </li>
                <li>
                    <label for="submit" hidden>Submit</label>
                    <input class="mt-2 w-100 rounded-3 border-0 bg-secondary btn-lg text-dark" type="submit" name="submit" id="submit" value="Add Memory" />
                </li>
            </ul>
        </form>
    </div>

<?php require("footer.php"); ?>