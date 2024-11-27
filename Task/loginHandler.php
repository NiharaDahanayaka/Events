<?php

//check if the login button is clicked
if(isset($_POST['login'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $select_users = mysqli_query($conn, "SELECT * FROM users WHERE email = '$email'") or die ('query failed');

    if(mysqli_num_rows($select_users) > 0) {
        $row = mysqli_fetch_assoc($select_users);

        //password verify to check if the provided password matches the hashed password
        if(password_verify($password, $row['password'])) {

            //set session variables for the logged in user
            $_SESSION['loggedIn'] = true;
            $_SESSION['user_name'] = $row['fullName'];
            $_SESSION['user_email'] = $row['email'];
            header('location:../Task/user.php');
        } else {
            $message[] = '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                            Incorrect email or password!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div>';
        }
    } else {
        $message[] = '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                        User not found!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>';
    }
}

// Display error notifications
if (isset($message)) {
    foreach ($message as $msg) {
        echo $msg;
    }
}


$_SESSION['loggedIn'] = true;

?>