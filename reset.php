<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body,
        html {
            height: 100%;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }
    </style>
</head>

<body>
    <?php
    if (!isset($_GET['code'])) {
        echo '<div class="container">
                <div class="card mx-auto" style="max-width: 400px;">
                    <div class="card-body px-5 rounded" style="background-color:#457B9D">
                    <h1 class="text-center mb-3 fs-1" style="color:#F1FAEE;">Reset Password</h1>
                    <form action="" method="post">
                        <label for="inputPassword5" class="form-label" style="color:#F1FAEE;">Email</label>
                        <input type="email" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="email" required>
                        <div class="text-center">
                            <button class="btn mt-3 px-3 text-center" type="submit" name="reset" style="background-color:#E63946;color:#F1FAEE;">Reset</button>
                        </div>
                    </form>
                    </div>
                </div>
            </div>';
    } else if (isset($_GET['code']) && isset($_GET['email'])) {
        echo '<div class="container">
            <div class="card mx-auto" style="max-width: 400px;">
                <div class="card-body rounded"style="background-color:#457B9D">
                <h1 class="text-center mb-3 fs-1"style="color:#F1FAEE;">New Password</h1>
                <form action="" method="post">
                    <label for="inputPassword5" class="form-label" style="color:#F1FAEE;">Password</label>
                    <input type="password" id="inputPassword5" class="form-control" aria-describedby="passwordHelpBlock" name="password" required>
                    <div id="passwordHelpBlock" class="form-text" style="color:#F1FAEE;">
                    Your password must be 8-20 characters long, contain letters and numbers, and must not contain spaces, special characters, or emoji.
                    </div>
                    <div class="text-center">
                        <button class="btn mt-3 px-3 text-center" type="submit" name="newPassword" style="background-color:#E63946;color:#F1FAEE;">Change Password</button>
                    </div>
                </form>
                </div>
            </div>
            </div>';
    }
    ?>
    <?php
    if (isset($_POST['reset'])) {
        $username = 'root';
        $password = '';
        $database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);

        $checkEmail = $database->prepare("SELECT Email,Security_Code FROM users WHERE Email = :Email");
        $checkEmail->bindParam("Email", $_POST['email']);
        $checkEmail->execute();

        if ($checkEmail->rowCount() > 0) {

            require_once "mail.php";
            $user = $checkEmail->fetchObject();
            $mail->addAddress($_POST['email']);
            $mail->Subject = "Forget Password";
            $mail->Body = '<h1>Reset Password</h1>'
                . '<div>reset link</div>' . '<a href="http://localhost/server/marketplace/reset.php?email=' . $_POST['email'] . '&code=' . $user->Security_Code . '  ">' . 'http://localhost/server/marketplace/reset.php?email=' . $_POST['email'] . '&code=' . $user->Security_Code . '</a>';
            $mail->setFrom('tradtechstore@gmail.com', 'TradTech Store');
            $mail->send();
            header("Location:https://mail.google.com/");
        } else {
            echo '<div class="container" style="font-size:14px"><div class="alert alert-danger d-flex align-items-center" role="alert">
                                    <div>
                                    Wrong username or password. Try again or click \'Forget password\' to reset it.
                                    </div>
                                </div></div>';
        }
    }
    ?>
    <?php

    if (isset($_POST['newPassword'])) {
        $username = 'root';
        $password = '';
        $database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);

        $updatePassword = $database->prepare("UPDATE users SET password = :password WHERE Email = :email");
        $updatePassword->bindParam('email', $_GET['email']);
        $hashedPassword = md5($_POST['password']);
        $updatePassword->bindParam("password", $hashedPassword);
        $updatePassword->execute();
        header("Location:http://localhost/server/marketplace/pages/login.php");
    }
    ?>
</body>

</html>