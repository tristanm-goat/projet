<?php

if ($_SERVER['REQUEST_METHOD'] !== 'POST' || !isset($_POST['latitude']) || !isset($_POST['longitude'])) {
    http_response_code(400);
    echo '<li class="facility-item"><p>Error: Invalid request.</p></li>';
    exit;
}

$user_lat = $_POST['latitude'];
$user_lon = $_POST['longitude'];

// --- Database Connection ---
// IMPORTANT: Replace with your actual database credentials.
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ontario_facility_rhra";

$conn = new mysqli($servername, $username, $password, $dbname);

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
LIMIT 3
";

$stmt = $conn->prepare($sql);
$stmt->bind_param("ddd", $user_lat, $user_lon, $user_lat);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li class="facility-item">';
        echo '<span class="like-icon">&hearts;</span>';
        echo '<h3>' . htmlspecialchars($row['name']) . '</h3>';
        echo '<p><strong>Distance:</strong> ' . round($row['distance'], 2) . ' km away</p>';
        // You can add more details here if they exist in your table, like address.
        echo '</li>';
    }
} else {
    echo '<li class="facility-item"><p>No facilities found nearby.</p></li>';
}

$stmt->close();
$conn->close();