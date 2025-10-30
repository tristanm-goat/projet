<?php
session_start();
include 'connection.php';

if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header("Location: ../login.php?error=not_logged_in");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['facility_id'])) {
    header("Location: ../facility.php?error=invalid_request");
    exit();
}

$facility_id = $_POST['facility_id'];
$username = $_SESSION['username'];

$stmt = $conn->prepare("SELECT account_option1, account_option2, account_option3 FROM account WHERE account_user = ?");
if ($stmt === false) {
    die("Error preparing select statement: " . htmlspecialchars($conn->error));
}

$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
$user_likes = $result->fetch_assoc();
$stmt->close();

if (!$user_likes) {
    die("Error: Could not find user account.");
}

$update_column = null;
if ($user_likes['account_option1'] === null) {
    $update_column = 'account_option1';
} elseif ($user_likes['account_option2'] === null) {
    $update_column = 'account_option2';
} elseif ($user_likes['account_option3'] === null) {
    $update_column = 'account_option3';
}

if ($update_column) {
    $update_stmt = $conn->prepare("UPDATE account SET $update_column = ? WHERE account_user = ?");
    if ($update_stmt === false) {
        die("Error preparing update statement: " . htmlspecialchars($conn->error));
    }
    $update_stmt->bind_param("is", $facility_id, $username);
    $update_stmt->execute();
    $update_stmt->close();
    header("Location: ../facility.php?like=success");
} else {
    header("Location: ../facility.php?like=full");
}
$conn->close();
?>
