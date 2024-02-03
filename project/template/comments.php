<?php require("header.php"); ?>
<input type="hidden" id="postId" value="<?php echo $templateParams["post"]["id"]?>"/>
<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-11 col-md-6 position-relative">
        <div class="lifeline ms-9 pt-4 position-absolute h-100">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <div class="ms-5">
                <div class="ms-5">
                    <div class="bg-secondary rounded-3 d-inline-flex justify-content-center icon-medium">
                        <i class="fa-solid fa-comment h5 mt-1"></i>
                    </div>
                    <h2 class="form-label ms-4 text-dark bg-light fs-5 d-inline-block"><?php echo $templateParams["post"]["title"]?> comments</h2>
                </div>
                <div id="comments">
                    <?php foreach($templateParams["comments"] as $comment):?>
                        <div class="ms-4">
                            <a href="diary.php?username=<?php echo $comment["username"]?>" class="text-decoration-none d-flex align-items-center">
                                <img class="propic-small" src="upload/<?php echo $comment["author"]["profilePic"]?>" alt="friend profile picture"/>
                                <div class="d-inline-block text-dark ms-2 w-100 mt-3">
                                    <span class="fw-bold d-block">
                                        <?php echo $comment["username"]?>
                                    </span>
                                    <p class="text-break">
                                    <?php echo $comment["text"]?>
                                    </p>
                                </div>
                            </a>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="input-group mb-3 mt-3">
                    <input id="comment" name="comment" type="text" class="form-control" placeholder="Leave a comment" maxlength="64">
                    <label for="comment" hidden>Comment</label>
                    <div class="input-group-append">
                        <button id="postComment" class="btn btn-outline-secondary text-dark bg-secondary" type="button">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>