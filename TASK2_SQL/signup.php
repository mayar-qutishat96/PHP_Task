<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Signup</title>
</head>
<body>
<?php
require('connection.php');

if (isset($_POST['Signup_button'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if (!empty($name) && !empty($email) && !empty($password)) {
        if ($password === $confirm_password) {
            // Use the correct method name and connection method
            $p = Crud::connect()->prepare('INSERT INTO users (name, email, password) VALUES (:n, :e, :p)');
            $p->bindValue(':n', $name);
            $p->bindValue(':e', $email);
            $p->bindValue(':p', $password ); 
            $p->execute(); // Execute the query
            echo 'Successfully registered!';
        } else {
            echo 'Passwords do not match.';
        }
    } 
}
?>

<div class="form">
    <form action="" method="post">
        <div class="title">
            <p>SignUp</p>  
        </div>
        <input type="text" name="name" placeholder="Enter Name" required>
        <input type="email" name="email" placeholder="Enter Email" required> 
        <input type="password" name="password" placeholder="Enter Password" required> 
        <input type="password" name="confirm_password" placeholder="Confirm Password" required> 
        <input type="submit" value="SignUp" name="Signup_button">
    </form>
</div>       
</body>
</html>