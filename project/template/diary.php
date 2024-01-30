<?php require("header.php"); ?>

<div class="d-flex flex-grow-1 justify-content-center mb-7">
    <div class="col-11 position-relative">
        <div class="ms-7 pt-3 position-absolute h-100" id="lifeline">
        </div>
        <div class="w-100 pt-3 position-relative justify-content-center">
            <!-- heading with propic, username, name, friends/button -->
            <div class="ms-4">
                <div class="d-flexbox align-items-center">
                    <img name="propic-big" src="<?php echo "upload/".$templateParams["username"]["profilePic"]?>" />
                    <div class="ms-sm-5 ms-3 w-100">
                        <div class="w-100 d-flex justify-content-between">
                            <div class="d-inline-block">
                                <span
                                    class="fw-bold fs-5 d-block"><?php echo $templateParams["username"]["name"]; ?></span>
                                <span id="username"
                                    class="d-block"><?php echo $templateParams["username"]["username"]; ?></span>
                            </div>
                            <div class="d-inline-flex align-items-center">
                                <?php if (isset($templateParams["personal"])): ?>
                                <!-- show friends count -->
                                <a class="btn btn-primary text-light btn-sm rounded-4" href="friends.php"><?php
                                    $ending = $templateParams["username"]["friendsCount"] != 1 ? "s" : "";
                                    echo $templateParams["username"]["friendsCount"]." friend".$ending;?></a>
                            </div>
                            <?php elseif (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 0 && $templateParams["friendship"]["sender"] == $templateParams["username"]["username"]): ?>
                            <div>
                                <input id="acceptFriendship" type="button" class="btn btn-primary text-light btn-sm"
                                    value="Accept" />
                                <input id="denyFriendship" type="button" class="btn btn-tertiary btn-sm ms-2"
                                    value="Deny" />
                            </div>
                            <?php else: ?>
                            <div>
                                <input id="friendshipStatus" name="friendshipStatus" type="hidden"
                                    value="<?php echo $templateParams["friendship"]["accepted"]; ?>" />
                                <input id="actionButton" name="actionButton" type="button" class="btn btn-sm" />
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if (isset($templateParams["personal"]) || 
                    (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 1)): ?>
            <div id="diary" class="pt-3 d-block">
                <?php foreach($templateParams["posts"] as $post): ?>
                <div class="d-flex align-items-center ms-4 my-1">
                    <div class="d-flex pe-5">
                        <div name="icon-medium"
                            class="d-flex justify-content-center align-items-center bg-secondary rounded-3">
                            <i class="fa-solid <?php echo getCategoryIconClass($post["category"]); ?>"></i>
                        </div>
                    </div>
                    <section class="d-flex align-items-center">
                        <?php if (isset($post["image"])): ?>
                        <div class="d-flex justify-content-center thumbnail-wrapper rounded-4 overflow-hidden">
                            <img src="upload/<?php echo $post["image"]; ?>" class="float-right h-100" />
                        </div>
                        <?php endif;?>
                        <div class="ms-2">
                            <span class="fw-bold d-block"><?php echo $post["title"]; ?></span>
                            <span
                                class="d-block small"><?php echo date("d/m/Y", strtotime($post['timestamp'])) ?></span>
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