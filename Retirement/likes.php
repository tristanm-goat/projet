<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Likes</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css" />
  </head>
<body­>
<header>
  <!-- Logo Section -->
    <div class="logo-section">
      <img src="img/logo-png.png"  alt="LifeMap Logo" class="company-logo" />
      <span class="company-name" >Life</span><span class="company-name2">Map</span>
    </div>

  <!-- Navigation Menu -->
       <div class="main-nav">
      <ul>
        <li><div class="highlight">&#x23AF</div><a href="index.php">Home</a></li>
        <li><div class="highlight">&#x23AF</div><a href="about.php">About</a></li>
        <li><div class="highlight">&#x23AF</div><a href="services.php">Services</a></li>
        <li><div class="highlight">&#x23AF</div><a href="facility.php">Facility</a></li>
        <li><div class="highlight">&#x23AF</div><a href="contact.php">Contact</a></li>
		    <li><div class="highlight">&#x23AF</div><a href="login.php">Account</a></li>
        <li class="active"><div class="highlight">&#x23AF</div><a href="likes.php">Likes</a></li>
      </ul>
    </div>
  </header>
<!-- Separator Black Line -->
    <div class="seperator-line"></div>

<!--  Account Portal -->
 <div class="account-portal-body">
      <div class="account-portal-settings">
      <h3>Account Settings</h3>
      <ul class="settings-list">
        <li class="settings"><a href="#">Change Password</a></li>
        <li class="settings"><a href="#">Update Email</a></li>
        <li class="settings"><a href="#">Manage Subscriptions</a></li>
        <li class="settings"><a href="#">Privacy Settings</a></li>
      </ul>
</div>
    <div class="account-portal-container">
      <h2>View your likes</h2>
      <p>This is a placeholder for the account portal content.</p>
      <p>You can manage your profile, view services, and access other features here.</p>
      <button type="logout" onclick="window.location.href='login.php'">Log Out</button>
      </div>
</div>
  <!-- Footer Section -->
  <footer>
    <p>&copy; 2024 LifeMap. All rights reserved.</p> 
  </footer>
</body>

<script>
  let userisloggedin = localStorage.getItem("userloggedin");
  if (userisloggedin == "true") {
      console.log("Access granted to portal.");
  } else {
      window.location.href = 'login.php';
  }
</script>
</html>