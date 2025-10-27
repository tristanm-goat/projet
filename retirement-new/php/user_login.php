<?php
include 'connection.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT account_user, account_password FROM account WHERE account_user = ?");
    if ($stmt === false) {
        // In a real app, log this error and show a generic message
        die("Error preparing statement: " . htmlspecialchars($conn->error));
    }

    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        if (password_verify($password, $user['account_password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['username'] = $user['account_user'];
            header("Location: ../index.php");
            exit();
        }
    }
    header("Location: ../login.php?error=invalid_credentials");
    exit();
?>
