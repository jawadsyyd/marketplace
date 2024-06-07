<?php
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
    if(isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];

        $delete = $database->prepare("DELETE FROM products WHERE Products_id=$id");
        $delete->execute();
        header('location:products.php');
    }
?>