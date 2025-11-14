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

<!-- Login pop-up-->
 <div class="login-body">
    <div class="login-container">
      <h2>Sign-up Form</h2>
      <?php if (isset($_GET['error']) && $_GET['error'] === 'username_exists'): ?>
        <div class="error-message">
            <p>Username already exists</p>
        </div>
      <?php endif; ?>
      <form id="signupForm" method="post" action="php/user_signup.php" novalidate>
              <label for="username">Username</label>
              <input id="username" name="username" type="text" required>

              <label for="password">Password</label>
              <input id="password" name="password" type="password" required>

              <div id="signupErrors" aria-live="polite" style="color:#b00020; margin-top:8px;"></div>

              <button type="submit">Create account</button>
      </form>
    </div>
</div>

  <!-- Footer Section -->
<?php include 'view/footer.php'; ?>
</body>

<script>
  // login error
  document.addEventListener('DOMContentLoaded', (event) => {
    const params = new URLSearchParams(window.location.search);
    if (params.has('error') && params.get('error') === 'username_exists') {
      alert('Username already exists. Please choose a different one.');
      // Optional: remove the error from the URL without reloading the page
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  });
</script>
<!-- include validation script -->
<script src="js/signup_validation.js"></script>
</html>