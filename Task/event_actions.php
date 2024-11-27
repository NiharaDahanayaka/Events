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
    // Add new event
    $eventName = $conn->real_escape_string($_POST['event_name']);
    $userId = (int)$_POST['user_id'];
    $expectedDate = $_POST['expected_date'];
    
    $sql = "INSERT INTO events (event_name, user_id, expected_date) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sis", $eventName, $userId, $expectedDate);
    $stmt->execute();
    $stmt->close();
    
    header("Location: admin_dashboard.php");
    exit();
} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if ($_GET['action'] === 'delete') {
        $id = (int)$_GET['id'];
        $sql = "DELETE FROM events WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $stmt->close();
        
        header("Location: admin_dashboard.php");
        exit();
    }
}

$conn->close();














?>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'complete') {
    $eventId = intval($_POST['id']);
    $conn = new mysqli("localhost", "root", "", "events");
    if ($conn->connect_error) {
        die(json_encode(["success" => false, "error" => $conn->connect_error]));
    }
    $sql = "UPDATE events SET status = 'complete' WHERE id = $eventId";
    if ($conn->query($sql)) {
        echo json_encode(["success" => true]);
    } else {
        echo json_encode(["success" => false, "error" => $conn->error]);
    }
    $conn->close();
    exit();
}
?>
