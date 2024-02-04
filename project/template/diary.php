<?php require("header.php"); ?>

<div class="d-flex flex-grow-1 justify-content-center mb-9">
    <div class="col-10 col-md-8 col-lg-6 col-xl-4 position-relative">
        <div class="lifeline ms-6 pt-4 position-absolute h-100 mt-7">
        </div>
        <div class="w-100 pt-4 position-relative justify-content-center">
            <!-- heading with propic, username, name, friends/button -->
            <div class="ms-n1">
                <div class="d-flex align-items-center">
                    <img class="propic-big" src="<?php echo "upload/".$templateParams["username"]["profilePic"]?>" alt="<?php echo $templateParams["username"]["name"] ?>'s profile picture"/>
                    <div class="ms-sm-6 ms-4 w-100 d-flex justify-content-between align-items-center">
                        <div>
                            <span class="fw-bold fs-5 d-block"><?php echo $templateParams["username"]["name"]; ?></span>
                            <span id="username" class="d-block"><?php echo $templateParams["username"]["username"]; ?></span>
                        </div>
                        <div>
                            <!-- show friends count -->
                            <a class="btn btn-primary text-light btn-sm rounded-4 mb-2 w-100" href="friends.php?username=<?php echo $templateParams["username"]["username"]?>"><?php
                                $ending = $templateParams["username"]["friendsCount"] != 1 ? "s" : "";
                                echo $templateParams["username"]["friendsCount"]." friend".$ending;?></a>
                            <?php if (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 0 && $templateParams["friendship"]["sender"] == $templateParams["username"]["username"]): ?>
                                <div class="d-flex">
                                    <input id="acceptFriendship" type="button" class="btn btn-primary text-light btn-sm rounded-4" value="Accept"/>
                                    <input id="denyFriendship" type="button" class="btn btn-tertiary btn-sm ms-1 rounded-4" value="Deny"/>
                                </div>
                            <?php elseif (!$templateParams["personal"]): ?>
                                <div>
                                    <input id="friendshipStatus" name="friendshipStatus" type="hidden" value="<?php echo $templateParams["friendship"]["accepted"]; ?>"/>
                                    <input id="actionButton" name="actionButton" type="button" class="btn btn-sm rounded-4"/>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <?php if ($templateParams["personal"] || 
                    (isset($templateParams["friendship"]) && $templateParams["friendship"]["accepted"] == 1)): ?>
                    <div class="pt-4">
                        <?php foreach($templateParams["posts"] as $post): ?>
                            <div class="d-flex align-items-center ms-6 my-2">
                                <div class="d-flex pe-6">
                                    <div class="icon-medium d-flex justify-content-center align-items-center bg-secondary rounded-3">
                                        <span class="fa-solid <?php echo getCategoryIconClass($post["category"]); ?> fs-5"></span>
                                    </div>
                                </div>
                                <a href="post.php?id=<?php echo $post["id"]?>" class="text-decoration-none text-dark">
                                    <div class="d-flex align-items-center">
                                        <?php if (isset($post["image"])): ?>
                                            <div class="">
                                                <img src="upload/<?php echo $post["image"]; ?>" class="thumbnail-sm rounded-4" alt="post image"/>
                                            </div>
                                        <?php endif;?>
                                        <div class="ms-2">
                                            <span class="fw-bold d-block"><?php echo $post["title"]; ?></span>
                                            <span class="d-block small"><?php echo date("d/m/Y", strtotime($post['timestamp'])) ?></span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
        
    </div>
</div>

<?php require("footer.php"); ?>