<html>
<body>
<?php
$ylocation = $_POST['location-y'];
$xlocation = $_POST['location-x'];

// Database connection
$servername = "localhost";
$username = "root";
$password = "*xU3;a)_U5BKjx.";
$dbname = "elderlydatabase";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Haversine formula in SQL to find the nearest "Seniors Active Living Centre"
$sql = "
SELECT *, (
    6371 * acos(
        cos(radians(?)) *
        cos(radians(Y)) *
        cos(radians(X) - radians(?)) +
        sin(radians(?)) *
        sin(radians(Y))
    )
) AS distance
FROM ministry_of_health_service_provider_locations
WHERE SERVICE_TYPE = ?
ORDER BY distance ASC
LIMIT 1
";

$serviceType = "Seniors Active Living Centre";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ddds", $ylocation, $xlocation, $ylocation, $serviceType);
$stmt->execute();
$result = $stmt->get_result();

if ($row = $result->fetch_assoc()) {
    $ylocation2 = $row['Y'];
    $xlocation2 = $row['X'];
    echo "Nearest Facility:<br>";
    echo "Name: " . htmlspecialchars($row['ENGLISH_NAME']) . "<br>";
    echo "Latitude: " . $row['Y'] . "<br>";
    echo "Longitude: " . $row['X'] . "<br>";
    echo "Distance: " . round($row['distance'], 2) . " km<br>";
    echo "Address: " . $row['ADDRESS_LINE_1'];
    echo "<script>let y_location = '$ylocation2';</script><br>";
    echo "<script>let x_location = '$xlocation2';</script>";
    echo "<script> addFacilityMarker(y_location, x_location);</script>";
} else {
    echo "No facilities found.";
}
$stmt->close();
$conn->close();
?>
</body>
</html>
