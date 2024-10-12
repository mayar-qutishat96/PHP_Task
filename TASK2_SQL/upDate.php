<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="signup.css">
    <title>Sign Up</title>
</head>
<body>
    <?php
        require('connection.php');
        $data = [];
        if (isset($_GET['id_up'])) {
            $id_up = $_GET['id_up'];
            $data = crud::userDataPerId($id_up);
        }

        if (isset($_POST['signUP_button'])) {
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            if (!empty($name) && !empty($email)) {
                $p = crud::conect()->prepare('UPDATE users SET name=:n, email=:e'. (!empty($password) ? ', pass=:p' : '') . ' WHERE id=:id');
                $p->bindValue(':n', $name);
                $p->bindValue(':e', $email);
                if (!empty($password)) {
                $p->bindValue(':p', $password);
                }
                $p->bindValue(':id', $id_up);
                if ($p->execute()) {
                    echo 'Updated!';
                } else {
                    echo 'Update failed. Please try again.';
                }
            } else {
                echo 'Please fill in all required fields.';
            }
        }
    ?>
    <div class="form">
        <div class="title">
            <p>Updating user data</p>
        </div>
        <form action="" method="post">
            <input type="text" name="name" placeholder="Name" value="<?php echo isset($data['name']) ? htmlspecialchars($data['name']) : ''; ?>">
            <input type="email" name="email" placeholder="Email" value="<?php echo isset($data['email']) ? htmlspecialchars($data['email']) : ''; ?>">
            <input type="password" name="password" placeholder="New Password">
            <input type="submit" value="UPDATE" name="signUP_button"> 
        </form>
    </div>
</body>
</html>