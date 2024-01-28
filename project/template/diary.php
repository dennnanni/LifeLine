<?php require("header.php"); ?>

<div class="d-flex justify-content-center">
    <div class="vh-100 col-11 position-relative">
        <div class="ms-5 ms-md-6 ms-xl-6 pt-3 min-vh-100 position-absolute" id="lifeline">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <!-- heading with propic, username, name, friends/button -->
            <div class="ms-31">
                <div class="d-flex align-items-center">
                    <img name="propic-big" src="<?php echo "upload/".$templateParams["username"]["profilePic"]?>"/>
                    <div class="ms-sm-4 ms-3">
                        <div>
                            <span class="fw-bold fs-5 d-block"><?php echo $templateParams["username"]["name"]; ?></span>
                            <span id="username" class="d-block"><?php echo $templateParams["username"]["username"]; ?></span>
                        </div>
                        <?php if (isset($templateParams["personal"])): ?>
                        <!-- show friends count (maybe redirect to friends list?) -->
                        <a class="btn btn-primary btn-sm rounded-4" href="friends.php"><?php echo $templateParams["username"]["friendsCount"]." friends";?></a>
                        <?php elseif (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 0 && $templateParams["friendship"]["sender"] == $templateParams["username"]["username"]): ?>
                            <!-- due bottoni -->
                            <div class="d-flex">
                                <input id="acceptFriendship" type="button" class="btn btn-primary btn-sm" value="Accept"/>
                                <input id="denyFriendship" type="button" class="btn btn-tertiary btn-sm ms-3" value="Deny"/>
                            </div>
                        <?php else: ?>
                            <div>
                                <input id="friendshipStatus" name="friendshipStatus" type="hidden" value="<?php echo $templateParams["friendship"]["accepted"]; ?>"/>
                                <input id="actionButton" name="actionButton" type="button" class="btn btn-sm"/>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php if (isset($templateParams["personal"]) || 
                    (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 1)): ?>
                    <div id="diary">
                        <?php foreach($templateParams["posts"] as $post): ?>
                            <div class="d-flex align-items-center ms-31 my-1">
                                <div class="d-flex pe-4">
                                    <div name="icon-medium" class="d-flex justify-content-center align-items-center bg-secondary rounded-3">
                                        <!-- TODO: gestire diversa icona per diversa categoria -->
                                        <i class="fa-solid <?php echo getIconClass($post["category"]); ?>"></i>
                                    </div>
                                </div>
                                <section class="d-flex align-items-center">
                                    <?php 
                                        if (isset($post["image"])) {
                                            echo "<img src=\"upload/".$post["image"]."\" class=\"float-right w-25 h-25 rounded-4\"/>";
                                        }
                                    ?>
                                    <div class="ms-2">
                                        <span class="fw-bold d-block"><?php echo $post["title"]; ?></span>
                                        <!-- TODO: cambiare formato -->
                                        <span class="d-block small"><?php echo $post["datetime"] ?></span>
                                    </div>
                                </section>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
</div>

<?php require("footer.php"); ?>