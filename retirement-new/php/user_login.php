<?php
session_start();
include 'connection.php';

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $login_conn->prepare("SELECT account_user, account_password FROM account WHERE account_user = ?");
    if ($stmt === false) {
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
            header("Location: ../portal.php");
            exit();
        }
    }
    header("Location: ../login.php?error=invalid_credentials");
    exit();
?>
