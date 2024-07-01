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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Shopping Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    #btnContinue {
      border: 1px solid #1D3557;
    }

    #btnContinue:hover {
      background-color: #1D3557;
      color: #F1FAEE;
    }

    #subTitle {
      background-color: #457B9D;
      color: #F1FAEE;
      font-weight: bold;
    }

    #checkout-btn {
      background-color: #E63946;
      color: #F1FAEE;
    }
  </style>
</head>

<body>

  <header class="container py-3 d-flex justify-content-between align-items-center">
    <h1 class="display-4" style="color: #1D3557;">Your Shopping Cart</h1>
    <a href="http://localhost/server/marketplace/pages/showProducts.php" class="btn" id="btnContinue">Continue Shopping</a>
  </header>

  <main class="container mb-5">
    <div class="row">

      <?php
      // GET CUSTOMER_ID START
      $getId = $database->prepare("SELECT Customer_Id FROM users WHERE Username = :Username");
      $getId->bindParam("Username", $customerName);
      $getId->execute();
      $customerid = $getId->fetch();
      // GET CUSTOMER_ID END

      // GET PRODUCTS_ID START
      $getProduct = $database->prepare("SELECT Product_Id FROM orders WHERE Customer_Id = :Customer_Id");
      $getProduct->bindParam("Customer_Id", $customerid['Customer_Id']);
      $getProduct->execute();
      $products = $getProduct->fetchAll();
      // GET PRODUCTS_ID END

      // DISPLAY PRODUCTS IN CARD STRAT
      foreach ($products as $product) {
        // START Price

        $checkPromotion = $database->prepare('SELECT Product_Id FROM product_promotion WHERE Product_Id = :Product_Id');
        $checkPromotion->bindParam('Product_Id', $product['Product_Id']);
        $checkPromotion->execute();
        $havePromotion = $checkPromotion->fetchColumn();

        if ($havePromotion) {
          $getPriceAfterPromotion = $database->prepare('SELECT P.Price, promotions.Discount_Value 
          FROM products P
          INNER JOIN product_promotion PP ON P.Product_Id = PP.Product_Id
          INNER JOIN promotions ON PP.Promotion_Id = promotions.Promotion_Id WHERE P.Product_Id = :Product_Id');
          $getPriceAfterPromotion->bindParam('Product_Id', $product['Product_Id']);
          $getPriceAfterPromotion->execute();
          $priceAfterPromotion = $getPriceAfterPromotion->fetch();
          $priceINeed = $priceAfterPromotion['Price'] - ($priceAfterPromotion['Price'] * $priceAfterPromotion['Discount_Value'] / 100);
        } else {
          $getPriceBeforePromotion = $database->prepare("SELECT Price FROM products WHERE Product_Id = :Product_Id");
          $getPriceBeforePromotion->bindParam('Product_Id', $product['Product_Id']);
          $getPriceBeforePromotion->execute();
          $priceBeforePromotion = $getPriceBeforePromotion->fetchColumn();
          $priceINeed = $priceBeforePromotion;
        }

        $getPrice = $database->prepare("SELECT Price,Qty FROM orders WHERE Customer_Id = :Customer_Id AND Product_Id = :Product_Id");
        $getPrice->bindParam("Customer_Id", $idOfCustomer['Customer_Id']);
        $getPrice->bindParam("Product_Id", $product['Product_Id']);
        $getPrice->execute();
        $price = $getPrice->fetch();

        // END Price
        $productDetails = $database->prepare("SELECT * FROM Products WHERE Product_Id = :Product_Id");
        $productDetails->bindParam("Product_Id", $product['Product_Id']);
        $productDetails->execute();
        $details = $productDetails->fetch();
        echo '
        <div class="col-md-12 my-3" id="cart-items">
            <div class="row align-items-center">
              <div class="col-md-2">
                <img src="../products_images/' . $details['Image'] . '" class="img-fluid rounded-start" alt="...">
              </div>
            <div class="col-md-4">
              <div class="card-body">
                <h5 class="card-title">' . $details['Name'] . '</h5>
                <p class="card-text">' . $details['Description'] . '</p>
              </div>
            </div>
            <div class="col-md-2  text-center">
              <div class="card-body">
                <p class="card-text">$<b>' . $priceINeed . '</b></p>
              </div>
            </div>
            <div class="col-md-1 text-center d-flex align-items-center">
              <div class="card-body d-flex align-items-center  justify-content-center bg-dark text-light rounded">
                <button class="btn text-light"><a href="http://localhost/server/marketplace/pages/decrease.php?productId=' . $details['Product_Id'] . '" class="link-light link-underline-opacity-0">-</a></button>
                <span class="card-text px-2 fw-semibold">' . $price['Qty'] . '</span>
                <button class="btn text-light"><a href="http://localhost/server/marketplace/pages/increase.php?productId=' . $details['Product_Id'] . '" class="link-light link-underline-opacity-0">+</a></button>
              </div>
            </div>
            <div class="col-md-2  text-center">
              <div class="card-body">
                <p class="card-text">$<b>' . $price['Price'] . '</b></p>
              </div>
            </div>
            <div class="col-md-1  text-center">
              <div class="card-body">
                <a class="btn btn-danger rounded-circle flex align-items-center" href="http://localhost/server/marketplace/pages/deleteProductFromCart.php?deleteid=' . $product['Product_Id'] . '&customerId=' . $idOfCustomer['Customer_Id'] . '"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg></a>
              </div>
            </div>
        </div>
        ';
      }
      // DISPLAY PRODUCTS IN CARD END
      ?>
    </div>

    <!-- START CAT SUMMARY -->
    <div class="row">
      <div class="col-md-12 mb-3">
        <div class="card border-0 shadow rounded-3 bg-light">
          <h2 class="card-header text-center py-3" id="subTitle">Cart Summary</h2>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
              <strong style="color: #1D3557;">Total:</strong>
              <span id="total">

                <?php
                $getId = $database->prepare("SELECT Customer_Id FROM users WHERE Username = :Username");
                $getId->bindParam("Username", $customerName);
                $getId->execute();
                $customerid = $getId->fetch();
                $total = $database->prepare("SELECT SUM(Price) FROM orders WHERE Customer_Id = :Customer_Id");
                $total->bindParam("Customer_Id", $customerid['Customer_Id']);
                $total->execute();
                $totalPrice = $total->fetchColumn();
                if ($totalPrice) {
                  echo '<span style="color: #1D3557;">' . $totalPrice . ' $</span>';
                } else {
                  echo '<span style="color: #1D3557;">0.00 $</span>';
                }
                ?>

              </span>
            </li>
            <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
              <strong style="color: #1D3557;">TVA:</strong>
              <span id="total" style="color: #1D3557;">11 %</span>
            </li>
            <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
              <strong style="color: #1D3557;">Final Price:</strong>
              <span id="total" style="color: #1D3557;">
                <?php
                $finalPrice = $totalPrice + ($totalPrice * 11 / 100);
                if ($finalPrice) {
                  echo $finalPrice . ' $';
                } else {
                  echo '0.00 $';
                }
                ?>
              </span>
            </li>
          </ul>
        </div>
        <br>
        <button type="button" name="submit" class="btn w-100 my-1" style="background-color:#1D3557;"><a class="text-light" style="text-decoration: none;" href="http://localhost/server/marketplace/pages/deleteOrder.php">Clear Cart</a></button>
        <button type="button" name="submit" class="btn w-100 my-1" id="checkout-btn"><a class="text-light" style="text-decoration: none;" href="http://localhost/server/marketplace/pages/checkCredit.php">Proceed to Checkout</a></button>
      </div>
    </div>
    <!-- END CAT SUMMARY -->

  </main>

  <script src="cart.js"></script>

</body>

</html>