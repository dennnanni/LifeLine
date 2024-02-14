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
<div class="row ms-0 w-100 d-flex justify-content-center mb-9">
    <form class="col-xl-5 col-md-6 col-10" method="POST" enctype="multipart/form-data">
        <ul class="list-unstyled">
            <li>
                <div class="mt-4 w-50 h-50 mb-2">
                    <label class="text-dark fs-5" for="postImage">Image</label>
                    <input class="square" type="file" id="postImage" name="postImage" accept="image/jpg, image/jpeg, image/png, image/gif" hidden>
                        <img id="post-image" src="<?php echo ($templateParams["imageName"] != "" ? "upload/".$templateParams["imageName"] : "images/empty-post-photo.jpg")?>" class="w-100 h-100 border border-1 border-tertiary-light border-solid rounded-3" alt="post image">
                </div>
            </li>
            <li>
                <label for="title" hidden>Title</label>
                <textarea class="d-block w-100 mb-2 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" id="title" name="title" placeholder="Title" maxlength="20" required><?php echo $templateParams["title"]?></textarea>
            </li>
            <li>
                <label for="description" hidden>Description</label>
                <textarea class="d-block w-100 mb-2 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" id="description" name="description" placeholder="Description" maxlength="180"><?php echo $templateParams["description"]?></textarea>
            </li>
            <li>
                <label for="location" hidden>Location</label>
                <input class="w-100 mb-2 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="text" id="location" name="location" maxlength="32" placeholder="Location" value="<?php echo $templateParams["location"]?>"/>
            </li>
            <li>
                <label for="category" hidden>Category</label>
                <select class="form-select w-100 mb-2 border border-1 border-tertiary-light border-solid btn-lg bg-light text-dark" id="category" name="category" required>
                    <option value="" <?php if($templateParams["category"] == ""): { echo "selected";} endif;?>>Category</option>
                    <?php foreach($templateParams["categories"] as $category): ?>
                        <option value="<?php echo $category["name"]; ?>" <?php if($templateParams["category"] == $category["name"]): { echo "selected";} endif;?>><?php echo $category["name"]; ?></option>
                    <?php endforeach; ?>
                </select>
            </li>
            <li class="d-flex justify-content-end">
                <div>
                    <label><?php echo $templateParams["tag-number"];?> Tag</label>
                    <a id="tag" href="tag.php" class="w-75 mb-2 rounded-3 border-0 bg-secondary text-dark text-center p-1 text-decoration-none">Tag friends</a>
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