<?php
include 'connection.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // server-side validation
    $username = trim($_POST['username'] ?? '');
    $password = $_POST['password'] ?? '';

    $errors = [];

    if (strlen($username) < 3 || strlen($username) > 20) {
        $errors[] = 'Username must be 3-20 characters.';
    }
    if (!preg_match('/^[A-Za-z0-9_]+$/', $username)) {
        $errors[] = 'Username may only contain letters, numbers and underscore.';
    }
    if (strlen($password) < 8 || strlen($password) > 64) {
        $errors[] = 'Password must be 8-64 characters.';
    }
    if (preg_match('/\s/', $password)) {
        $errors[] = 'Password cannot contain spaces.';
    }
    if (!preg_match('/[A-Z]/', $password)) {
        $errors[] = 'Password must include at least one uppercase letter.';
    }
    if (!preg_match('/\d/', $password)) {
        $errors[] = 'Password must include at least one digit.';
    }

    if (!empty($errors)) {
        // example: show errors and stop (adapt to your app flow)
        foreach ($errors as $err) {
            echo '<p style="color:red;">' . htmlspecialchars($err) . '</p>';
        }
        exit;
    }

    $username = $_POST["username"];
    $password = $_POST["password"];

    // prepare statement to fetch data from sql database to prevent injections
    $stmt = $login_conn->prepare("SELECT account_user FROM account WHERE account_user = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Redirect back to signup page with an error
        header("Location: ../signup.php?error=username_exists");
        exit();
    } else {
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $stmt_insert = $login_conn->prepare("INSERT INTO account(account_user, account_password) VALUES (?, ?)");
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
    $login_conn->close();
}
?>
