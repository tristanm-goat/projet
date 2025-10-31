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
<div class="menu-open" style="opacity: 100%; background-color: white;">
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
                alert('Setting user default location');
                userLatitude = 45.4231;
                userLongitude = -75.6971;
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
</html>
