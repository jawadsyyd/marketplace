<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<?php
if(isset($_GET['code'])){

    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;',$username,$password);

    $checkCode = $database->prepare("SELECT Security_Code FROM users WHERE Security_Code = :Security_Code");
    $checkCode->bindParam("Security_Code",$_GET['code']);
    $checkCode->execute();
    if($checkCode->rowCount()>0){
        $update = $database->prepare("UPDATE users SET Security_Code  = :newSecurity_Code , Activated = true WHERE Security_Code  = :Security_Code");
        $securityCode = md5(date("h:i:s"));
        $update->bindParam("newSecurity_Code",$securityCode);
        $update->bindParam("Security_Code",$_GET['code']);
        if($update->execute()){
            echo '<div class="container-fluid my-5">';
            echo '<div class="alert alert-success" role="alert">Verification Done</div>';
            echo '<a class="btn btn-warning" href="http://localhost/server/marketplace/pages/login.php">LogIn</a>';
            echo '</div>';
        }
    }else{
        echo '<div class="container-fluid my-5">';
        echo '<div class="alert alert-warning" role="alert">Code is distroyed you can register using another email</div>';
        echo '<a class="btn btn-warning" href="http://localhost/server/marketplace/pages/register.php">register Now</a>';
        echo '</div>';
    }
}
?>