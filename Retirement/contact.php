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
        <li> <div class="highlight">---------</div>
      <a href="index.html">Home</a>
    </li>
        <li><div class="highlight">---------</div><a href="about.html">About</a></li>
        <li><div class="highlight">---------</div><a href="services.html">Services</a></li>
        <li><div class="highlight">---------</div><a href="facilityfinder.php">Facility</a></li>
        <li><div class="highlight">---------</div><a href="contact.php">Contact</a></li>
    <li class="active"><div class="highlight">---------</div><a href="contact.php">Login</a></li>
      </ul>
    </div>
  </header>
<!-- Separator Black Line -->
    <div class="seperator-line"></div>


    <div class="login-container">
      <h2>Login</h2>
      <form action="process_login.php" method="post">
      <table>
        <tr>
           <th>
               <label for="username">Username:</label>
           </th>
           <th>
              <input type="text" id="username" name="username" required />
            </th>
        </tr>
        <tr>
          <th>
        <label for="password">Password:</label>
          </th>
          <th>
        <input type="text" id="password" name="password" required />
          </th>
        <input type="submit" value="Login" />
      
      </table>  
      </form>
    </div>

  <!-- Footer Section -->
  <footer>
    <p>&copy; 2024 LifeMap. All rights reserved.</p> 
  </footer>
</body>
</html>