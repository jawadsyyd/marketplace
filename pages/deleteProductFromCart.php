<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
      if (isset($_GET['deleteid'])){
        $id = $_GET['deleteid'];
        $deleteProduct = $database->prepare("DELETE FROM orders WHERE Product_Id = $id");
        if($deleteProduct->execute()){
          $productDetails = $database->prepare("SELECT * FROM Products WHERE Product_Id = :Product_Id");
        $productDetails->bindParam("Product_Id", $id);
        $productDetails->execute();
        $details = $productDetails->fetch();
          $deleted_product_name = $details['Name'];
          header('location:http://localhost/server/marketplace/pages/cart.php');
        }
      }
      ?>