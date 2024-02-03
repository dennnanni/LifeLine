<?php require("header.php"); ?>
<input type="hidden" id="postId" value="<?php echo $templateParams["post"]["id"]?>"/>
<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-11 col-md-6 position-relative">
        <div class="lifeline ms-9 pt-4 position-absolute h-100">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <div class="ms-5">
                <div class="ms-4">
                    <div class="bg-secondary rounded-3 d-inline-flex justify-content-center icon-medium">
                        <i class="fa-solid fa-tags h5 mt-1"></i>
                    </div>
                    <h2 class="form-label ms-4 text-dark bg-light fs-5 d-inline-block"><?php echo $templateParams["post"]["title"]?> comments</h2>
                </div>
                <div id="comments">
                <?php foreach($templateParams["comments"] as $comment):?>
                    <p><?php echo $comment["text"]?></p>
                <?php endforeach;?>
                </div>

                <label for="comment" hidden>Comment</label>
                <input class="w-100 mb-2 rounded-3 border-1 border-tertiary-light border-solid border btn-lg bg-light text-dark" type="text" id="comment" name="comment" maxlength="32" placeholder="New comment"/>
            
                <label for="postComment" hidden>Post comment</label>
                <input class="mt-2 w-100 rounded-3 border-0 bg-secondary btn-lg text-dark" type="submit" name="postComment" id="postComment" value="Add comment" />
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>