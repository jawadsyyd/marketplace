<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="../users_images/avatar.png" type="image/x-icon">
    <title>LogIn Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #title {
            background-color: #457B9D;
            color: white;
        }

        #btnLogIn {
            background-color: #E63946;
            color: white;
        }

        #forget {
            color: #457B9D;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-image: url(../images/photo1.jpeg);
            background-size: cover;
            background-position: center;
        }

        .card {
            width: 100%;
            max-width: 400px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-5 py-3">
        <div class="row d-flex justify-content-center">
            <div class="col-md-4 mb-5">
                <div class="card shadow" style="background-color: rgba(241, 250, 238, 0.8);">
                    <div class="card-header text-center display-5 text-capitalize" id="title">
                        <h3 class="fs-1">Log in</h3>
                    </div>
                    <div class="card-body">
                        <!-- START FORM -->
                        <form action="login.php" method="post">
                            <div class="form-group mb-3">
                                <label for="username" class="form-label">Username</label>
                                <input type="text" class="form-control" id="username" name="username" placeholder="Enter username" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" placeholder="Enter password" required>
                            </div>
                            <div class=" d-flex align-items-center position-relative">
                                <button type="submit" class="btn px-3" id="btnLogIn" name="submit">Login</button>
                                <div class="position-absolute end-0">
                                    <a href="http://localhost/server/marketplace/reset.php" style="text-decoration:none" id="forget">Forget password?</a>
                                </div>
                            </div>
                        </form>
                        <!-- END FORM -->
                        <?php
                        if (isset($_POST['submit'])) {
                            $username = $_POST['username'];
                            $password = $_POST['password'];

                            $hashed_password = md5($password);
                            $truncated_password = substr($hashed_password, 0, 25);

                            $login = $database->prepare("SELECT * FROM users WHERE Username = :username AND Password = :password");
                            $login->bindParam("username", $username);
                            $login->bindParam("password", $truncated_password);
                            $login->execute();
                            $user = $login->fetch();
                            if ($user && $user['Activated'] != 0) {
                                session_start();
                                $_SESSION['user_type'] = $user['UserType'];
                                $_SESSION['username'] = $user['Username'];
                                header("Location: http://localhost/server/marketplace/pages/home.php");
                            } else {
                                echo '<div class="" style="font-size:14px"><div class="alert alert-danger d-flex align-items-center mt-3" role="alert">
                                    <div>
                                    Wrong username or password. Try again or click \'Forget password\' to reset it.
                                    </div>
                                </div></div>';
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>