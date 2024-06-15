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
    <title>Add Promotion</title>
</head>

<body class="my-5 mx-5">
    <div class="container-fluid border" style="border-radius: 10px; background-color: rgb(188, 227, 226);">
        <h1 class="mt-3 text-center">Add Promotion</h1>
        <form id="doctorForm" method="POST">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productName" class="form-label fw-semibold">Name:</label>
                        <input type="text" class="form-control" id="" name="name" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productPrice" class="form-label fw-semibold">Discount Type:</label>
                        <input type="text" name="discountType" class="form-control" id="" required>
                    </div>
                </div>
                <div class="row">
                <div class="col-md-6 mb-3">
                        <label for="productDescription" class="form-label fw-semibold">Start date:</label>
                        <input type="date" name="startDate" class="form-control" id="" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productImage" class="form-label fw-semibold">discount Value:</label>
                        <input type="text" name="discountValue" class="form-control" id="" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qtyInStock" class="form-label fw-semibold">End Date:</label>
                        <input type="date" name="endDate" class="form-control" id="" required>
                    </div>
                </div>
            </div>
            <div class="text-center mb-3">
                <button type="submit" name="submit" class="btn btn-primary" id="update">Add Promotion</button>
            </div>
            <?php
if(isset($_POST['submit'])){
    $insertPromotion = $database->prepare("INSERT INTO promotions(Name, Start_Date, End_Date, Discount_Type, Discount_Value)
    VALUES(:Name,:Start_Date,:End_Date,:Discount_Type,:Discount_Value)");

    $start_date = date("Y-m-d", strtotime($_POST['startDate']));
    $end_date = date("Y-m-d", strtotime($_POST['endDate']));

    $insertPromotion->bindParam("Name",$_POST['name']);
    $insertPromotion->bindParam("Start_Date",$start_date);
    $insertPromotion->bindParam("End_Date",$end_date);
    $insertPromotion->bindParam("Discount_Type",$_POST['discountType']);
    $insertPromotion->bindParam("Discount_Value",$_POST['discountValue']);
    if($insertPromotion->execute()){
        header("Location: http://localhost/server/marketplace/pages/promotions.php");
    }else{
        echo '<div class="alert alert-danger" role="alert">
  A simple danger alert—check it out!
</div>';
    }
}
?>
        </form>
    </div>
</body>

</html>