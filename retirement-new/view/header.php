<?php
  session_start(); 
  $loggedin = $_SESSION['loggedin'] ?? false;
?>
<header>
	<!-- Logo Section -->
    <a href="./index.php" class="logo-section">
      <img src="./img/logo-png.png"  alt="LifeMap Logo" class="company-logo" />
      <span class="company-name" >Life</span><span class="company-name2">Map</span>
    </a>
<!-- Dynamic Menu (Left Corner) -->
  <ul id="dynamic-menu"></ul>
    <script src="js/menu.js"></script>
	<!-- Navigation Menu -->
    <div class="header-main-nav">
      <ul>
        <li><div class="highlight">&#x23AF</div><a href="./index.php" target="_parent">Home</a></li>
        <li><div class="highlight">&#x23AF</div><a href="./testimonies.php" target="_parent">Testimonies</a></li>
        <li><div class="highlight">&#x23AF</div><a href="./facility.php" target="_parent">Facility</a></li>
        <li><div class="highlight">&#x23AF</div><a href="./contact.php" target="_parent">Contact</a></li>
        <?php if ($loggedin === true): ?>
          <li><div class="highlight">&#x23AF</div><a href="./likes.php">Likes</a></li>
          <li><div class="highlight">&#x23AF</div><a href="./portal.php">Account</a></li>
        <?php else: ?>
          <li><div class="highlight">&#x23AF</div><a href="./login.php">Login</a></li>
        <?php endif; ?>
      </ul>
    </div>
</header>	