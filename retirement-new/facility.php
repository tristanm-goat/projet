<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Web Application</title>
	<!-- Google Fonts -->
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<?php include 'view/header.php'; ?>
<!-- Main Content Section -->
	<main class="facility-container">
		<form id="location-form" method="post">
			<label for="location">Address</label>
			<input type="text" id="location" name="location" required>
			<input type="submit" value="Search" id="search-button">

			<label for="location">Filter</label>
			<input type="text" id="location" name="location" required>
			<input type="submit" value="Search" id="search-button">
		</form>
		<br>
		<div class="seperator-line"></div>
<div class="facility-content">


	<!-- Table Display Section -->
	<div class="table-container">
		<h1>List</h1>
		<?php include 'view/list.php'; ?>
	</div>
	<!-- Map Display Section -->
	<div class="map-container">
		<h1>Map</h1>
			<?php include 'view/map.php'; ?>
	</div>
</div>
</main>
	<!-- Footer Section -->
<?php include 'view/footer.php'; ?>
</body>


<!-- Javascript Section -->
<script>
  let userisloggedin = localStorage.getItem("userloggedin");
  if (userisloggedin == "true") {
	  document.getElementById("login").innerText = "Account";
	  document.getElementById("login").href = "portal.php";
	  document.getElementById("likes").innerHTML = '<div class="highlight">&#x23AF</div><a href="likes.php">Likes</a>';
  } else {;
  }
</script>
</html>
