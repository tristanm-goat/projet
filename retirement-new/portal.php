<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Login Page</title>
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="css/styles.css" />
  </head>
<body>
<?php include 'view/header.php'; ?>
<?php
  // Redirect to login if user is not logged in
  if ($loggedin !== true) {
      header("Location: login.php");
      exit();
  }
?>
<main>
  <!--  Account Portal -->
  <div class="account-portal-container">
      <aside class="account-portal-sidebar">
          <div class="sidebar-header">
              <h3>Options</h3>
          </div>
          <nav class="sidebar-nav">
              <a href="likes.php" class="sidebar-link">My Likes</a>
          </nav>
          <div class="sidebar-footer">
            <form action="php/user_logout.php" method="post">
                <button type="submit" class="logout-button">Log Out</button>
            </form>
          </div>
      </aside>
      <section class="account-portal-content">
          <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? 'User'); ?>!</h2>
          <p>This is your personal dashboard. From here, you can manage your account settings, view your saved facilities, and update your profile information.</p>
          <p>Select an option from the sidebar to get started.</p>
      </section>
  </div>
</main>
  <!-- Footer Section -->
<?php include 'view/footer.php'; ?>
</body>
</html>