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
        <li><div class="highlight">&#x23AF</div><a href="testimonies.php">Testimonies</a></li>
        <li><div class="highlight">&#x23AF</div><a href="facility.php">Facility</a></li>
        <li><div class="highlight">&#x23AF</div><a href="contact.php">Contact</a></li>
		    <li class="active"><div class="highlight">&#x23AF</div><a href="login.php">Login</a></li>
      </ul>
    </div>
  </header>
<!-- Separator Black Line -->
    <div class="seperator-line"></div>

<!-- Login pop-up-->
 <div class="login-body">
    <div class="login-container">
      <h2>Sign-in</h2>
      <form action="process_login.php" method="post">
      <table>
        <tr>
           <th><input type="text" id="username" name="username" placeholder="Username, E-mail, Phone Number" required /></th>
        </tr>
        <tr>
          <th><input type="text" id="password" name="password" placeholder="Password" required /></th>
        </tr>
      </table>  
      <button type="signin" id="signin">Sign In</button>
      <button type="signup" onclick="window.location.href='signup.php'">Sign Up</button>
      </form>
    </div>
</div>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2024 LifeMap. All rights reserved.</p> 
  </footer>

  <script>
    let userloggedin = false;

    document.getElementById("signin").addEventListener("click", function(event) {
        localStorage.setItem("userloggedin", true);
        window.location.href = 'portal.php';
    });
    </script>
</body>
</html>