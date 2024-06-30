<?php
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);

    if(isset($_GET['rejectId'])){
        $id = $_GET['rejectId'];

        $delete = $database->prepare("DELETE FROM users WHERE User_id=$id");
        $delete->execute();
        header('location:http://localhost/server/marketplace/pages/admins.php');
    }
?>