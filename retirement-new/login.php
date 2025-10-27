<!DOCTYPE html>
<?php
session_start();
?>
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

<!-- Login pop-up-->
 <div class="login-body">
    <div class="login-container">
      <h2>Sign-in</h2>
      <form action="php/user_login.php" method="post">
                <input type="text" id="username" name="username" placeholder="Username, E-mail, Phone Number" required /><br>
                <input type="password" id="password" name="password" placeholder="Password" required /> <br>
      <button type="submit" id="signin">Sign In</button>
      <button type="signup" onclick="window.location.href='signup.php'">Sign Up</button>
      </form>
    </div>
</div>

  <!-- Footer Section -->
<?php include 'view/footer.php'; ?>

</body>
</html>