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
	<!-- Mapbox CSS -->
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">

	<style>
		#map { width: 100%; height: 400px; margin-top: 20px; }
	</style>
</head>
<body>

<header>
	<!-- Logo Section -->
    <div class="logo-section">
      <img src="img/logo-png.png"  alt="LifeMap Logo" class="company-logo" />
      <span class="company-name" >Life</span><span class="company-name2">Map</span>
    </div>

	<!-- Navigation Menu -->
    <div class="main-nav">
      <ul>
        <li> <div class="highlight">&#x23AF</div><a href="index.php">Home</a></li>
        <li><div class="highlight">&#x23AF</div><a href="testimonies.php">Testimonies</a></li>
        <li class="active"><div class="highlight">&#x23AF</div><a href="facility.php">Facility</a></li>
        <li><div class="highlight">&#x23AF</div><a href="contact.php">Contact</a></li>
		<li><div class="highlight">&#x23AF</div><a id="login" href="login.php">Login</a></li>
		<li><a id="likes"></a></li>
      </ul>
    </div>
  </header>	
<!-- Separator Black Line -->
  	<div class="seperator-line"></div>


<!-- Main Content Section -->
	<main>
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
		<h1>Hello</h1>
		<div id="nearest-facility"></div>
	</div>
	<!-- Map Display Section -->
	<div class="map-container">
		<h1>Hello</h1>
		<div id="map"></div>
	</div>
</div>
</main>
	<!-- Footer Section -->
	<footer>
		<div class="seperator-line"></div>
		<p>&copy; Group Retirement Home</p>
	</footer>


<!-- Javascript Section -->
<script>
  // Check if user is logged in
  let userisloggedin = localStorage.getItem("userloggedin");
  if (userisloggedin == "true") {
	  document.getElementById("login").innerText = "Account";
	  document.getElementById("login").href = "portal.php";
	  document.getElementById("likes").innerHTML = '<div class="highlight">&#x23AF</div><a href="likes.php">Likes</a>';
  } else {;
  }
</script>

<script src="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.js"></script>
<script>
const mapboxToken = "pk.eyJ1IjoibWNocmUwOTEiLCJhIjoiY21mcXhkZDAxMDNrczJycTQ3bnlweWsyMiJ9.EA6nnyDT-4cqAWQLzjtKVQ";
const tilesetId = "mchre091.9oel5st2";
let map, userMarker;

function loadGeolocation() {
	if ("geolocation" in navigator) {
		navigator.geolocation.getCurrentPosition(function(position) {
			const lat = position.coords.latitude;
			const lon = position.coords.longitude;
			document.getElementById("location").value = lat + ", " + lon;
			document.getElementById("current-location").innerHTML = "Latitude: " + lat + ", Longitude: " + lon;
		});
	}
}

document.addEventListener("DOMContentLoaded", function() {
	loadGeolocation();

	document.getElementById("location-form").addEventListener("submit", function(e) {
		e.preventDefault();
		const location = document.getElementById("location").value.split(",");
		const ylocation = location[0].trim();
		const xlocation = location[1].trim();
		const xhr = new XMLHttpRequest();
		xhr.open("POST", "find-nearest.php", true);
		xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
		xhr.onreadystatechange = function() {
			if (xhr.readyState === 4 && xhr.status === 200) {
				document.getElementById("nearest-facility").innerHTML = xhr.responseText;

				// Extract coordinates from the response
				const yMatch = xhr.responseText.match(/let y_location = '([^']+)'/);
				const xMatch = xhr.responseText.match(/let x_location = '([^']+)'/);
				if (yMatch && xMatch) {
					const lat = yMatch[1];
					const lon = xMatch[1];
					initializeMap(lat, lon); // Pass coordinates to initializeMap
					addFacilityMarker(lat, lon);
				}
			}
		};
		xhr.send("location-y=" + encodeURIComponent(ylocation) + "&location-x=" + encodeURIComponent(xlocation));
	});
});

// Update initializeMap to accept coordinates
function initializeMap(lat, lon) {
	mapboxgl.accessToken = mapboxToken;
	map = new mapboxgl.Map({
		container: 'map',
		style: 'mapbox://styles/mapbox/streets-v11',
		center: [parseFloat(lon), parseFloat(lat)], // Center on facility
		zoom: 13
	});
	//add user location marker as before
	if (navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(function(position) {
			const userLocation = [position.coords.longitude, position.coords.latitude];
			userMarker = new mapboxgl.Marker({ color: 'blue' })
				.setLngLat(userLocation)
				.setPopup(new mapboxgl.Popup().setText("You are here"))
				.addTo(map);
		});
	}
}

function addFacilityMarker(lat, lon) {
    if (!map) return;
    new mapboxgl.Marker({ color: 'red' })
        .setLngLat([parseFloat(lon), parseFloat(lat)])
        .setPopup(new mapboxgl.Popup().setText("Nearest Facility"))
        .addTo(map);
}
</script>
</body>
</html>
