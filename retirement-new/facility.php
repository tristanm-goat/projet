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
    <!-- Mapbox GL JS -->
    <link href="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.css" rel="stylesheet">
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<?php include 'view/header.php'; ?>

<!-- Main Content Section -->
<main class="facility-container">
        <form id="facility-search-form" onsubmit="return false;">
            <button type="button" id="use-location-btn">Use My Location</button>
            <button type="submit" id="search-button" disabled>Search</button>
            <select type="filter_lic" id="filter_lic">Filter
                <option value="Issued">Issued</option>
                <option value="Application_received">Application Received</option>
                <option value="Withdrawn">Withdrawn</option>
                <option value="Terminated">Terminated</option>
            </select>
        </form>
        <p>Home Count Search: <span id="slider"></span> <input type="range" min="1" max="50" value="10" class="slider" id="filter_asc"></p>
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
</main>

	<!-- Footer Section -->
<?php include 'view/footer.php'; ?>
</body>


<script>
    let userLatitude = null;
    let userLongitude = null;
    let map = null; 
    let markers = []; 


// slider
var slider = document.getElementById("filter_asc");
var output = document.getElementById("slider");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}

// Location Button Listener
    document.getElementById('use-location-btn').addEventListener('click', function() {
        const setDefaultLocation = () => {
            userLatitude = 45.4231; // Ottawa Latitude
            userLongitude = -75.6971; // Ottawa Longitude
            document.getElementById('search-button').disabled = false;
            alert('Could not get your location. Defaulting to Ottawa, ON. Click "Search" to find facilities.');
        };

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                userLatitude = position.coords.latitude;
                userLongitude = position.coords.longitude;
                document.getElementById('search-button').disabled = false;
                alert('Location found! Click "Search" to find facilities.');
            }, (error) => {
                console.error(`Geolocation error: ${error.message}`);
                setDefaultLocation();
            });
        } else {
            alert('Geolocation is not supported by your browser.');
            setDefaultLocation();
        }
    });

// Search Button Listener
    document.getElementById('search-button').addEventListener('click', function() {
        const listContainer = document.querySelector('.table-container .facility-list');
        // get Filter data
        let filterSelection = document.getElementById('filter_lic').value;
        // get amount of homes seen data
        let amountSelection = document.getElementById('filter_asc').value;
        console.log(amountSelection);
        console.log(filterSelection);
        console.log(userLatitude);
        console.log(userLongitude);

        listContainer.innerHTML = '<li>Loading...</li>';
        const formData = new FormData();
        formData.append('latitude', userLatitude);
        formData.append('longitude', userLongitude);
        formData.append('license_filter', filterSelection)
        formData.append('asc_filter', amountSelection)
        // send data to find-facilities.php

        fetch('php/find-facilities.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            listContainer.innerHTML = data.html;
            updateMap(data.locations, userLatitude, userLongitude);
        });
        });





// Save Facility Button
    // --- Logic for saving a facility to an option ---
    // Event delegation for the save buttons. We listen on the document to ensure
    // that clicks are captured even on dynamically added elements.
    document.addEventListener('click', function(event) {
        const saveButton = event.target.closest('.option-save-button');
        if (saveButton) {
            // Use the PHP variable from header.php to check login status
            const isLoggedIn = <?php echo json_encode($loggedin); ?>;
            if (!isLoggedIn) {
                alert('You must be logged in to save a facility.');
                window.location.href = 'login.php'; // Redirect to login page
                return;
            }

            const facilityId = saveButton.dataset.facilityId;
            const optionNumber = saveButton.dataset.option;

            const formData = new FormData();
            formData.append('facility_id', facilityId);
            formData.append('option_number', optionNumber);

            // Temporarily disable the button to prevent multiple clicks
            saveButton.disabled = true;
            saveButton.textContent = 'Saving...';

            fetch('php/save_like.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                alert(data.message);
                // Re-enable the button after the request is complete
                saveButton.disabled = false;
                saveButton.textContent = `Save to ${optionNumber}`;
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while saving your like.');
                // Re-enable the button on error
                saveButton.disabled = false;
                saveButton.textContent = `Save to ${optionNumber}`;
            });
        }
    });
</script>
<!-- Mapbox Script -->
<script src="js/mapbox_logic.js"></script>
</html>
