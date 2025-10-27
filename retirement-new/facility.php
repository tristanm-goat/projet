<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Facility</title>
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
		<form id="location-form" onsubmit="return false;">
			<button type="button" id="use-location-btn">Use My Location</button>
			<button type="submit" id="search-button">Search</button>
		</form>
		<br>
		<div class="seperator-line"></div>
<div class="facility-content">


	<!-- Table Display Section -->
	<div class="table-container">
		<h1>Nearby Facilities</h1>
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
    let userLatitude = null;
    let userLongitude = null;

    document.getElementById('use-location-btn').addEventListener('click', function() {
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(function(position) {
                userLatitude = position.coords.latitude;
                userLongitude = position.coords.longitude;
                alert('Location captured! Click "Search" to find nearby facilities.');
                document.getElementById('search-button').disabled = false;
            }, function(error) {
                alert('Error getting location: ' + error.message);
            });
        } else {
            alert('Geolocation is not supported by this browser.');
        }
    });

    document.getElementById('location-form').addEventListener('submit', function(event) {
        event.preventDefault();
        if (userLatitude === null || userLongitude === null) {
            alert('Please use the "Use My Location" button first to get your coordinates.');
            return;
        }

        const listContainer = document.querySelector('.table-container .facility-list');
        listContainer.innerHTML = '<li>Loading...</li>';

        const formData = new FormData();
        formData.append('latitude', userLatitude);
        formData.append('longitude', userLongitude);

        fetch('php/find-facilities.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            listContainer.innerHTML = data;
        });
    });
</script>
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
