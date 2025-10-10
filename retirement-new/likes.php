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
<body>
<?php include 'view/header.php'; ?>

<!--  Likes Page -->
 <div class="account-portal-body">
    <div class="account-portal-container">
      <h2>Your Liked Retirement Homes</h2>
      <p>Here's a list of the facilities you've marked as favorites. Click on any item to view its full details.</p>

      <div class="liked-facilities-section">
        <ul class="liked-facility-list">
            <li class="liked-facility-item">
                <h3>Sunny Meadows Retirement Community</h3>
                <p><strong>Address:</strong> 123 Golden Years Ave, Pleasantville</p>
                <p>A vibrant community with a wide range of activities and excellent care services.</p>
            </li>
            <li class="liked-facility-item">
                <h3>Lakeside Manor</h3>
                <p><strong>Address:</strong> 456 Serenity Rd, Waterview</p>
                <p>Enjoy beautiful lake views and a peaceful environment with top-notch amenities.</p>
            </li>
            <li class="liked-facility-item">
                <h3>The Oaks Assisted Living</h3>
                <p><strong>Address:</strong> 789 Liberty Ln, Freedom Town</p>
                <p>Personalized care plans in a supportive and friendly atmosphere.</p>
            </li>
            <!-- More liked facilities can be added here dynamically -->
        </ul>
      </div>
      <!-- The logout button is typically in the main account portal or header, not specifically on the likes page. -->
      </div>
</div>
  <!-- Footer Section -->
<?php include 'view/footer.php'; ?>

<script>
  let userisloggedin = localStorage.getItem("userloggedin");
  if (userisloggedin == "true") {
      console.log("Access granted to portal.");
    document.getElementById("login").innerText = "Account";
	  document.getElementById("login").href = "portal.php";
	  document.getElementById("likes").innerHTML = '<div class="highlight">&#x23AF</div><a href="likes.php">Likes</a>';
  } else {
      window.location.href = 'login.php';
  }
</script>
</body>
</html>