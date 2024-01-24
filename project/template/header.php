<nav class="navbar bg-primary p-0">
  <div class="container-fluid">
    <div class="col-1 d-flex justify-content-center align-items-center">
      <?php if(isset($templateParams["headerLeftIcon"])): ?>
        <?php if ($templateParams["headerLeftIcon"] == "notifications"): ?>
          <a class="" href="notifications.php">
            <i class="fas fa-bell text-light"></i>
          </a>
        <?php elseif ($templateParams["headerLeftIcon"] == "back"): ?>
          <a class="" href="todo.php">
            <i class="fas fa-chevron-left text-light"></i>
          </a>
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
        <?php elseif ($templateParams["headerRightIcon"] == "settings"): ?>
          <a class="" href="todo.php">
            <i class="fa-solid fa-gear text-light"></i>
          </a>
        <?php endif; ?>
      <?php endif; ?>
    </div>
  </div>
</nav>
