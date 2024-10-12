<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>LOGIN</title>
    <style>
        .form { width: 300px; height: 370px; }
    </style>
</head>
<body>
<?php
session_start(); // Start the session
require('connection.php');

if (isset($_POST['LOGIN_button'])) {
    $_SESSION['validate'] = false; // Initialize validation
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Corrected SQL query to only fetch by email
    $p = crud::conect()->prepare('SELECT * FROM users WHERE email = :e');
    $p->bindValue(':e', $email);
    $p->execute();

    // Check if the email exists
    if ($p->rowCount() > 0) {
        $user = $p->fetch(PDO::FETCH_ASSOC);

        // Verify the password (make sure to hash passwords when storing)
        if (password_verify($password, $user['password'])) {
            $_SESSION['email'] = $email; // Store email in session
            $_SESSION['validate'] = true;
            header('Location: home.php'); // Redirect to home page
            exit(); // Ensure script stops after redirect
        } else {
            echo 'Invalid password. Please try again.';
        }
    } else {
        echo 'Make sure that you are registered.';
    }
}
?>


<div class="form">
    <form action="" method="post">
        <div class="title">
            <p>LOGIN</p>  
        </div>
        <input type="email" name="email" placeholder="Enter Email" required>
        <input type="Password" name="password" placeholder="Enter Password" required>
        <input type="submit" value="LOGIN" name="LOGIN_button">
    </form>
</div>    
</body>
</html>