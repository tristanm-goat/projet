<?php
$host="localhost:3306";
$username="member";
$password="admin";
$dbname = "contact_request"; // Assuming this is the correct database name
$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    // In a real app, you would log this error instead of showing it to the user.
    header("Location: ../contact.php?status=db_error");
    exit;
}
?>