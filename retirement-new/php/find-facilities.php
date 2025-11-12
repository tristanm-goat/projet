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
$service_filters = isset($_POST['services']) ? $_POST['services'] : [];

include 'connection_retirement.php';
// Define a whitelist of allowed service columns to prevent SQL injection
$allowed_service_columns = [
    'assistance_with_bathing', 'assistance_with_personal_hygiene', 'assistance_with_ambulation',
    'assistance_with_feeding', 'provision_of_skin_and_wound_care', 'continence_care',
    'administration_of_drugs_or_another_substance', 'provision_of_a_meal', 'dementia_care_program',
    'assistance_with_dressing', 'pharmacists_provides_while_engaging_in_the_practice_of_pharmacy',
    'phy_and_surg_provides_while_engaging_in_the_practice_of_medicine', 'nurses_provides_while_engaging_in_the_practice_of_nursing'
];

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

//filtering values for the formula
$params = [$user_lat, $user_lon, $user_lat, $lic_filter];
$types = 'ddds';

//code for certain filter values
$where_clauses = [];
foreach ($service_filters as $column => $value) {
    if (in_array($column, $allowed_service_columns) && in_array($value, ['TRUE', 'FALSE'])) {
        $where_clauses[] = "`" . $column . "` = ?";
        $params[] = $value;
        $types .= 's';
    }
}

if (!empty($where_clauses)) {
    $sql .= " AND " . implode(" AND ", $where_clauses);
}
//order the list by closest to farthest distance
$sql .= " ORDER BY distance ASC LIMIT ?";

// Add the LIMIT parameter ($asc_filter) to the params array *after* the SQL string is fully built.
$params[] = $asc_filter;
$types .= 'i';

$stmt = $facility_conn->prepare($sql);
if ($stmt === false) {
    die("Prepare failed: " . $facility_conn->error);
}
$stmt->bind_param($types, ...$params);
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
$facility_conn->close();

header('Content-Type: application/json');
echo json_encode(['html' => $html_output, 'locations' => $locations]);
?>