<?php
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;',$username,$password);
    session_start();
    if(empty($_SESSION['user_type'])){
        header("Location : http://localhost/server/marketplace/pages/login.php");
        exit();
    }
    include('./nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Your Shopping Cart</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>

  <header class="container py-3 d-flex justify-content-between align-items-center">
    <h1 class="display-4">Your Shopping Cart</h1>
    <a href="http://localhost/server/marketplace/pages/showProducts.php" class="btn btn-outline-secondary">Continue Shopping</a>
  </header>

  <main class="container mb-5">
    <div class="row">
      <div class="col-md-8" id="cart-items">
        </div>
      <div class="col-md-4">
        <div class="card border-0 shadow rounded-3 bg-light">  <h2 class="card-header text-center py-3">Cart Summary</h2>
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
  </main>

  <script src="cart.js"></script>

</body>
</html>
