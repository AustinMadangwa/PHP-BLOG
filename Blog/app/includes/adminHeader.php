<header>
  <!-- Logo -->
  <a href="<?php echo BASE_URL.'/index.php' ?>" class="logo">
    <h1 class="logo-text"><span>Miles</span>LifeGuide</h1>
  </a>
  <!-- Navigation Items -->
  <i class="fa fa-bars menu-toggle"></i>
  <ul class="nav">
    <?php if (isset($_SESSION['username'])): ?>
      <li>
        <a href="#">
          <i class="fa fa-user"></i>
            <?php if (strlen($_SESSION['username']) > 11): ?>
              <?php echo substr($_SESSION['username'], 0,8). '...'?>
            <?php else: ?>
              <?php echo $_SESSION['username']?>
            <?php endif; ?>
          <i class="fa fa-chevron-down" style = "font-size: 0.8em;"></i>
        </a>
        <ul>
          <li><a href="<?php echo BASE_URL. '/logout.php' ?>" class="logout">Logout</a></li>
        </ul>
      </li>
    <?php endif; ?>
  </ul>
</header>
