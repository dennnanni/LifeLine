<nav class="navbar bg-primary w-100">
  <div class="container-fluid">
    <div class="col-1 d-flex justify-content-center align-items-center">
      <?php if(isset($templateParams["headerLeftIcon"])): ?>
        <?php if ($templateParams["headerLeftIcon"] == "notifications"): ?>
          <a class="m-0 h5" href="notifications.php">
            <?php if(isset($templateParams["notificationsNumber"]) && $templateParams["notificationsNumber"] > 0): ?>
              <i class="fas fa-bell text-secondary"></i>
            <?php else: ?>
              <i class="fas fa-bell text-light"></i>
            <?php endif;?>
          </a>
        <?php elseif ($templateParams["headerLeftIcon"] == "logout"): ?>
          <a class="m-0 h5" href="logout.php">
            <i class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal text-light"></i>
          </a>
        <?php elseif ($templateParams["headerLeftIcon"] == "back"): ?>
          <a class="m-0 h5" id="backArrow">
            <i class="fas fa-chevron-left text-light"></i>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="col-10 text-center">
      <a class="" href="home.php">
        <h1 id="home" class="footerLink text-light">LifeLine</h1>
      </a>
    </div>
    <div class="col-1 d-flex justify-content-center align-items-center">
      <?php if(isset($templateParams["headerRightIcon"])): ?>
        <?php if ($templateParams["headerRightIcon"] == "search"): ?>
          <a class="m-0 h5" href="search.php">
            <i class="fa-solid fa-magnifying-glass text-light"></i>
          </a>
        <?php elseif ($templateParams["headerRightIcon"] == "photo"): ?>
          <a class="m-0 h5" href="photo.php">
            <i class="fa-regular fa-id-badge text-light"></i>
          </a>
        <?php elseif ($templateParams["headerRightIcon"] == "diary"): ?>
          <a class="m-0 h5" href="diary.php">
            <i class="bi bi-book text-light"></i>
          </a>
        <?php elseif ($templateParams["headerRightIcon"] == "done"): ?>
          <a class="m-0 h5" id="done">
            <i class="fa-solid fa-check text-light"></i>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</nav>
