<?php
session_start();

// check if all variables are defined to fufill the request
if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['latitude']) || !isset($_POST['longitude'])) {
    http_response_code(400);
    echo '<li class="facility-item"><p>Error: Invalid request.</p></li>';
    exit;
}

// Fetch user coordinates to calculate
$user_lat = $_POST['latitude'];
$user_lon = $_POST['longitude'];
$lic_filter = $_POST['license_filter'];
$asc_filter = (int)$_POST['asc_filter'];

// Database connection
$host="mchre091.duckdns.org:3306";
$username="mchre091";
$password="admin";
$dbname = "ontario_facility_rhra";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    echo '<li class="facility-item"><p>Error connecting to the database.</p></li>';
    exit;
}

// Base SQL query with Haversine formula for distance calculation
$sql = "
SELECT *, (
    6371 * acos(
        cos(radians(?)) *
        cos(radians(SUBSTRING_INDEX(latlng, ',', 1))) *
        cos(radians(SUBSTRING_INDEX(latlng, ',', -1)) - radians(?)) +
        sin(radians(?)) *
        sin(radians(SUBSTRING_INDEX(latlng, ',', 1)))
    )
) AS distance
FROM rhra_entries_detailed
WHERE lic_status = ?
";
$sql .= "ORDER BY distance ASC LIMIT ?";

// Database parsing the request "ddd" being a double floating point number
// It prepares the request (which is defined as the Haversine formula)
// user lat, user lon and user lat2 will replace the ? in the request
// then it will execute the sql request (this format is to prevent sql injection)
// then fetch results
$stmt = $conn->prepare($sql);
$stmt->bind_param("dddsi", $user_lat, $user_lon, $user_lat, $lic_filter, $asc_filter);
$stmt->execute();
$result = $stmt->get_result();

//predefining variables
$html_output = '';
$locations = [];

// for each results, it will display a line of code, up to 10 for now (can change it by changing ASC LIMIT *)
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $facility_id = $row['id'];
        $html_output .= '<li class="facility-item">';
        $html_output .= '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        $html_output .= '<p><strong>Distance:</strong> ' . round($row['distance'], 2) . ' km away</p>';
        $html_output .= '<div class="facility-options">';

        // When user presses button, adds field in database on facility id
        // needed for the Likes feature : stores the facility_id in the account database to reference and show the likes of the user
        $html_output .= '  <button type="button" class="option-save-button" data-facility-id="' . htmlspecialchars($facility_id) . '" data-option="1">Save to 1</button>';
        $html_output .= '  <button type="button" class="option-save-button" data-facility-id="' . htmlspecialchars($facility_id) . '" data-option="2">Save to 2</button>';
        $html_output .= '  <button type="button" class="option-save-button" data-facility-id="' . htmlspecialchars($facility_id) . '" data-option="3">Save to 3</button>';
        $html_output .= '</div>';
        $html_output .= '</li>';

        // Add location data for the map
        list($lat, $lng) = explode(',', $row['latlng']);
        $locations[] = [
            'name' => $row['name'],
            'lat' => (float)$lat,
            'lng' => (float)$lng
        ];
    }
} else {
    $html_output = '<li class="facility-item"><p>No facilities found nearby.</p></li>';
}

$stmt->close();
$conn->close();

header('Content-Type: application/json');
echo json_encode(['html' => $html_output, 'locations' => $locations]);
?>