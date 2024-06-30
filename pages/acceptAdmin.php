<?php 
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);

    if(isset($_GET['acceptId'])){
        $id = $_GET['acceptId'];

        $activate = true;
        $updateUser = $database->prepare("UPDATE users set Activated = :Activated WHERE User_id = $id");
        $updateUser->bindParam('Activated', $activate);
        $updateUser->execute();
        header("Location:http://localhost/server/marketplace/pages/admins.php");
    }
?>