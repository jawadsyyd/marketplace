<?php
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;',$username,$password);
    session_start();
        if(empty($_SESSION['user_type'])){
            header("Location : http://localhost/server/marketplace/pages/Login.php");
        }
        if($_SESSION['user_type'] === 'Customer'){
            header("Location : http://localhost/server/marketplace/pages/home.php");
        }
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
</head>

<body class="my-5 mx-5">
    <div class="container-fluid border" style="border-radius: 10px; background-color: rgb(188, 227, 226);">
        <h1 class="mt-3 text-center">Add Product</h1>
        <form id="doctorForm" method="POST" enctype="multipart/form-data">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productName" class="form-label fw-semibold">Name:</label>
                        <input type="text" class="form-control" id="productName" name="productName" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productDescription" class="form-label fw-semibold">Description:</label>
                        <textarea type="text" class="form-control" id="productDescription" name="productDescription"
                            required></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qtyInStock" class="form-label fw-semibold">Quantity In Stock:</label>
                        <input type="text" class="form-control" id="qtyInStock" name="qtyInStock" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productPrice" class="form-label fw-semibold">Price:</label>
                        <input type="tel" class="form-control" id="productPrice" name="productPrice" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productImage" class="form-label fw-semibold">Image:</label>
                        <input type="file" class="form-control" id="productImage" name="productImage" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productCategory" class="form-label fw-semibold">Category:</label>
                        <select name="Categories" id="Categories" class="form-select">
                            <?php
                            $getCategoryName = $database->prepare("SELECT Category_Name FROM categories");
                            $getCategoryName->execute();
                            if($getCategoryName->rowCount()>0){
                                foreach ($getCategoryName as $CatName) {
                                    echo "<option value='".$CatName['Category_Name']."'>". $CatName['Category_Name'] ."</option>";
                                }
                            }else{
                                echo "<option value='NotFound' selected>Not Found</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary" id="submit">Add Product</button>
            </div>

            <?php

            if (isset($_POST['submit'])) {

                $image = $_FILES['productImage']['name'];
                $temporary_image = $_FILES['productImage']['tmp_name'];

                move_uploaded_file($temporary_image, "../products_images/$image");

                $getCategoryId = $database->prepare('SELECT Category_Id FROM categories WHERE Category_Name = :CatName');
                $getCategoryId->bindParam("CatName",$_POST['Categories']);
                $getCategoryId->execute();
                $category_id = $getCategoryId->fetchColumn();
                
                $insert = $database->prepare("INSERT INTO products (Name, Description, Qty_In_Stock, Price, Image, Category_Id) 
                VALUES(:Name, :Description, :Qty_In_Stock,:Price, :Image, :Category_Id)");
                $insert->bindParam('Name', $_POST['productName']);
                $insert->bindParam('Description', $_POST['productDescription']);
                $insert->bindParam('Price', $_POST['productPrice']);
                $insert->bindParam('Image', $image);
                $insert->bindParam('Qty_In_Stock', $_POST['qtyInStock']);
                $insert->bindParam('Category_Id',$category_id);
                $insert->execute();
                header("Location: http://localhost/server/marketplace/pages/products.php");
            }
            ?>
        </form>
    </div>
</body>

</html>