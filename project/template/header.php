<nav class="navbar bg-primary w-100">
  <div class="container-fluid">
    <div class="col-1 d-flex justify-content-center align-items-center">
      <?php if(isset($templateParams["headerLeftIcon"])): ?>
        <?php if ($templateParams["headerLeftIcon"] == "notifications"): ?>
          <a class="" href="notifications.php">
            <?php if(isset($templateParams["notificationsNumber"]) && $templateParams["notificationsNumber"] > 0): ?>
              <i class="fas fa-bell text-secondary"></i>
            <?php else: ?>
              <i class="fas fa-bell text-light"></i>
            <?php endif;?>
          </a>
        <?php elseif ($templateParams["headerLeftIcon"] == "logout"): ?>
          <a class="" href="logout.php">
            <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal text-light"></i>
          </a>
        <?php elseif ($templateParams["headerLeftIcon"] == "back"): ?>
          <?php if(isset($templateParams["backPage"])): ?>
            <a class="" href="<?php echo $templateParams["backPage"]?>">
              <i class="fas fa-chevron-left text-light"></i>
            </a>
          <?php else: ?>
            <a class="" href="">
              <i class="fas fa-chevron-left text-light"></i>
            </a>
          <?php endif; ?>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="col-10 text-center">
      <a class="" href="home.php">
        <h1 class="text-light">LifeLine</h1>
      </a>
    </div>
    <div class="col-1 d-flex justify-content-center align-items-center">
      <?php if(isset($templateParams["headerRightIcon"])): ?>
        <?php if ($templateParams["headerRightIcon"] == "search"): ?>
          <a class="" href="search.php">
            <i class="fa-solid fa-magnifying-glass text-light"></i>
          </a>
        <?php elseif ($templateParams["headerRightIcon"] == "photo"): ?>
          <a class="" href="photo.php">
            <i class="fa-regular fa-id-badge text-light"></i>
          </a>
        <?php elseif ($templateParams["headerRightIcon"] == "done"): ?>
        <a class="" href="<?php echo $templateParams["backPage"]?>">
          <i class="fa-solid fa-check text-light"></i>
        </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</nav>
