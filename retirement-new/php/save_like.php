<?php
session_start();

// Connects to login database
include 'connection.php';

header('Content-Type: application/json');

// Check if user is logged in
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in.']);
    exit();
}

// Check for valid POST request and required parameters
if ($_SERVER["REQUEST_METHOD"] !== "POST" || !isset($_POST['facility_id']) || !isset($_POST['option_number'])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request.']);
    exit();
}

// retrieve data from the 'save buttons' in the javascript from facility.php
$facility_id = $_POST['facility_id']; // Keep as string
$option_number = (int)$_POST['option_number']; // Option number is still an integer
$username = $_SESSION['username'];

// Validate option_number
if (!in_array($option_number, [1, 2, 3])) {
    echo json_encode(['status' => 'error', 'message' => 'Invalid option number.']);
    exit();
}

// Updates database with the correct data
$update_column = "account_option" . $option_number;

// 1. Prepare the statement to fetch current user options
$stmt_check = $login_conn->prepare("SELECT account_option1, account_option2, account_option3 FROM account WHERE account_user = ?");
if ($stmt_check === false) {
    echo json_encode(['status' => 'error', 'message' => 'Database error (prepare check).']);
    exit();
}

$stmt_check->bind_param("s", $username);
$stmt_check->execute();

// 2. Get the result object from the statement
$result = $stmt_check->get_result();

// 3. Fetch the data into an associative array
$user_options = $result->fetch_assoc();
$stmt_check->close();

// error user not found
if (!$user_options) {
    echo json_encode(['status' => 'error', 'message' => 'User account not found.']);
    exit();
}

// Check if the facility is already in any of the user's liked options
if (in_array($facility_id, array_values($user_options))) {
    echo json_encode(['status' => 'warning', 'message' => 'This facility is already saved in one of your options.']);
    exit();
}

// Proceed with the update
$update_stmt = $login_conn->prepare("UPDATE account SET $update_column = ? WHERE account_user = ?");
if ($update_stmt === false) {
    echo json_encode(['status' => 'error', 'message' => 'Database error (prepare update).']);
    exit();
}

$update_stmt->bind_param("ss", $facility_id, $username);

if ($update_stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'Facility saved to Option ' . $option_number . ' successfully!']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Failed to save facility: ' . $update_stmt->error]);
}

$update_stmt->close();
$login_conn->close();
?>
