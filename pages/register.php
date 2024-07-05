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
    <title>Registration</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            margin: 0;
            background-image: url(../images/photo3.jpeg);
            background-size: cover;
            background-position: center;
        }

        .awm {
            width: 100%;
            max-width: 100%;
            padding: 0 15px;
        }

        #title {
            background-color: #457B9D;
            letter-spacing: 2px;
        }

        #btnSignUp {
            background-color: #E63946;
            color: white;
        }
    </style>

</head>

<body>
    <div class="awm mx-3">
        <div class="container text-light py-3 rounded-top" id="title">
            <header class="text-center">
                <h1 class="display-5 text-uppercase"><strong>Register</strong></h1>
            </header>
        </div>
        <section class="container py-3 rounded-bottom" style="background-color: rgba(241, 250, 238, 0.8);">
            <form class="row g-3" method="POST">
                <div class="col-6 col-md-3">
                    <label for="inputFname4" class="form-label">First name</label>
                    <input type="text" name="fname" class="form-control" id="fname" required>
                </div>
                <div class="col-6 col-md-3">
                    <label for="inputLname4" class="form-label">Last name</label>
                    <input type="text" name="lname" class="form-control" id="lname" required>
                </div>
                <div class="col-md-6">
                    <label for="inputEmail4" class="form-label">Email</label>
                    <input type="email" name="email" class="form-control" id="email" required>
                </div>
                <div class="col-6 col-md-4">
                    <label for="inputUsername4" class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" id="username" required>
                </div>
                <div class="col-6 col-md-4">
                    <label for="inputPassword4" class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" id="password" required>
                </div>
                <div class="col-4 col-md-4">
                    <label for="inputRole" class="form-label">Role</label>
                    <select id="role" name="role" class="form-select" required>
                        <option selected value="Customer">Customer</option>
                        <option value="Admin">Admin</option>
                    </select>
                </div>

                <div class="col-4 col-md-3">
                    <label for="inputPhNb4" class="form-label lPhone">Phone number</label>
                    <input type="tel" name="phone" class="form-control" id="phone">
                </div>
                <div class="col-4 col-md-3">
                    <label for="inputPhNb4" class="form-label lAddress">Address</label>
                    <input type="text" name="address" class="form-control" id="address">
                </div>
                <div class="col-12 mt-4">
                    <button type="submit" name="submit" class="btn px-4 py-2" id="btnSignUp">Sign in</button>
                    <a href="login.php" class="px-2" style="text-decoration: none;color:#1D3557">Already Have An Account?</a>
                </div>
                <?php
                if (isset($_POST['submit'])) {

                    $fName = $_POST['fname'];
                    $lName = $_POST['lname'];
                    $phone = $_POST['phone'];
                    $email = $_POST['email'];
                    $address = $_POST['address'];

                    $emailCheck = $database->prepare('SELECT Email FROM users WHERE Email = :email');
                    $emailCheck->bindParam(':email', $_POST['email']);
                    $emailCheck->execute();

                    if ($emailCheck->rowCount() === 0) {
                        if ($_POST['role'] === 'Customer') {
                            $insert = $database->prepare('INSERT INTO 
            customers(FName,LName,PhoneNumber,Email,Address)
            VALUES(:FName,	:LName,	:PhoneNumber,:Email	,:Address)
            ');
                            $insert->bindParam('FName', $fName);
                            $insert->bindParam('LName', $lName);
                            $insert->bindParam('PhoneNumber', $phone);
                            $insert->bindParam('Email', $email);
                            $insert->bindParam('Address', $address);
                            $insert->execute();

                            $getId = $database->prepare('SELECT Customer_Id FROM customers WHERE Email = :EMAIL');
                            $getId->bindParam("EMAIL", $_POST['email']);
                            $getId->execute();

                            $customerId = $getId->fetch(PDO::FETCH_ASSOC);

                            $cid = $customerId["Customer_Id"];

                            // sendEmail_verification("$fName", "$email");
                        }

                        $password = $_POST['password'];
                        $hashedPassword = md5($password);

                        $insertUser = $database->prepare('INSERT INTO 
        users(Username,Password,UserType,FName,LName,Email,Security_Code,Customer_Id)
        VALUES(:username,:password,:role,:fname,:lname,:email,:Security_Code,:customerId)
        ');
                        $insertUser->bindParam('username', $_POST['username']);
                        $insertUser->bindParam('password', $hashedPassword);
                        $insertUser->bindParam('role', $_POST['role']);
                        $insertUser->bindParam('fname', $_POST['fname']);
                        $insertUser->bindParam('lname', $_POST['lname']);
                        $insertUser->bindParam('email', $_POST['email']);
                        // SECURITY CODE [START]
                        $securityCode = md5(date("h:i:s"));
                        $insertUser->bindParam('Security_Code', $securityCode);
                        // SECURITY CODE [END]
                        $insertUser->bindParam('customerId', $cid);

                        if ($insertUser->execute()) {
                            require_once "../mail.php";
                            $mail->addAddress($_POST['email']);
                            $mail->Subject = "Verification";
                            $mail->Body = '<h1>Thank you for your registration</h1>'
                                . '<div>verification link</div>' . '<a href="http://localhost/server/marketplace/active.php?code=' . $securityCode . '">' . 'http://localhost/server/marketplace/active.php' . '?code=' . $securityCode . '</a>';
                            $mail->setFrom('tradtechstore@gmail.com', 'TradTech Store');
                            $mail->send();
                            echo "<div class='container mt-5' style='margin-top: -7rem;'>
        <div class='alert alert-info alert-dismissible fade show' role='alert'>
            <strong>Verification Code Sent!</strong> Please check the verification code sent to <strong>" . $_POST['email'] . "</strong>.
            <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
        </div>
      </div>";
                        }
                    } else {
                        echo "<div class='container mt-5' style='margin-top: -7rem;'>
        <div class='alert alert-warning' role='alert'>
            Email is already in use. Please choose a different one.
        </div>
      </div>";
                    }
                }
                ?>
            </form>
        </section>
    </div>
    <script src="../js/registration.js"></script>
</body>

</html>