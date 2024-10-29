<?php
session_start();

// Check if the user is logged in
if (isset($_SESSION['username'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to the login page or any other page you prefer
    header("Location: Home.php");
    exit;
} else {
    // If the user is not logged in, redirect to the login page
    header("Location: Home.php");
    exit;
}
