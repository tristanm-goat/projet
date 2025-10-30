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

<!--  Account Portal -->
 <div class="account-portal-body">
      <div class="account-portal-settings">
      <h3>Account Settings</h3>
      <ul class="settings-list">
        <li class="settings"><a href="#">Change Password</a></li>
        <li class="settings"><a href="#">Update Email</a></li>
        <li class="settings"><a href="#">Privacy Settings</a></li>
      </ul>
</div>
    <div class="account-portal-container">
      <h2>Welcome to Your Account Portal</h2>
      <p>This is a placeholder for the account portal content.</p>
      <form action="php/user_logout.php" method="post">
        <button type="logout">Log Out</button>
      </form>
      </div>
</div>
  <!-- Footer Section -->
<?php include 'view/footer.php'; ?>
</body>
</html>