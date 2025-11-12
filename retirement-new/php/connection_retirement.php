<?php
// Database connection
$host="mchre091.duckdns.org:3306";
$username="member";
$password="admin";
$dbname = "ontario_facility_rhra";
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    echo '<li class="facility-item"><p>Error connecting to the database.</p></li>';
    exit;
}
?>