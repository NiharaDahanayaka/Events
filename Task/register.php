<?php

include '../Task/config.php';
include '../Task/registerHandler.php';


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - Clothing Brand</title>
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
            <h1 class="logo"> Register</h1>
        </nav>


        <div class="container">
            <div class="regform-card mt-5">
                <h1 class="text-center form-title">Create Your Profile</h1>
                <form class="regform-align" action="register.php" method="post">
                    <div class="regform-group">
                        <label for="fullName">Full Name</label>
                        <input type="text" class="input-field" id="fullName" name="fullName" placeholder="Enter Full Name" required>
                    </div>
                    <div class="regform-group">
                        <label for="email">Email Address</label>
                        <input type="email" class="input-field" id="email" name="email" placeholder="Enter email" required>
                    </div>
                    <div class="regform-group">
                        <label for="age">Age</label>
                        <input type="number" class="input-field" id="age" name="age" placeholder="Enter your age" min="0" required>
                    </div>
                    <div class="regform-group">
                        <label for="password">Password</label>
                        <input type="password" class="input-field" id="password" name="password" placeholder="Enter password" required>
                    </div>
                    <div class="regform-group">
                        <label for="confirmPassword">Confirm Password</label>
                        <input type="password" class="input-field" id="confirmPassword" name="confirmPassword" placeholder="Confirm your password" required>
                    </div>
                    <div class="text-center">
                        <button class="reset-btn" type="reset">Reset</button>
                        <button class="register-btn" type="submit" name="register">Register</button>
                    </div>
                    <div class="text-center mt-3">
                        <span class="already-account">Already have an account? <a href="login.php" class="login-link">Log in here</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="../Static Assets/js/fade-effects.js"></script>



  
</body>

</html>  
<style>
      body {
    background: gray;
    font-family: 'Arial', sans-serif;
    color: white;
    margin: 0;
    padding: 0;
}


.fade-wrapper {
    opacity: 0;
    transition: opacity 0.5s ease-in-out;
}

.fade-wrapper.fade-in {
    opacity: 1;
}

.fade-wrapper.fade-out {
    opacity: 0;
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
    margin: 0;
}

.container {
    margin-top: 50px; 
}

.regform-card {
    background: rgba(255, 255, 255, 0.1);
    padding: 40px;
    border-radius: 20px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.5);
    max-width: 500px;
    margin: auto;
    text-align: center;
    animation: fadeInCard 1.5s ease-in-out;
}

.form-title {
    font-size: 28px;
    font-weight: bold;
    color: #EA3788;
    margin-bottom: 20px;
}

.regform-align {
    width: 100%;
}

.regform-group {
    margin-bottom: 20px;
    display: flex;
    flex-direction: column;
    align-items: flex-start;
}

.regform-group label {
    font-size: 16px;
    color: white;
    margin-bottom: 5px;
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

.reset-btn, .register-btn {
    background-color: #EA3788;
    color: white;
    font-size: 16px;
    font-weight: bold;
    padding: 10px 20px;
    border: none;
    border-radius: 8px;
    cursor: pointer;
    margin: 10px;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.reset-btn:hover, .register-btn:hover {
    transform: scale(1.05);
    box-shadow: 0 0 10px rgba(234, 55, 136, 0.8);
}

.already-account {
    font-size: 14px;
    color: #D9D9D9;
}

.login-link {
    color: #FFD700;
    text-decoration: none;
}

.login-link:hover {
    color: #EA3788;
    text-decoration: underline;
}

@keyframes fadeInCard {
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