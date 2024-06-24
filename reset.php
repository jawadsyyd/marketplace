<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <?php
    if(!isset($_GET['code'])){
        echo '<div class="container mt-5">
                <div class="card mx-auto" style="max-width: 400px;">
                    <div class="card-body">
                    <h1 class="text-center mb-3">Reset Password</h1>
                    <form action="" method="post">
                        <label for="inputPassword5" class="form-label">Email</label>
                        <input type="email" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="email" required>
                        <div class="text-center">
                            <button class="btn btn-primary mt-3 px-3 text-center" type="submit" name="reset">Reset</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>';
    }else if(isset($_GET['code'])&&isset($_GET['email'])){
        echo'<div class="container mt-5">
            <div class="card mx-auto" style="max-width: 400px;">
                <div class="card-body">
                <h1 class="text-center mb-3">New Password</h1>
                <form action="" method="post">
                    <label for="inputPassword5" class="form-label">Password</label>
                    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password" required>
                    <div id="passwordHelpBlock" class="form-text">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                    </div>
                    <div class="text-center">
                        <button class="btn btn-primary mt-3 px-3 text-center" type="submit" name="newPassword">Change Password</button>
                    </div>
                </form>
                </div>
            </div>
            </div>';
    }
    ?>
    <?php
    if(isset($_POST['reset'])){
        $username = 'root';
        $password = '';
        $database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);

        $checkEmail = $database->prepare("SELECT Email,Security_Code FROM users WHERE Email = :Email");
        $checkEmail->bindParam("Email",$_POST['email']);
        $checkEmail->execute();

        if($checkEmail->rowCount()>0){

            require_once "mail.php";
            $user = $checkEmail->fetchObject();
            $mail->addAddress($_POST['email']);
            $mail->Subject = "Forget Password";
            $mail->Body = '<h1>Reset Password</h1>'
            . '<div>reset link</div>' . '<a href="http://localhost/server/marketplace/reset.php?email=' .$_POST['email']. '&code='. $user->Security_Code .'  ">' .'http://localhost/server/marketplace/reset.php?email=' .$_POST['email']. '&code='. $user->Security_Code . '</a>';
            $mail->setFrom('bishopstore124@gmail.com', 'Bishop Store');
            $mail->send();
            header("Location:https://mail.google.com/");
        }else{
            echo '<div class="container" style="font-size:14px"><div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <div>
                                    Wrong username or password. Try again or click \'Forget password\' to reset it.
                                    </div>
                                </div></div>';
        }
    }
    ?>
<?php

if(isset($_POST['newPassword'])){
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);

    $updatePassword = $database->prepare("UPDATE users SET password = :password WHERE Email = :email");
    $updatePassword->bindParam('email',$_GET['email']);
    $hashedPassword = md5($_POST['password']);
    $updatePassword->bindParam("password",$hashedPassword);
    $updatePassword->execute();
    header("Location:http://localhost/server/marketplace/pages/login.php");
}
?>
</body>
</html>