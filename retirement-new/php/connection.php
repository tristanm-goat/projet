<?php
$host="mchre091.duckdns.org:3306";
$username="mchre091";
$password="admin";
$dbname="login-details";

$conn = new mysqli($host, $username, $password, $dbname);
if($conn->connect_error)
    die("Failed to connect DB: " . $conn->connect_error);
?>