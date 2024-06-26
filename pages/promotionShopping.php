<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
session_start();
if (empty($_SESSION['user_type'])) {
    header("Location : http://localhost/server/marketplace/pages/login.php");
    exit();
}
if (!empty($_SESSION['username'])) {
    $customerName = $_SESSION['username'];
} else {
    $customerName = "";
}
include('./nav.php');
?>

<?php
// $sales = $database->prepare("SELECT prom.Discount_Value, prod.Price, prod.Product_Id FROM Product_promotion details
//                              JOIN Promotions prom ON details.Promotion_Id = prom.Promotion_Id
//                              JOIN Products prod ON details.Product_Id = prod.Product_Id");
// $sales->execute();
// if ($sales->rowCount() > 0) {
//     echo "<table class='table-striped-columns table-bordered mt-3 text-center'>";
//     echo "<thead><tr><th>Product ID</th><th>Original Price</th><th>Discount Value</th><th>New Price</th></tr></thead>";

//     while ($row = $sales->fetch(PDO::FETCH_ASSOC)) {
//         $originalPrice = $row['Price'];
//         $discountValue = $row['Discount_Value'];
//         $productId = $row['Product_Id'];

//         $discountedPrice = calculateDiscountedPrice($originalPrice, $discountValue);

//         echo "<tbody>
//             <tr>
//               <td>$productId</td>
//               <td>$$originalPrice</td>
//               <td>$discountValue%</td>
//               <td>$$discountedPrice</td>
//             </tr>
//           </tbody>";
//     }

//     echo "</table>";
// } else {
//     echo "No products with promotions found.";
// }

// function calculateDiscountedPrice($originalPrice, $discountValue)
// {
//     $discount = $originalPrice * ($discountValue / 100);
//     $discountedPrice = $originalPrice - $discount;
//     return $discountedPrice;
// }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sales</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php
    if ($_SERVER['REQUEST_URI'] == "/server/marketplace/pages/promotionShopping.php") {
        $sales = $database->prepare("SELECT prom.Discount_Value, prod.Price, prod.Product_Id, prod.Name, prod.Price, prod.Description, prod.Image FROM Product_promotion details
                             JOIN Promotions prom ON details.Promotion_Id = prom.Promotion_Id
                             JOIN Products prod ON details.Product_Id = prod.Product_Id");

        function calculateDiscountedPrice($originalPrice, $discountValue)
        {
            $discount = $originalPrice * ($discountValue / 100);
            $discountedPrice = $originalPrice - $discount;
            return $discountedPrice;
        }

        $sales->execute();
        $products = $sales->fetchAll();
        echo "<div class='container my-5'>
        <div class='row'>";
        foreach ($products as $product) {
            $name = $product["Name"];
            $description = $product["Description"];
            $price = $product["Price"];
            $discountValue = $product["Discount_Value"];
            $image = $product["Image"];
            $id = $product['Product_Id'];

            $desc = $database->prepare("SELECT Discount_Value FROM promotions INNER JOIN product_promotion ON promotions.Promotion_Id = product_promotion.Promotion_Id WHERE Product_Id = :Product_Id");
            $desc->bindParam("Product_Id", $id);
            $desc->execute();
            $descValue = $desc->fetch();

            $discountedPrice = calculateDiscountedPrice($price, $discountValue);
            echo "
                    <div class='col-xxl-3 col-xl-4 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center'>
                        <div class='card position-relative' style='width: 18rem; height: 400px;'>
                                    <div class='position-absolute end-0 top-0 me-3 mt-2 rounded-circle bg-warning p-2'>" . $descValue['Discount_Value'] . " %</div>
                                    <img src='../products_images/$image' class='card-img-top img-fluid' alt='...'
                                        style='width: 100%; height: 200px; object-fit:contain;'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$name</h5>
                                        <p style='height: 10px;'>$description</p>
                                        <div class='row pt-4'>
                                            <div class='col-12 pt-1'>
                                                <span class='fw-semibold' style='text-decoration: line-through;'>$</span><span class='fw-semibold' style='text-decoration: line-through;'>$price</span> <span class='fw-semibold'>$</span><span class='fw-semibold'>$discountedPrice</span>
                                            </div>
                                            </div>
                                            <br>
                                        <div class='row d-flex align-items-center'>
                                            <div class='col-6'>
                                                <div class='quantity-section d-flex'>

                                                    <button class='btn btn-outline-secondary quantity-button decrease d-flex align-items-center me-1' style='height: 34px;'>-</button>

                                                    <input type='number' class='quantity-input me-1 text-center' name='quantity' value='1' min='1' style='width:40px; height: 34px; padding: 2px;'>

                                                    <button class='btn btn-outline-secondary quantity-button increase d-flex align-items-center' style='height: 34px;'>+</button>

                                                    </div>
                                            </div>
                                            <div class='col-2'></div>
                                            <div class='col-4'>
                                                    <a href='http://localhost/server/marketplace/pages/promotionShopping.php?id=" . $id . "&username=" . $customerName . "'><svg xmlns='http://www.w3.org/2000/svg' width='22' height='22'
                                                        fill='currentColor' class='bi bi-cart3' viewBox='0 0 16 16'>
                                                        <path
                                                            d='M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2' />
                                                    </svg></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                    </div>";
        }
        echo "</div>
        </div>";
    }
    ?>

    <!-- EDITED BY JAWAD --> <!-- get customerId,productId and add data to table [`orders`] -->

    <?php

    if (isset($_GET['id']) && isset($_GET['username'])) {

        $getProductId = $database->prepare('SELECT Product_Id,Price FROM Products WHERE Product_Id = :Product_Id');
        $getProductId->bindParam("Product_Id", $_GET['id']);
        $getProductId->execute();
        $productClicked = $getProductId->fetch();

        $getCustomerId = $database->prepare('SELECT Customer_Id FROM users WHERE Username = :Username');
        $getCustomerId->bindParam("Username", $customerName);
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
            $addToCard->bindParam("Price",$productClicked['Price']);
            $addToCard->bindParam("Customer_Id", $idOfCustomer['Customer_Id']);
            $addToCard->bindParam("Product_Id", $productClicked['Product_Id']);
            if ($addToCard->execute()) {
                echo '<div class="container mt-4">
    <!-- Success alert -->
    <div class="alert alert-success alert-dismissible fade show text-center" role="alert">
      <strong>Success!</strong> The product has been added to your cart successfully.
        <div class="row my-1"><a href="http://localhost/server/marketplace/pages/cart.php" class="link-dark"><span class="btn bg-warning rounded-pill mb-1">View Cart</span></a>
        <a href="http://localhost/server/marketplace/pages/promotionShopping.php" class="link-dark"><span class="btn bg-light rounded-pill" >Continue Shopping</span></a></div>
    </div>
  </div>';
            }
        }
    }
    ?>

    <!-- EDITED BY JAWAD -->

    <script src="../js/quantity.js"></script>
</body>

</html>