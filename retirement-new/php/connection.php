<?php
session_start();

$host="localhost";
$username="root";
$password="";
$dbname="login-details";

$conn = new mysqli($host, $username, $password, $dbname);
if($conn->connect_error)
    die("Failed to connect DB: " . $conn->connect_error);
?>