<?php
session_start();
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: admin.php");
    exit();
}

$conn = new mysqli("localhost", "root", "", "events");

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Add new user
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    // Prepare SQL statement
    $sql = "INSERT INTO users2 (username, email, password) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Check if prepare() was successful
    if ($stmt === false) {
        // Error occurred, display error message
        die('Error preparing the statement: ' . $conn->error);
    }

    // Bind parameters and execute the query
    $stmt->bind_param("sss", $username, $email, $password);
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php");
        exit();
    } else {
        // Handle error on execute
        die('Error executing the query: ' . $stmt->error);
    }

    // Close the prepared statement
    $stmt->close();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $action = $_GET['action'];
    $id = (int)$_GET['id'];
    
    switch($action) {
        case 'delete':
            $sql = "DELETE FROM users2 WHERE id = ?";
            $stmt = $conn->prepare($sql);

            // Check if prepare() was successful
            if ($stmt === false) {
                die('Error preparing the statement: ' . $conn->error);
            }

            // Bind parameter and execute the query
            $stmt->bind_param("i", $id);
            $stmt->execute();
            $stmt->close();
            break;
            
        case 'toggle_status':
            $current = (int)$_GET['current'];
            $newStatus = $current ? 0 : 1;
            $sql = "UPDATE users2 SET is_active = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);

            // Check if prepare() was successful
            if ($stmt === false) {
                die('Error preparing the statement: ' . $conn->error);
            }

            // Bind parameters and execute the query
            $stmt->bind_param("ii", $newStatus, $id);
            $stmt->execute();
            $stmt->close();
            break;
    }
    
    header("Location: admin_dashboard.php");
    exit();
}

$conn->close();



// Database connection
$conn = new mysqli("localhost", "root", "", "events");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Update user data
    $id = $_POST['id'];
    $username = $_POST['username'];
    $email = $_POST['email'];

    $sql = "UPDATE users2 SET username = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $email, $id);
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=User updated successfully");
    } else {
        echo "Error updating user: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();








if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    // Update user data
    $id = (int)$_POST['id'];
    $username = $conn->real_escape_string($_POST['username']);
    $email = $conn->real_escape_string($_POST['email']);

    $sql = "UPDATE users2 SET username = ?, email = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssi", $username, $email, $id);
    if ($stmt->execute()) {
        header("Location: admin_dashboard.php?message=User updated successfully");
    } else {
        echo "Error updating user: " . $stmt->error;
    }

    $stmt->close();
}


if (!isset($_POST['password']) || empty($_POST['password'])) {
    die("Error: Password is required.");
}

?>



