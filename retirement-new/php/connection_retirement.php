<?php
// Database connection
$facility_host="localhost:3306";
$facility_username="member";
$facility_password="admin";
$facility_dbname = "ontario_facility_rhra";
$facility_conn = new mysqli($facility_host, $facility_username, $facility_password, $facility_dbname);
if ($facility_conn->connect_error) {
    echo '<li class="facility-item"><p>Error connecting to the database.</p></li>';
    exit;
}
?>