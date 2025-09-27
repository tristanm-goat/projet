<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Web Application</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Open+Sans:400,600" />
    <link rel="stylesheet" href="css/all.min.css" />
    <link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="css/templatemo-style.css" />
	<!-- Mapbox CSS -->
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
	<style>
		#map { width: 100%; height: 400px; margin-top: 20px; }
	</style>
</head>
<body>
    <div class="parallax-window" data-parallax="scroll" data-image-src="img/bg-01.jpg">
      <div class="container-fluid">
        <div class="row tm-brand-row">
          <div class="col-lg-4 col-11">
            <div class="tm-brand-container tm-bg-white-transparent" style="outline: 4px solid #3aaed8; border-radius: 2px;">
              <i class="fas fa-2x fa-pen tm-brand-icon"></i>
              
              <div class="tm-brand-texts">
              <h1 class="text-uppercase tm-brand-name">Lifemap</h1>
              <p class="small">Plateforme pour résidences pour aînés</p>
              </div>
            </div>
          </div>
          <div class="col-lg-8 col-1">
            <div class="tm-nav">
                <nav class="navbar navbar-expand-lg navbar-light tm-bg-white-transparent tm-navbar" style="outline: 2px solid #3aaed8; border-radius: 4px;">
                <button class="navbar-toggler" type="button"
                  data-toggle="collapse" data-target="#navbarNav"
                  aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav">
                    <li class="nav-item">
                      <div class="tm-nav-link-highlight"></div>
                      <a class="nav-link" href="index.html">Home <span class="sr-only">(current)</span></a>
                    </li>
                    <li class="nav-item">
                      <div class="tm-nav-link-highlight"></div>
                      <a class="nav-link" href="about.html">About</a>
                    </li>
                    <li class="nav-item">
                      <div class="tm-nav-link-highlight"></div>
                      <a class="nav-link" href="services.html">Services</a>
                    </li>
                    <li id="facility-header-btn" class="nav-item active">
                      <div class="tm-nav-link-highlight"></div>
                      <a class="nav-link" href="facilityfinder.php">Facility</a>
                    </li>
                    <li class="nav-item">
                      <div class="tm-nav-link-highlight"></div>
                      <a class="nav-link" href="contact.html">Contact</a>
                    </li>
                  </ul>
                </div>
              </nav>
            </div>
          </div>
        </div>
	<main>
		<form id="location-form" method="post">
			<label for="location">Enter your location:</label>
			<input type="text" id="location" name="location" required>
			<input type="submit" value="Find Facility">
			<br>
		</form>
		<h2>Current Location</h2>
		<p id="current-location">Fetching location...</p><br>
		<p id="nearest-facility-title">Nearest Facility Information:</p>
		<div id="nearest-facility"></div>
		<div id="map"></div>
	</main>

	<footer>
		<p>&copy; Group Retirement Home</p>
	</footer>
	<!-- Mapbox JS -->
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

			// Initialize Mapbox map
			mapboxgl.accessToken = mapboxToken;
			map = new mapboxgl.Map({
				container: 'map',
				style: 'mapbox://styles/mapbox/streets-v11',
				center: [lon, lat],
				zoom: 12
			});

			// Add custom tileset as a layer
			map.on('load', function () {
				map.addSource('custom-tileset', {
					'type': 'vector',
					'url': 'mapbox://' + tilesetId
				});
			});

			// Add user location marker
			userMarker = new mapboxgl.Marker({ color: 'red' })
				.setLngLat([lon, lat])
				.addTo(map);
		});
	}
}

document.addEventListener("DOMContentLoaded", function() {
	// Automatically load geolocation on page load
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
			}
		};
		xhr.send("location-y=" + encodeURIComponent(ylocation) + "&location-x=" + encodeURIComponent(xlocation));
	});
});
</script>
</body>
</html>
