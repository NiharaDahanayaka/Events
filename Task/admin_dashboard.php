<?php
session_start();

// Check if the admin is logged in
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: admin.php");
    exit();
}

// Database connection
$conn = new mysqli("localhost", "root", "", "events");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to check for overdue events
function updateOverdueEvents($conn) {
    $sql = "UPDATE events 
            SET status = 'overdue' 
            WHERE expected_date < CURRENT_DATE 
            AND status = 'pending'";
    $conn->query($sql);




// Mark event as complete (action via URL parameter)
if (isset($_GET['action']) && $_GET['action'] === 'complete' && isset($_GET['id'])) {
    $eventId = intval($_GET['id']);
    $sql = "UPDATE events SET status = 'complete' WHERE id = $eventId";
    if ($conn->query($sql)) {
        header("Location: admin_dashboard.php"); // Redirect to refresh the status
        exit();
    } else {
        echo "Error updating status: " . $conn->error;
    }
}}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f3f3f3;
        }

        .dashboard-container {
            max-width: 1200px;
            margin: 0 auto;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .tab-container {
            margin-bottom: 20px;
        }

        .tab-button {
            padding: 10px 20px;
            margin-right: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .tab-button:hover {
            background-color: #0056b3;
        }

        .tab-content {
            display: none;
        }

        .tab-content.active {
            display: block;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #f8f9fa;
        }

        .action-button {
            padding: 6px 12px;
            margin: 2px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            color: white;
        }

        .edit-btn {
            background-color: #28a745;
        }

        .delete-btn {
            background-color: #dc3545;
        }
       

        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0,0,0,0.5);
        }

        .modal-content {
            background-color: gold;
            margin: 10% auto;
            padding: 20px;
            width: 50%;
            border-radius: 8px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            margin-bottom: 5px;
        }

        .form-group input, .form-group select {
            width: 100%;
            padding: 8px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn-add {
            background-color: #28a745;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .complete-btn {
    color: #fff; /* White color, change to your preferred color */
    background-color: #007BFF; /* Example of button background */
}

    </style>
</head>
<body>
    <div class="dashboard-container">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <a href="logout.php" class="tab-button">Logout</a>
        </div>

        <div class="tab-container">
            <button class="tab-button" onclick="openTab('users2')">Manage Users</button>
            <button class="tab-button" onclick="openTab('events')">Manage Events</button>
        </div>

        <!-- Users Tab -->
        <div id="users2" class="tab-content">
            <button class="btn-add" onclick="showModal('addUserModal')">Add New User</button>
            <table>
                
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php


                    $sql = "SELECT * FROM users2";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                        
                                <td>{$row['username']}</td>
                                <td>{$row['email']}</td>
                                <td>" . ($row['is_active'] ? 'Active' : 'Inactive') . "</td>
                                <td>
                                    <button class='action-button edit-btn' onclick='editUser({$row['id']})'>Edit</button>
                                    <button class='action-button delete-btn' onclick='deleteUser({$row['id']})'>Delete</button>
                                    <button class='action-button' onclick='toggleUserStatus({$row['id']}, {$row['is_active']})'>
                                        " . ($row['is_active'] ? 'Deactivate' : 'Activate') . "
                                    </button>
                                </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <!-- Events Tab -->
        <div id="events" class="tab-content">
            <button class="btn-add" onclick="showModal('addEventModal')">Add New Event</button>
            <table>
                <thead>
                    <tr>
                        <th>Event Name</th>
                        <th>Assigned To</th>
                        <th>Expected Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql = "SELECT e.*, u.username FROM events e 
                            LEFT JOIN users2 u ON e.user_id = u.id";
                    $result = $conn->query($sql);
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>{$row['event_name']}</td>
                                <td>{$row['username']}</td>
                                <td>{$row['expected_date']}</td>
                                <td>{$row['status']}</td>
                                <td>
                                    <button class='action-button edit-btn' onclick='editEvent({$row['id']})'>Edit</button>
                                    <button class='action-button delete-btn' onclick='deleteEvent({$row['id']})'>Delete</button>
                               <button class='action-button complete-btn' onclick='markEventComplete( <?php echo {$row['id']})?>'>

                                        " . ($row['status'] === 'complete' ? 'Completed' : 'Mark as Complete') . "
                                   </button>
                               
                                    </td>
                            </tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add User Modal -->
    <div id="addUserModal" class="modal">
        <div class="modal-content">
            <h2>Add New User</h2>
            <form id="addUserForm" action="user_actions.php" method="POST">
                <div class="form-group">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <button type="submit" class="btn-add">Add User</button>
                <button type="button" onclick="closeModal('addUserModal')" class="action-button delete-btn">Cancel</button>
            </form>
        </div>
    </div>

    <!-- Add Event Modal -->
    <div id="addEventModal" class="modal">
        <div class="modal-content">
            <h2>Add New Event</h2>
            <form id="addEventForm" action="event_actions.php" method="POST">
                <div class="form-group">
                    <label for="event_name">Event Name:</label>
                    <input type="text" id="event_name" name="event_name" required>
                </div>
                <div class="form-group">
                    <label for="user_id">Assign To:</label>
                    <select id="user_id" name="user_id" required>
                        <?php
                        $sql = "SELECT id, username FROM users2 WHERE is_active = 1";
                        $result = $conn->query($sql);
                        while($row = $result->fetch_assoc()) {
                            echo "<option value='{$row['id']}'>{$row['username']}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="expected_date">Expected Date:</label>
                    <input type="date" id="expected_date" name="expected_date" required>
                </div>
                <button type="submit" class="btn-add">Add Event</button>
                <button type="button" onclick="closeModal('addEventModal')" class="action-button delete-btn">Cancel</button>
            </form>
        </div>
    </div>


    <!-- Edit User Modal -->
<div id="editUserModal" class="modal">
    <div class="modal-content">
        <h2>Edit User</h2>
        <form id="editUserForm" action="user_actions.php" method="POST">
            <!-- Hidden field to store user ID -->
            <input type="hidden" id="edit_user_id" name="id">
            <div class="form-group">
                <label for="edit_username">Username:</label>
                <input type="text" id="edit_username" name="username" required>
            </div>
            <div class="form-group">
                <label for="edit_email">Email:</label>
                <input type="email" id="edit_email" name="email" required>
            </div>
            <button type="submit" class="btn-add">Save Changes</button>
            <button type="button" onclick="closeModal('editUserModal')" class="action-button delete-btn">Cancel</button>
        </form>
    </div>
</div>



<script>
    function editUser(userId) {
        // Fetch user data via AJAX or prepopulate with PHP
        fetch(`fetch_user.php?id=${userId}`)
            .then(response => response.json())
            .then(user => {
                // Populate the edit form with user data
                document.getElementById('edit_user_id').value = user.id;
                document.getElementById('edit_username').value = user.username;
                document.getElementById('edit_email').value = user.email;

                // Show the edit user modal
                showModal('editUserModal');
            })
            .catch(error => {
                console.error('Error fetching user data:', error);
            });
    }


    // Database connection
$conn = new mysqli("localhost", "root", "", "events");
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


</script>

    <script>
        function openTab(tabName) {
            const tabs = document.getElementsByClassName('tab-content');
            for(let tab of tabs) {
                tab.style.display = 'none';
            }
            document.getElementById(tabName).style.display = 'block';
        }

        function showModal(modalId) {
            document.getElementById(modalId).style.display = 'block';
        }

        function closeModal(modalId) {
            document.getElementById(modalId).style.display = 'none';
        }

        function editUser(userId) {
            // Implement user edit functionality
            fetch(`fetch_user.php?id=${userId}`)
        .then(response => {
            if (!response.ok) {
                throw new Error("Failed to fetch user data");
            }
            return response.json();
        })
        .then(user => {
            if (user.error) {
                alert(user.error);
                return;
            }

            // Populate modal with user data
            document.getElementById('edit_user_id').value = user.id;
            document.getElementById('edit_username').value = user.username;
            document.getElementById('edit_email').value = user.email;

            // Show the edit user modal
            showModal('editUserModal');
        })
        .catch(error => {
            console.error("Error fetching user data:", error);
        });
        }

        function deleteUser(userId) {
            if(confirm('Are you sure you want to delete this user?')) {
                window.location.href = `user_actions.php?action=delete&id=${userId}`;
            }
        }

        function toggleUserStatus(userId, currentStatus) {
            window.location.href = `user_actions.php?action=toggle_status&id=${userId}&current=${currentStatus}`;
        }

        function editEvent(eventId) {
            // Implement event edit functionality
        }

        function deleteEvent(eventId) {
            if(confirm('Are you sure you want to delete this event?')) {
                window.location.href = `event_actions.php?action=delete&id=${eventId}`;
            }
        }

        // Show users tab by default
        openTab('users2');
    </script>

<script>
function markEventComplete(eventId) {
    fetch('event_actions.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ action: 'complete', id: eventId }),
    })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Reload the events table to reflect the update
                location.reload();
            } else {
                alert('Error: ' + data.error);
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}
</script>
</body>
</html>



