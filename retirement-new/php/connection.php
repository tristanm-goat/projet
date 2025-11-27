<?php
    $login_host = "localhost:3306";
    $login_username = "member";
    $login_password = "admin";
    $login_dbname = "login_details";

    $login_conn = new mysqli($login_host, $login_username, $login_password, $login_dbname);
    if ($login_conn->connect_error) {
        // In a real app, log this error instead of dying
        error_log("Connection failed: " . $login_conn->connect_error);
        return [];
    }
?>