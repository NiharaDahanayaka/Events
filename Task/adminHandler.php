<?php
session_start();

// Define admin credentials
$adminUsername = "admin";
$adminPassword = "admin123";

// Check login credentials
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $inputUsername = $_POST['username'];
    $inputPassword = $_POST['password'];

    if ($inputUsername === $adminUsername && $inputPassword === $adminPassword) {
        // Login successful
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $adminUsername;
        header("Location: admin_dashboard.php"); // Redirect to the dashboard
        exit();
    } else {
        // Invalid credentials
        echo "<script>
            alert('Invalid Username or Password');
            window.location.href='admin.php'; // Redirect back to login page
        </script>";
        exit();
    }
}





