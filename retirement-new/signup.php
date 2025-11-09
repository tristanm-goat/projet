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
      <form action="php/user_signup.php" method="post">
              <input type="text" id="username" name="username" placeholder="Username" required /><br>
              <input type="password" id="password" name="password" placeholder="Password" required /><br>
              <button type="submit">Sign Up</button>
      </form>
    </div>
</div>

  <!-- Footer Section -->
<?php include 'view/footer.php'; ?>
</body>

<script>
  // You can also use JavaScript to show an alert if you prefer that over an inline message.
  document.addEventListener('DOMContentLoaded', (event) => {
    const params = new URLSearchParams(window.location.search);
    if (params.has('error') && params.get('error') === 'username_exists') {
      alert('Username already exists. Please choose a different one.');
      // Optional: remove the error from the URL without reloading the page
      window.history.replaceState({}, document.title, window.location.pathname);
    }
  });
</script>
</html>