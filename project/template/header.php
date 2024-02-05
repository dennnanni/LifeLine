<nav class="navbar bg-primary w-100">
  <div class="container-fluid">
    <div class="col-1 d-flex justify-content-center align-items-center">
      <?php if(isset($templateParams["headerLeftIcon"])): ?>
        <?php if ($templateParams["headerLeftIcon"] == "notifications"): ?>
          <a class="m-0 h5" href="notifications.php" title="Go to notifications">
            <?php if(isset($templateParams["notificationsNumber"]) && $templateParams["notificationsNumber"] > 0): ?>
              <span class="fas fa-bell text-secondary"></span>
            <?php else: ?>
              <span class="fas fa-bell text-light"></span>
            <?php endif;?>
          </a>
        <?php elseif ($templateParams["headerLeftIcon"] == "logout"): ?>
          <a class="m-0 h5" href="logout.php" title="Log out">
            <span class="fa-solid fa-arrow-right-from-bracket fa-flip-horizontal text-light"></span>
          </a>
        <?php elseif ($templateParams["headerLeftIcon"] == "back"): ?>
          <a class="m-0 h5" id="backArrow" title="Navigate to previous page">
            <span class="fas fa-chevron-left text-light"></span>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
    <div class="col-10 text-center">
      <h1 id="title" class="text-light">LifeLine</h1>
    </div>
    <div class="col-1 d-flex justify-content-center align-items-center">
      <?php if(isset($templateParams["headerRightIcon"])): ?>
        <?php if ($templateParams["headerRightIcon"] == "search"): ?>
          <a class="m-0 h5" href="search.php" title="Go to search page">
            <span class="fa-solid fa-magnifying-glass text-light"></span>
          </a>
        <?php elseif ($templateParams["headerRightIcon"] == "photo"): ?>
          <a class="m-0 h5" href="photo.php" title="Change your profile photo">
            <span class="fa-regular fa-id-badge text-light"></span>
          </a>
        <?php elseif ($templateParams["headerRightIcon"] == "diary"): ?>
          <a class="m-0 h5" href="diary.php" title="Go to your diary">
            <span class="bi bi-book text-light"></span>
          </a>
        <?php elseif ($templateParams["headerRightIcon"] == "done"): ?>
          <a class="m-0 h5" id="done" title="Confirm changes">
            <span class="fa-solid fa-check text-light"></span>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</nav>
