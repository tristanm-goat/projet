<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // prepare statement to fetch data from sql database to prevent injections
    $stmt = $conn->prepare("SELECT account_user FROM account WHERE account_user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Redirect back to signup page with an error
        header("Location: ../signup.php?error=username_exists");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt_insert = $conn->prepare("INSERT INTO account(account_user, account_password) VALUES (?, ?)");
        if ($stmt_insert === false) {
            die("Error preparing insert statement: " . $conn->error);
        }

        $stmt_insert->bind_param("ss", $username, $hashed_password);

        if ($stmt_insert->execute()) {
            header("Location: ../login.php?signup=success");
            exit();
        } else {
            echo "Error: " . $stmt_insert->error;
        }
        $stmt_insert->close();
    }
    $stmt->close();
    $conn->close();
}
?>
