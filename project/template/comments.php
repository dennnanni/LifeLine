<?php require("header.php"); ?>

<div class="toast-container position-absolute top-5 start-50 translate-middle-x">
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto text-secondary">Lifeline</strong>
            <button id="toastDismiss" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light">
            <label for="confirmDelete">This comment will be deleted from the memory, will you continue?</label>
            <button id="confirmDelete" class="btn btn-danger btn-sm mt-2">Delete</button>
        </div>
    </div>
</div>


<input type="hidden" id="postId" value="<?php echo $templateParams["post"]["id"]?>"/>
<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-11 col-md-6 position-relative">
        <div class="lifeline ms-9 pt-4 position-absolute h-100">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <div class="ms-5">
                <div class="ms-5">
                    <div class="bg-secondary rounded-3 d-inline-flex justify-content-center icon-medium">
                        <span class="fa-solid fa-comment h5 mt-1"></span>
                    </div>
                    <h2 class="form-label ms-4 text-dark bg-light fs-5 d-inline-block"><?php echo $templateParams["post"]["title"]?> comments</h2>
                </div>
                <div id="comments">
                    <?php foreach($templateParams["comments"] as $comment):?>
                        <div class="ms-4 d-flex align-items-center">
                            <div class="rounded-circle propic-wrapper-sm">
                                <img class="propic" src="upload/<?php echo $comment["author"]["profilePic"]?>" alt="friend profile picture"/>
                            </div>
                            <div class="d-inline-flexbox flex-grow-1 text-dark ms-2 mt-3">
                                <div class="d-flex justify-content-between">
                                    <input type="hidden" value="<?php echo $comment["id"] ?>" />
                                    <a href="diary.php?username=<?php echo $comment["username"]?>" class="d-block text-dark fw-bold text-decoration-none d-flex align-items-center">
                                        <?php echo $comment["username"]?>
                                    </a>
                                    <?php if($templateParams["currentUser"] == $comment["username"]): ?>
                                        <label for="<?php echo $comment["id"] ?>" hidden>Delete the comment</label>
                                        <button id="<?php echo $comment["id"] ?>" class="btn bg-light border-0" name="deleteButton">
                                            <span class="fa-solid fa-trash"></span>
                                        </button>
                                    <?php endif; ?>
                                </div>
                                <p class="text-break">
                                <?php echo $comment["text"]?>
                                </p>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div>
                <div class="input-group">
                    <label for="commentArea" hidden>Comment</label>
                    <textarea id="commentArea" class="form-control border border-0" placeholder="Leave a comment"></textarea>
                    <div class="input-group-append">
                        <label for="sendButton" hidden>Send comment</label>
                        <button id="sendButton" class="h-100 btn btn-outline-secondary text-dark bg-secondary" type="button">Send</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>