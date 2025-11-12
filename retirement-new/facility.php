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
    <!-- Mapbox Search Box -->
    <link href="https://api.mapbox.com/search-js/v1.0.0-beta.18/dist/mapbox-search-box.css" rel="stylesheet">
    <script src="https://api.mapbox.com/search-js/v1.0.0-beta.18/web.js"></script>
    <script src="https://api.mapbox.com/mapbox-gl-js/v3.4.0/mapbox-gl.js"></script>
    <link rel="stylesheet" href="css/styles.css" />
</head>
<body>
<?php include 'view/header.php'; ?>

<style>
    .service-filters {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 10px;
        margin-top: 15px;
        margin-bottom: 15px;
    }
    .service-filter-item {
        display: flex;
        flex-direction: column;
    }
</style>

<!-- Main Content Section -->
<main class="facility-container">
        <form id="facility-search-form" onsubmit="return false;">
            <div id="address-autofill-container"></div><br>
            <button type="button" id="use-location-btn">Use My Location</button>
            <button type="submit" id="search-button" disabled>Search</button>
            <select type="filter_lic" id="filter_lic">Filter
                <option value="Issued">Issued</option>
                <option value="Application_received">Application Received</option>
                <option value="Withdrawn">Withdrawn</option>
                <option value="Terminated">Terminated</option>
            </select>

            <div class="service-filters">
                <?php
                $services = [
                    'assistance_with_bathing' => 'Assistance with Bathing',
                    'assistance_with_personal_hygiene' => 'Personal Hygiene',
                    'assistance_with_ambulation' => 'Ambulation Assistance',
                    'assistance_with_feeding' => 'Feeding Assistance',
                    'provision_of_skin_and_wound_care' => 'Skin and Wound Care',
                    'continence_care' => 'Continence Care',
                    'administration_of_drugs_or_another_substance' => 'Medication Admin',
                    'provision_of_a_meal' => 'Meal Provision',
                    'dementia_care_program' => 'Dementia Care',
                    'assistance_with_dressing' => 'Dressing Assistance',
                    'pharmacists_provides_while_engaging_in_the_practice_of_pharmacy' => 'Pharmacist Services',
                    'phy_and_surg_provides_while_engaging_in_the_practice_of_medicine' => 'Physician Services',
                    'nurses_provides_while_engaging_in_the_practice_of_nursing' => 'Nursing Services',
                ];

                foreach ($services as $key => $description) {
                    echo '<div class="service-filter-item">';
                    echo '<label for="' . $key . '" style="font-size: 0.9rem; font-weight: normal; color: #333;">' . htmlspecialchars($description) . '</label>';
                    echo '<select id="' . $key . '" name="services[' . $key . ']">';
                    echo '<option value="" selected>Any</option>';
                    echo '<option value="TRUE">Yes</option>';
                    echo '<option value="FALSE">No</option>';
                    echo '</select>';
                    echo '</div>';
                }
                ?>
            </div>
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
    // mapbox token
    const mapboxAccessToken = 'pk.eyJ1IjoibWNocmUwOTEiLCJhIjoiY21mcXhkZDAxMDNrczJycTQ3bnlweWsyMiJ9.EA6nnyDT-4cqAWQLzjtKVQ';
    let markers = []; 


// slider
var slider = document.getElementById("filter_asc");
var output = document.getElementById("slider");
output.innerHTML = slider.value;

slider.oninput = function() {
  output.innerHTML = this.value;
}

    // Initialize Mapbox Search Box for address autofill
    document.addEventListener('DOMContentLoaded', () => {
        const searchBox = new MapboxSearchBox();
        searchBox.accessToken = mapboxAccessToken;
        searchBox.options = {
            language: 'en',
            country: 'CA',
            // Bounding box for Ontario to bias and limit results
            bbox: [-95.15625, 41.676555, -74.335938, 56.851383] 
        };

        searchBox.addEventListener('retrieve', (event) => {
            const [lng, lat] = event.detail.features[0].geometry.coordinates;
            userLatitude = lat;
            userLongitude = lng;
            // Enable search button now that we have coordinates
            document.getElementById('search-button').disabled = false;
        });

        document.getElementById('address-autofill-container').appendChild(searchBox);
    });


// Location Button Listener
    document.getElementById('use-location-btn').addEventListener('click', function() {
        const setDefaultLocation = () => {
            userLatitude = 45.4231; // Ottawa Latitude
            userLongitude = -75.6971; // Ottawa Longitude
            document.getElementById('search-button').disabled = false;
            document.querySelector('#address-autofill-container input[type="text"]').value = 'Ottawa, ON';
            alert('Could not get your location. Defaulting to Ottawa, ON. Click "Search" to find facilities.');
        };

        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition((position) => {
                userLatitude = position.coords.latitude;
                userLongitude = position.coords.longitude;
                document.getElementById('search-button').disabled = false;
                // Visually confirm to the user what was found
                document.querySelector('#address-autofill-container input[type="text"]').value = `My Location (${userLatitude.toFixed(4)}, ${userLongitude.toFixed(4)})`;
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
        // Coordinates are set either by the autofill or 'Use My Location' button
        if (userLatitude && userLongitude) {
            fetchFacilities(userLatitude, userLongitude);
        } else {
            alert('Please select an address or use your location first.');
        }
    });

    function fetchFacilities(lat, lon) {
        const listContainer = document.querySelector('.table-container .facility-list');
        let filterSelection = document.getElementById('filter_lic').value;
        let amountSelection = document.getElementById('filter_asc').value;

        // collects the form data to send over to the find-facilities.php file to process the data
        listContainer.innerHTML = '<li>Loading...</li>';
        const formData = new FormData();
        formData.append('latitude', lat);
        formData.append('longitude', lon);
        formData.append('license_filter', filterSelection);
        formData.append('asc_filter', amountSelection);

        // Append service filters
        const serviceFilters = document.querySelectorAll('.service-filters select');
        serviceFilters.forEach(select => {
            if (select.value) { // Only send if a selection other than "Any" is made
                formData.append(select.name, select.value);
            }
        });

        fetch('php/find-facilities.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            listContainer.innerHTML = data.html;
            updateMap(data.locations, lat, lon);
        });
    }

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
