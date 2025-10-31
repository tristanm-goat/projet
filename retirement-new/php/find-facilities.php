<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['latitude']) || !isset($_POST['longitude'])) {
    http_response_code(400);
    echo '<li class="facility-item"><p>Error: Invalid request.</p></li>';
    exit;
}

$user_lat = $_POST['latitude'];
$user_lon = $_POST['longitude'];

$host="mchre091.duckdns.org:3306";
$username="mchre091";
$password="admin";
$dbname = "ontario_facility_rhra";

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    // In a real application, you would log this error, not display it to the user.
    echo '<li class="facility-item"><p>Error connecting to the database.</p></li>';
    exit;
}

// --- Haversine Formula Query ---
// This query calculates the distance between the user and each facility, ordering by the closest.
// It assumes your table is `rhra_entries_detailed` with columns `name` and `latlng`.
// The number 6371 is the Earth's radius in kilometers.
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
ORDER BY distance ASC
LIMIT 10
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ddd", $user_lat, $user_lon, $user_lat);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $facility_id = $row['id']; 
        echo '<li class="facility-item">';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p><strong>Distance:</strong> ' . round($row['distance'], 2) . ' km away</p>';
        echo '<div class="facility-options">';
        echo '  <button type="button" class="option-save-button" data-facility-id="' . htmlspecialchars($facility_id) . '" data-option="1">Save to 1</button>';
        echo '  <button type="button" class="option-save-button" data-facility-id="' . htmlspecialchars($facility_id) . '" data-option="2">Save to 2</button>';
        echo '  <button type="button" class="option-save-button" data-facility-id="' . htmlspecialchars($facility_id) . '" data-option="3">Save to 3</button>';
        echo '</div>';
        echo '</li>';
    }
} else {
    echo '<li class="facility-item"><p>No facilities found nearby.</p></li>';
}

$stmt->close();
$conn->close();
?>