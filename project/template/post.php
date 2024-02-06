<?php require("header.php"); ?>


<div class="toast-container position-absolute top-5 start-50 translate-middle-x">
    <div id="toast" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
        <div class="toast-header">
            <strong class="me-auto text-secondary">Lifeline</strong>
            <button id="toastDismiss" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body bg-light">
            <label for="confirmDelete">This memory will be deleted from your diary, will you continue?</label>
            <button id="confirmDelete" class="btn btn-danger btn-sm mt-2">Delete</button>
        </div>
    </div>
</div>

<div class="d-flex flex-grow-1 mb-10 justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-4 position-relative mt-3">
        <div class="lifeline ms-7 pt-4 position-absolute h-100 mt-7"></div>
        <div class="position-relative">
            <!-- Header with username, location and date -->
            <div class="d-flex ps-1 pe-sm-4 pe-1">
                <div class="d-inline-block rounded-circle propic-wrapper-lg">
                    <img class="propic" src="upload/<?php echo $templateParams["author"]["profilePic"] ?>"
                        alt="<?php $templateParams["author"]["name"] ?>'s profile picture" />
                </div>
                <div class="d-flex flex-grow-1 flex-column justify-content-between align-items-center">
                    <div class="d-flex justify-content-between w-100 align-items-center">
                        <a id="username" class="text-decoration-none text-dark"
                            href="diary.php?username=<?php echo $templateParams["author"]["username"] ?>">
                            <h2 class="fs-5 mb-0">
                                @<?php echo $templateParams["author"]["username"] ?>
                            </h2>
                        </a>
                        <?php if ($templateParams["post"]["author"] == $templateParams["currentUser"]): ?>
                            <button id="deleteButton" class="btn bg-light border-0">
                                <span class="fa-solid fa-trash"></span>
                            </button>
                        <?php endif; ?>
                    </div>
                    <div class="d-flex w-100 justify-content-between">
                        <span class="small"><?php echo date("d/m/Y h:m", strtotime($templateParams["post"]["timestamp"])) ?></span>
                        <?php if (isset($templateParams["post"]["location"])): ?>
                            <div>
                                <span class="fa-solid fa-location-dot"></span>
                                <span class="small"><?php echo $templateParams["post"]["location"] ?></span>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php if (isset($templateParams["post"]["image"])): ?>
                <!-- Optional image -->
                <div class=" mt-4 px-2">
                    <img class="rounded-4 w-100" src="upload/<?php echo $templateParams["post"]["image"]; ?>"
                        alt="post image" />
                </div>
            <?php endif; ?>
            <!-- Content with category, title, tags, description, likes and comments -->
            <div class="container-fluid">
                <div class="row mt-4">
                    <div class="ps-6 col-1">
                        <div
                            class="icon-big d-inline-flex justify-content-center align-items-center bg-secondary rounded-3">
                            <span
                                class="fa-solid <?php echo getCategoryIconClass($templateParams["post"]["category"]) ?> fs-4"></span>
                        </div>
                    </div>
                    <div class="col ps-6">
                        <input id="postId" type="hidden" value="<?php echo $templateParams["post"]["id"] ?>" />
                        <h3 class="h4 ps-2">
                            <?php echo $templateParams["post"]["title"] ?>
                        </h3>
                        <?php if (count($templateParams["post"]["tagged"]) > 0): ?>
                            <div class="small">
                                <span class="fa-solid fa-tags"></span>
                                <span class="text-break">
                                    <?php echo implode(" ", $templateParams["post"]["tagged"]) ?>
                                </span>
                            </div>
                        <?php endif; ?>
                        <p>
                            <?php echo $templateParams["post"]["description"] ?>
                        </p>
                        <div class="col d-inline-flex align-items-center fs-5">
                            <div>
                                <input id="currentUser" type="hidden"
                                    value="<?php echo $templateParams["currentUser"] ?>" />
                                <a id="starsCount" class="me-1 text-decoration-none text-dark" <?php echo $templateParams["post"]["starsCount"] > 0 ? 'href="stars.php?id=' . $templateParams["post"]["id"] . '"' : "" ?>>
                                    <?php echo $templateParams["post"]["starsCount"] ?>
                                </a>
                                <button id="star" class="border-0 p-0 bg-light">
                                    <span
                                        class="fa-<?php echo $templateParams["post"]["starred"] ? "solid text-secondary" : "regular" ?> fa-star"></span>
                                </button>
                            </div>
                            <a class="ms-5 me-1 text-decoration-none text-dark"
                                href="comments.php?id=<?php echo $templateParams["post"]["id"] ?>"
                                title="Go to comments page">
                                <span id="commentsCount">
                                    <?php echo $templateParams["post"]["commentsCount"] ?>
                                </span>
                                <span class="fa-regular fa-comment"></span>
                            </a>
                        </div>
                    </div>
                    <div id="comment" class="mt-3">
                        <?php if (isset($templateParams["lastComment"])): ?>
                            <div class="d-flex align-items-center ms-3">
                                <div class="rounded-circle propic-wrapper-sm">
                                    <img class="propic"
                                        src="upload/<?php echo $templateParams["lastComment"]["profilePic"] ?>"
                                        alt="Your profile picture" aria-hidden="true" />
                                </div>
                                <a class="d-flexbox flex-grow-1 text-dark ms-2 mt-3 text-decoration-none"
                                    href="comments.php?id=<?php echo $templateParams["post"]["id"] ?>"
                                    title="See comment in comments page">
                                    <span class="fw-bold d-block">
                                        <?php echo $templateParams["lastComment"]["username"] ?>
                                    </span>
                                    <p class="text-break">
                                        <?php echo $templateParams["lastComment"]["text"] ?>
                                    </p>
                                </a>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="input-group mt-3 position-relative">
                        <label for="commentArea" hidden>Comment</label>
                        <textarea id="commentArea" class="form-control" placeholder="Leave a comment"></textarea>
                        <div class="input-group-append">
                            <label for="sendButton" hidden>Send comment</label>
                            <button id="sendButton" class="h-100 btn btn-outline-secondary text-dark bg-secondary"
                                type="button">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>