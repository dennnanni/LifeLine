<?php require("header.php"); ?>
<!-- <p>post: <?php echo implode(" ", $templateParams["post"])?></p>
<p>author: <?php echo implode(" ", $templateParams["author"])?></p>

<a href="comments.php?id=<?php echo $templateParams["post"]["id"]?>">Commenti</a> -->

<div class="d-flex flex-grow-1 position-relative mb-7">
    <div class="lifeline ms-6 pt-3 position-absolute h-100 mt-6"></div>
    <div class="col-12 col-md-8 col-xl-4 position-relative">
        <!-- Header with username, location and date -->
        <div class="d-flex ps-1">
            <div class="col">
                <img class="propic-big" src="upload/<?php echo $templateParams["author"]["profilePic"] ?>" alt="<?php $templateParams["author"]["name"]?>'s profile pic"/>
            </div>
            <div class="col-10 d-flex align-items-center">
                <div class="row">
                    <div>
                        <h2><a class="text-decoration-none text-dark" href="diary.php?username=<?php echo $templateParams["author"]["username"] ?>">@<?php echo $templateParams["author"]["username"] ?></a></h2>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><?php echo $templateParams["post"]["location"] ?? ""?></span>
                        <span><?php echo date("d/m/Y h:m", strtotime($templateParams["post"]["timestamp"]))?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Optional image -->
        <div>

        </div>
        <!-- Content with category, title, tags, description, likes and comments -->
        <div>

        </div>
    </div>
</div>
<?php require("footer.php"); ?>