<?php
if (isset($_POST['register'])) {
    $fullName = mysqli_real_escape_string($conn, $_POST['fullName']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $age = mysqli_real_escape_string($conn, $_POST['age']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirmPassword = mysqli_real_escape_string($conn, $_POST['confirmPassword']);

    // Check if email already exists
    $select_users = mysqli_query($conn, "SELECT * FROM `users` WHERE email = '$email'") or die('Query failed');

    if (mysqli_num_rows($select_users) > 0) {
        // Email already exists
        $message[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        User already exists!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
    } else {
        // Check if passwords match
        if ($password != $confirmPassword) {
            $message[] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Confirm password does not match!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
        } else {
            // Hash the password and insert into the database
            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            mysqli_query($conn, "INSERT INTO `users`(fullName, email, age, password) VALUES('$fullName', '$email', '$age', '$hashedPassword')") or die('Query failed');

            $message[] = '<div class="alert alert-success alert-dismissible fade show" role="alert">
                            Registered successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
            header('location:../Task/login.php');
        }
    }
}

// Display messages
if (isset($message)) {
    foreach ($message as $msg) {
        echo $msg;
    }
}
?>
