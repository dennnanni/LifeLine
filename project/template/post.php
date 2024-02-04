<?php require("header.php"); ?>
<!-- <p>post: <?php echo implode(" ", $templateParams["post"])?></p>
<p>author: <?php echo implode(" ", $templateParams["author"])?></p> -->
<!-- 
<a href="comments.php?id=<?php echo $templateParams["post"]["id"]?>">Commenti</a>
<a href="stars.php?id=<?php echo $templateParams["post"]["id"]?>">Stelle</a> -->

<div class="d-flex flex-grow-1 mb-10 justify-content-center">
    <div class="col-12 col-md-8 col-lg-6 col-xl-4 position-relative mt-3">
        <div class="lifeline ms-7 pt-4 position-absolute h-100 mt-7"></div>
        <div class="position-relative">
            <!-- Header with username, location and date -->
            <div class="d-flex ps-1">
                <div class="d-inline-block">
                    <img class="propic-big" src="upload/<?php echo $templateParams["author"]["profilePic"] ?>" alt="<?php $templateParams["author"]["name"]?>'s profile picture"/>
                </div>
                <div class="d-inline-flex align-items-center">
                    <div class="container">
                        <div class="row">
                            <div>
                                <h2 class="fs-5"><a id="username" class="text-decoration-none text-dark" href="diary.php?username=<?php echo $templateParams["author"]["username"] ?>">@<?php echo $templateParams["author"]["username"] ?></a></h2>
                            </div>
                            <div class="d-flex justify-content-between">
                                <span><?php echo date("d/m/Y h:m", strtotime($templateParams["post"]["timestamp"]))?></span>
                                <span><?php echo $templateParams["post"]["location"] ?? ""?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(isset($templateParams["post"]["image"])): ?>
                <!-- Optional image -->
                <div class=" mt-4 px-2">
                    <img class="rounded-4 w-100" src="upload/<?php echo $templateParams["post"]["image"]; ?>" alt="post image"/>
                </div>
            <?php endif; ?>
            <!-- Content with category, title, tags, description, likes and comments -->
            <div class="container">
                <div class="row mt-4">
                    <div class="ps-6 col-1">
                        <div class="icon-big d-inline-flex justify-content-center align-items-center bg-secondary rounded-3">
                            <i class="fa-solid <?php echo getCategoryIconClass($templateParams["post"]["category"]) ?> fs-4"></i>
                        </div>
                    </div>
                    <div class="col ps-6">
                        <input id="postId" type="hidden" value="<?php echo $templateParams["post"]["id"] ?>"/>
                        <h3 class="h4 ps-2"><?php echo $templateParams["post"]["title"] ?></h3>
                        <?php if(count($templateParams["post"]["tagged"]) > 0): ?>
                            <div class="small">
                                <i class="fa-solid fa-tags"></i>
                                <span><?php echo implode(" ", $templateParams["post"]["tagged"][0]) ?></span>
                            </div>
                        <?php endif; ?>
                        <p><?php echo $templateParams["post"]["description"] ?></p>
                        <div class="col d-inline-flex align-items-center fs-5">
                            <div>
                                <input id="currentUser" type="hidden" value="<?php echo $templateParams["currentUser"] ?>"/>
                                <?php if($templateParams["post"]["starsCount"] > 0): ?>
                                <a id="starsCount" class="me-1 text-decoration-none text-dark" href="stars.php?id=<?php echo $templateParams["post"]["id"] ?>"><?php echo $templateParams["post"]["starsCount"] ?></a>
                                <?php else: ?>
                                <span id="starsCount" class="me-1"><?php echo $templateParams["post"]["starsCount"] ?></span>
                                <?php endif; ?>
                                <button id="star" class="border-0 p-0 bg-light">
                                    <i class="fa-<?php echo $templateParams["post"]["starred"] ? "solid text-secondary" : "regular" ?> fa-star"></i>
                                </button>
                            </div>
                            <a class="ms-5 me-1 text-decoration-none text-dark" href="comments.php?id=<?php echo $templateParams["post"]["id"] ?>">
                                <span id="commentsCount"><?php echo $templateParams["post"]["commentsCount"] ?></span>
                                <i class="fa-regular fa-comment"></i>
                            </a>
                        </div>
                    </div>
                    <div id="comment">
                        <?php if(isset($templateParams["lastComment"])): ?>
                        <div class="d-flex align-items-center ms-3">
                            <img class="propic-small" src="upload/<?php echo $templateParams["lastComment"]["profilePic"] ?>" alt="Your profile picture" aria-hidden="true"/>
                            <div class="d-inline-block text-dark ms-2 w-100 mt-3">
                                <span class="fw-bold d-block">
                                    <?php echo $templateParams["lastComment"]["username"]?>
                                </span>
                                <p class="text-break">
                                <?php echo $templateParams["lastComment"]["text"]?>
                                </p>
                            </div>
                        </div>
                        <?php endif; ?>
                    </div>
                    <div class="input-group">
                        <label for="commentArea" hidden>Comment</label>
                        <textarea id="commentArea" class="form-control" placeholder="Leave a comment"></textarea>
                        <div class="input-group-append">
                            <button id="sendButton" class="h-100 btn btn-outline-secondary text-dark bg-secondary" type="button">Send</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php require("footer.php"); ?>