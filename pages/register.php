<?php
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;',$username,$password);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .awm {
        display: grid;
        justify-content: center;
        align-items: center;
        margin-block: 7rem;
    }
    </style>
</head>

<body>
    <div class="awm mx-3">
        <div class="container-fluid bg-dark text-light py-3">
            <header class="text-center">
                <h1 class="display-6">Register</h1>
            </header>
        </div>
        <section class="container py-3">
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
                    <input type="tel" name="phone" class="form-control" id="phone" required>
                </div>
                <div class="col-4 col-md-3">
                    <label for="inputPhNb4" class="form-label lAddress">Address</label>
                    <textarea type="tel" name="address" class="form-control" id="address" required></textarea>
                </div>
                <div class="col-12">
                    <button type="submit" name="submit" class="btn btn-dark px-3">Sign in</button>
                    <a href="login.php" class="px-2" style="text-decoration: none;">Already Have An Account?</a>
                </div>
            </form>
        </section>
    </div>
    <script src="../js/registration.js"></script>
</body>

</html>

<?php

if(isset($_POST['submit'])){

    $emailCheck = $database->prepare('SELECT Email FROM users WHERE Email = :email');
    $emailCheck->bindParam(':email',$_POST['email']);
    $emailCheck->execute();
    
    if($emailCheck->rowCount()===0){
        if($_POST['role']==='Customer'){
            $insert = $database->prepare('INSERT INTO 
            customers(FName,LName,PhoneNumber,Email,Address)
            VALUES(:FName,	:LName,	:PhoneNumber,:Email	,:Address)
            ');
            $insert->bindParam('FName',$_POST['fname']);
            $insert->bindParam('LName',$_POST['lname']);
            $insert->bindParam('PhoneNumber',$_POST['phone']);
            $insert->bindParam('Email',$_POST['email']);
            $insert->bindParam('Address',$_POST['address']);
            $insert->execute();
            $getId = $database->prepare('SELECT Customer_Id FROM customers WHERE Email = :EMAIL');
            $getId->bindParam("EMAIL",$_POST['email']);
            $getId->execute();
            $customerId = $getId->fetch(PDO::FETCH_ASSOC);
            $cid=$customerId["Customer_Id"];
        }

        $insertUser = $database->prepare('INSERT INTO 
        users(Username,Password,UserType,FName,LName,Email,Customer_Id)
        VALUES(:username,:password,:role,:fname,:lname,:email,:customerId)
        ');
        $insertUser->bindParam('username',$_POST['username']);
        $insertUser->bindParam('password',$_POST['password']);
        $insertUser->bindParam('role',$_POST['role']);
        $insertUser->bindParam('fname',$_POST['fname']);
        $insertUser->bindParam('lname',$_POST['lname']);
        $insertUser->bindParam('email',$_POST['email']);
        $insertUser->bindParam('customerId',$cid);
        $insertUser->execute();
        header("Location: http://localhost/server/marketplace/pages/home.php");
        exit;

    }else{
        echo "<div class='container' style='margin-top: -7rem;'>
        <div class='alert alert-warning' role='alert'>
            Email is already in use. Please choose a different one.
        </div>
      </div>";
    }
    
}
?>