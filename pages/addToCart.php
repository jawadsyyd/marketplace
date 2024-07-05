<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
?>
<?php
if (isset($_GET['id']) && isset($_GET['username']) && isset($_GET['havePromotion'])) {
    $checkUserType = $database->prepare("SELECT UserType FROM users WHERE Username = :Username");
    $checkUserType->bindParam("Username", $_GET['username']);
    $checkUserType->execute();
    $userType = $checkUserType->fetchColumn();
    if ($userType == 'Admin') {
        header('location:http://localhost/server/marketplace/pages/showProducts.php');
    } else {
        if ($_GET['havePromotion'] === 'false') {
            $getProductId = $database->prepare('SELECT Product_Id,Price FROM Products WHERE Product_Id = :Product_Id');
            $getProductId->bindParam("Product_Id", $_GET['id']);
            $getProductId->execute();
            $productClicked = $getProductId->fetch();

            $getCustomerId = $database->prepare('SELECT Customer_Id FROM users WHERE Username = :Username');
            $getCustomerId->bindParam("Username", $_GET['username']);
            $getCustomerId->execute();
            $idOfCustomer = $getCustomerId->fetch();

            $checkProduct = $database->prepare("SELECT * FROM orders WHERE Product_Id=:Product_Id AND Customer_Id=:Customer_Id");
            $checkProduct->bindParam("Product_Id", $productClicked['Product_Id']);
            $checkProduct->bindParam("Customer_Id", $idOfCustomer['Customer_Id']);
            $checkProduct->execute();
            $isHere = $checkProduct->fetch();

            if ($isHere) {
                echo '<div class="container mt-4">
                <!-- Faild alert -->
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                  <strong>Faild!</strong> The product is  already in your cart.
                    <div class="row my-1"><a href="http://localhost/server/marketplace/pages/cart.php" class="link-dark"><span class="btn bg-warning rounded-pill mb-1">Check my Cart</span></a>
                </div>
              </div>';
            } else {

                $addToCard = $database->prepare('INSERT INTO orders(Price,Customer_Id,Product_Id) VALUES(:Price,:Customer_Id,:Product_Id)');
                // $addToCard->bindParam("Qty",);
                $addToCard->bindParam("Price", $productClicked['Price']);
                $addToCard->bindParam("Customer_Id", $idOfCustomer['Customer_Id']);
                $addToCard->bindParam("Product_Id", $productClicked['Product_Id']);
                if ($addToCard->execute()) {
                    header("location:http://localhost/server/marketplace/pages/showProducts.php");
                }
            }
        } else {
            $getProductId = $database->prepare('SELECT Product_Id,Price FROM Products WHERE Product_Id = :Product_Id');
            $getProductId->bindParam("Product_Id", $_GET['id']);
            $getProductId->execute();
            $productClicked = $getProductId->fetch();

            $getCustomerId = $database->prepare('SELECT Customer_Id FROM users WHERE Username = :Username');
            $getCustomerId->bindParam("Username", $_GET['username']);
            $getCustomerId->execute();
            $idOfCustomer = $getCustomerId->fetch();

            $checkProduct = $database->prepare("SELECT * FROM orders WHERE Product_Id=:Product_Id AND Customer_Id=:Customer_Id");
            $checkProduct->bindParam("Product_Id", $productClicked['Product_Id']);
            $checkProduct->bindParam("Customer_Id", $idOfCustomer['Customer_Id']);
            $checkProduct->execute();
            $isHere = $checkProduct->fetch();

            if ($isHere) {
                echo '<div class="container mt-4">
                <!-- Faild alert -->
                <div class="alert alert-warning alert-dismissible fade show text-center" role="alert">
                  <strong>Faild!</strong> The product is  already in your cart.
                    <div class="row my-1"><a href="http://localhost/server/marketplace/pages/cart.php" class="link-dark"><span class="btn bg-warning rounded-pill mb-1">Check my Cart</span></a>
                </div>
              </div>';
            } else {

                $discountPercent = $_GET['discountValue'];

                $newPrice = $productClicked['Price'] * (1 - ($discountPercent / 100));

                $newPrice = round($newPrice, 2);


                $addToCard = $database->prepare('INSERT INTO orders(Price,Customer_Id,Product_Id) VALUES(:Price,:Customer_Id,:Product_Id)');
                // $addToCard->bindParam("Qty",);
                $addToCard->bindParam("Price", $newPrice);
                $addToCard->bindParam("Customer_Id", $idOfCustomer['Customer_Id']);
                $addToCard->bindParam("Product_Id", $productClicked['Product_Id']);
                if ($addToCard->execute()) {
                    header("location:http://localhost/server/marketplace/pages/showProducts.php");
                }
            }
        }
    }
}
?>