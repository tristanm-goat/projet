<?php
// Basic validation and sanitization
$name = trim($_POST['name'] ?? '');
$email = trim($_POST['email'] ?? '');
$subject = trim($_POST['subject'] ?? '');
$message = trim($_POST['message'] ?? '');

if (empty($name) || empty($email) || empty($subject) || empty($message) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
    // Redirect back with an error if validation fails
    header("Location: ../contact.php?status=error");
    exit;
}
$time = date('Y-m-d H:i:s');

// Database connection
include 'connection_contact.php';

// With the database table updated (AUTO_INCREMENT), we no longer include `contact_id` in the INSERT statement.
// The database will automatically generate the unique, incremental ID.
$stmt = $conn->prepare("INSERT INTO contact_requests (contact_name, contact_email, contact_subject, contact_request, contact_time) VALUES (?, ?, ?, ?, ?)");
if ($stmt === false) {
    header("Location: ../contact.php?status=db_error");
    exit;
}
//preparing values (Will replace ?)
$stmt->bind_param("sssss", $name, $email, $subject, $message, $time);

if ($stmt->execute()) {
    header("Location: ../contact.php?status=success");
} else {
    header("Location: ../contact.php?status=error");
}

$stmt->close();
$conn->close();
?>
