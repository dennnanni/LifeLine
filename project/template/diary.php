<?php require("header.php"); ?>

<div class="d-flex flex-grow-1 justify-content-center mb-3">
    <div class="col-11 position-relative">
        <div class="ms-7 pt-3 position-absolute h-100" id="lifeline">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <!-- heading with propic, username, name, friends/button -->
            <div class="ms-4">
                <div class="d-flex align-items-center">
                    <img name="propic-big" src="<?php echo "upload/".$templateParams["username"]["profilePic"]?>"/>
                    <div class="ms-sm-5 ms-3">
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
                    <div id="diary" class="pt-3">
                        <?php foreach($templateParams["posts"] as $post): ?>
                            <div class="d-flex align-items-center ms-4 my-1">
                                <div class="d-flex pe-5">
                                    <div name="icon-medium" class="d-flex justify-content-center align-items-center bg-secondary rounded-3">
                                        <i class="fa-solid <?php echo getIconClass($post["category"]); ?>"></i>
                                    </div>
                                </div>
                                <section class="d-flex align-items-center">
                                    <?php if (isset($post["image"])): ?>
                                        <div class="d-flex justify-content-center thumbnail-wrapper rounded-4 overflow-hidden">
                                            <img src="upload/<?php echo $post["image"]; ?>" class="float-right h-100"/>
                                        </div>
                                    <?php endif;?>
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