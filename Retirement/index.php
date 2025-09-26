<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>PHP Web Application</title>
	<link rel="stylesheet" href="styles.css">
	<!-- Mapbox CSS -->
	<link href="https://api.mapbox.com/mapbox-gl-js/v2.15.0/mapbox-gl.css" rel="stylesheet">
	<style>
		#map { width: 100%; height: 400px; margin-top: 20px; }
	</style>
</head>
<body>
	<header>
	<div class="header">
		<h1>Retirement Home Plan</h1>
	</div>
	</header>

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
	
	document.addEventListener("DOMContentLoaded", function() {
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
	function addFacilityMarker() {
			RetirementMarker = new mapboxgl.Marker({ color: 'blue' })
					.setLngLat([y_location, x_location])
					.addTo(map);
		}

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
