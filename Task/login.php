<?php

include '../Task/config.php';
include '../Task/loginHandler.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Event Management System</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="script.js" defer></script>
    
</head>




<body>
<div class="image-container">
        <nav class="navbar">
            <h1 class="logo">Login</h1>
        </nav>

        <div class="container">
            <div class="form-card mt-5">
                <h1 class="form-title">Log your profile</h1>
                <p class="form-subtitle">Log in to </p>
                <form class="form-align" method="post">
                    <div class="form-group">
                        <label for="email"><i class="bi bi-envelope-fill"></i></label>
                        <input type="email" class="input-field" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="bi bi-lock-fill"></i></label>
                        <input type="password" class="input-field" id="password" name="password" placeholder="Enter Password" required>
                    </div>
                    <div class="text-center">
                        <button class="login-btn" id="loginbtn" name="login">Login</button>
                    </div>
                </form>
                <div class="text-center">
                    <p class="register-text">Don't Have a Profile?</p>
                    <a href="register.php" class="register-link">
                        <button class="register-btn" id="regbtn">Register</button>
                    </a>
                    <div class="admin-link">
                        <p></p>
                        <p>Admin? <a href="admin.php">Click Here</a></p>
                    </div>
                    
                </div>
            </div>
        </div>
    </div>



</body>
</html>
<style>

body {
    background: lightblue;
    font-family: 'Arial', sans-serif;
    color: white;
    margin: 0;
    padding: 0;
}

.image-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    height: 100vh;
    text-align: center;
}

.navbar {
    width: 100%;
    padding: 20px 40px;
    background-color: rgba(0, 0, 0, 0.8);
    display: flex;
    justify-content: center;
    align-items: center;
    box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.4);
}

.logo {
    font-size: 32px;
    font-weight: bold;
    color: #EA3788;
    text-shadow: 0px 4px 6px rgba(255, 255, 255, 0.5);
}

.form-card {
    background: rgba(255, 255, 255, 0.1);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
    max-width: 400px;
    margin: auto;
    text-align: center;
    animation: fadeIn 1.5s ease-in-out;
}

.form-title {
    font-size: 28px;
    font-weight: bold;
    color: #EA3788;
    margin-bottom: 10px;
}

.form-subtitle {
    font-size: 16px;
    color: #D9D9D9;
    margin-bottom: 30px;
}

.form-align {
    width: 100%;
}

.form-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.form-group label {
    font-size: 16px;
    margin-bottom: 5px;
    color: white;
}

.input-field {
    width: 100%;
    padding: 10px;
    border: 1px solid #D9D9D9;
    border-radius: 8px;
    outline: none;
    background: rgba(255, 255, 255, 0.05);
    color: white;
    transition: border-color 0.3s ease;
}

.input-field:focus {
    border-color: #EA3788;
}

.login-btn, .register-btn {
    background-color: blue;
    color: white;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.login-btn:hover, .register-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px rgba(234, 55, 136, 0.8);
}

.register-text {
    margin: 20px 0 10px;
    font-size: 14px;
    color: #D9D9D9;
}

.register-link {
    text-decoration: none;
}

.register-btn {
    background-color: #FFD700;
    color: black;
}

@keyframes fadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

</style>