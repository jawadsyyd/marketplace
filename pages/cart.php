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
</head>

<body>

  <header class="container py-3 d-flex justify-content-between align-items-center">
    <h1 class="display-4">Your Shopping Cart</h1>
    <a href="http://localhost/server/marketplace/pages/showProducts.php" class="btn btn-outline-secondary">Continue Shopping</a>
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
            <div class="col-md-3">
              <div class="card-body">
                <h5 class="card-title">' . $details['Name'] . '</h5>
                <p class="card-text">' . $details['Description'] . '</p>
              </div>
            </div>
            <div class="col-md-2  text-center">
              <div class="card-body">
                <p class="card-text">$<b>' . $details['Price'] . '</b></p>
              </div>
            </div>
            <div class="col-md-2 text-center">
              <div class="card-body">
                <p class="card-text">' . $details['Qty_In_Stock'] . '</p>
              </div>
            </div>
            <div class="col-md-2  text-center">
              <div class="card-body">
                <p class="card-text">$<b>' . $details['Price'] . '</b></p>
              </div>
            </div>
            <div class="col-md-1  text-center">
              <div class="card-body">
                <button type="button" class="btn btn-dark rounded-circle flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
  <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
</svg>
                </button>
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
          <h2 class="card-header text-center py-3">Cart Summary</h2>
          <ul class="list-group list-group-flush">
            <li class="list-group-item d-flex justify-content-between fw-bold text-primary">
              <strong>Total:</strong>
              $<span id="total">0.00</span>
            </li>
          </ul>
        </div>
        <br>
        <button type="button" class="btn btn-primary w-100" id="checkout-btn">Proceed to Checkout</button>
      </div>
    </div>
    <!-- END CAT SUMMARY -->

  </main>

  <script src="cart.js"></script>

</body>

</html>