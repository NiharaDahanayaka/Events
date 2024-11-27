<?php

include '../Task/config.php';
include '../Task/adminHandler.php';



?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>


    <div class="login-container">
        
        <form id="loginForm" method="POST" action="../Task/adminHandler.php">
        <form id="loginForm" method="POST" action="../Task/user_actions.php">
            <a href="login.php" class="tab-button">Back</a>

            <h2>Admin Login</h2>
            <div class="input-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <button type="submit">Login</button>
            <p id="error-message"></p>
        </form>
    </div>
    <script src="script.js"></script>

    <style>

body {
    font-family: Arial, sans-serif;
    background-color: lightblue;
    margin: 0;
    padding: 0;
}

.login-container {
    max-width: 400px;
    margin: 100px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
}

h2 {
    text-align: center;
    margin-bottom: 20px;
    color: #333;
}

.input-group {
    margin-bottom: 15px;
}

label {
    display: block;
    margin-bottom: 5px;
    font-weight: bold;
}

input {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 4px;
}

button {
    width: 100%;
    padding: 10px;
    background-color: #007BFF;
    border: none;
    color: white;
    font-size: 16px;
    border-radius: 4px;
    cursor: pointer;
}

button:hover {
    background-color: #0056b3;
}

#error-message {
    color: red;
    text-align: center;
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

    </style>
</body>
</html>
