<?php
// Start session
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    http_response_code(403); // Forbidden
    echo json_encode(["error" => "Unauthorized"]);
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "events");
if ($conn->connect_error) {
    http_response_code(500); // Internal Server Error
    echo json_encode(["error" => "Database connection failed"]);
    exit();
}

// Get user ID from the request
$id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Fetch user data
$sql = "SELECT id, username, email FROM users2 WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
    echo json_encode($user);
} else {
    http_response_code(404); // Not Found
    echo json_encode(["error" => "User not found"]);
}

$stmt->close();
$conn->close();
?>
