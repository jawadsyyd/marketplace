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
  <title>Products Shopping</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <!-- START SLIDER -->
  <div class="container">
    <div class="row justify-content-center">
      <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel" style="max-width: 500px;">
        <div class="carousel-inner">
          <div class="carousel-item active" data-bs-interval="5000">
            <img src="https://placehold.co/600x400/black/white" class="d-block w-100 position-relative" alt="...">
            <div class="position-absolute end-50 top-50 z-1001">
              <div class="row">
                <div class="col-12 text-center">
                  <h3 class="display-6">Lorem, ipsum dolor.</h3>
                  <h1 class="display-5  d-none d-md-block d-xl-block">Lorem ipsum dolor sit.</h1>
                  <button class="btn btn-dark rounded-pill text-uppercase btn-sm">VIEW
                    COLLECTION</button>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item" data-bs-interval="2500">
            <img src="https://placehold.co/600x400/black/white" class="d-block w-100 position-relative" alt="...">
            <div class="position-absolute end-50 top-50 z-1001 flex">
              <div class="row">
                <div class="col-12 text-center">
                  <h3 class="display-6">Lorem, ipsum dolor.</h3>
                  <h1 class="display-5  d-none d-md-block d-xl-block">Lorem ipsum dolor sit.</h1>
                  <button class="btn btn-dark rounded-pill text-uppercase btn-sm">VIEW COLLECTION</button>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <img src="https://placehold.co/600x400/black/white" class="d-block w-100 position-relative" alt="...">
            <div class="position-absolute end-50 top-50 z-1001 flex">
              <div class="row">
                <div class="col-12 text-center">
                  <h3 class="display-6">Lorem, ipsum dolor.</h3>
                  <h1 class="display-5  d-none d-md-block d-xl-block">Lorem ipsum dolor sit.</h1>
                  <button class="btn btn-dark rounded-pill text-uppercase btn-sm">VIEW COLLECTION</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!-- prev next -->
      </div>
    </div>
    <div class="row">
      <div class="col-md-6 col-12 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 position-relative ">
        <img src="https://placehold.co/558x200/white/black" alt="" class="img-fluid">
        <div class="position-absolute start-50 bottom-0 mb-5 text-center">
          <h5 class="d-none d-xl-block">Lorem, ipsum dolor.</h5>
          <p class="d-none d-xl-block">Lorem, ipsum dolor.</p>
        </div>
      </div>
      <div class="col-md-6 col-12 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 position-relative ">
        <img src="https://placehold.co/558x200/white/black" alt="" class="img-fluid">
        <div class="position-absolute start-50 bottom-0 mb-5 text-center">
          <h5 class="d-none d-xl-block">Lorem, ipsum dolor.</h5>
          <p class="d-none d-xl-block">Lorem, ipsum dolor.</p>
        </div>
      </div>
    </div>
    <!-- END SLIDER -->
    <div class="container-fluid">
      <div class="my-5 justify-content-around">
        <div class="row my-5">
          <div class="col-12 col-sm-10">
            <div class="row">
              <?php
              if ($_SERVER['REQUEST_URI'] == "/server/marketplace/pages/showProducts.php") {
                $selectAllProducts = $database->prepare("SELECT * FROM products ORDER BY Category_Id ASC");
                $selectAllProducts->execute();
                $products = $selectAllProducts->fetchAll();
                foreach ($products as $product) {
                  $name = $product["Name"];
                  $description = $product["Description"];
                  $price = $product["Price"];
                  $image = $product["Image"];
                  echo "<div class='col-xxl-3 col-xl-4 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center'>
                                <div class='card' style='width: 18rem; height: 400px;'>
                                    <img src='../products_images/$image' class='card-img-top img-fluid' alt='...'
                                        style='width: 100%; height: 200px; object-fit:contain;'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>$name</h5>
                                        <p style='height: 10px;'>$description</p>
                                        <div class='row pt-4'>
                                            <div class='col-12 pt-1'>
                                                <span class='fw-semibold'>$</span><span class='fw-semibold'>$price</span>
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
                                                <a href='http://localhost/server/marketplace/pages/showProducts.php?id=" . $product['Product_Id'] . "&username=" . $customerName . "'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24'
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
              } else if (preg_match("~^/server/marketplace/pages/showProducts.php/([^/]+)$~", $_SERVER['REQUEST_URI'], $matches)) {
                // Extract catName from the URL
                $catName = $matches[1];
                // Decode URL encoded characters
                $catName = urldecode($catName);

                $getCategoryId = $database->prepare("SELECT Category_Id FROM categories WHERE Category_Name=:categoryName");
                $getCategoryId->bindParam("categoryName", $catName);
                $getCategoryId->execute();
                $currentCategoryId = $getCategoryId->fetchColumn();

                $selectAllProducts = $database->prepare("SELECT * FROM products WHERE Category_Id = :categoryId ORDER BY Name ASC");
                $selectAllProducts->bindParam('categoryId', $currentCategoryId);
                $selectAllProducts->execute();
                $products = $selectAllProducts->fetchAll();
                if (count($products) > 0) {
                  foreach ($products as $product) {
                    $image = $product['Image'];
                    echo "<div class='col-xxl-3 col-xl-4 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center'>
                                <div class='card' style='width: 18rem; height: 400px;'>
                                    <img src='../products_images/$image' class='card-img-top img-fluid' alt='...'
                                        style='width: 100%; height: 200px; object-fit:contain;'>
                                    <div class='card-body'>
                                        <h5 class='card-title'>" . $product['Name'] . "</h5>
                                        <p style='height: 10px;'>" . $product['Description'] . "</p>
                                        <div class='row pt-4'>
                                            <div class='col-12 pt-1'>
                                                <span class='fw-semibold'>$</span><span class='fw-semibold'>" . $product['Price'] . "</span>
                                            </div>
                                            </div>
                                            <br>
                                        <div class='row d-flex align-items-center'>
                                            <div class='col-6'>
                                                <div class='quantity-section d-flex'>
                                                    <button class='btn btn-outline-secondary quantity-button decrease d-flex align-items-center me-1' style='height: 34px;'>-</button>
                                                    <input type='number' class='quantity-input me-1 text-center' value='1' min='1' style='width:40px; height: 34px; padding: 2px;'>
                                                    <button class='btn btn-outline-secondary quantity-button increase d-flex align-items-center' style='height: 34px;'>+</button>
                                                </div>
                                            </div>
                                            <div class='col-2'></div>
                                            <div class='col-4'>
                                                <a href='http://localhost/server/marketplace/pages/showProducts.php?id=" . $product['Product_Id'] . "&username=" . $customerName . "'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24'
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
                } else {
                  echo '<div class="container"><div class="row"><div class"col-12"><h1>No Products Found in This Category</h1></div></div></div>';
                }
              }
              ?>
            </div>
          </div>
          <div class="col-sm-2 col-12 position-relative d-none d-sm-block">
            <ul class="navbar-nav bg-dark-subtle text-center position-md-absolute start-0" style="border-radius: 5px;">
              <h4>
                <?php
                $countProducts = $database->prepare("SELECT COUNT(*) FROM products");
                $countProducts->execute();
                $nbOfProducts = $countProducts->fetchColumn();
                ?>
                <a class="nav-link link-dark active" id="AllCategories" href="http://localhost/server/marketplace/pages/showProducts.php">All Products<span class="px-1"><?php echo "(" . $nbOfProducts . ")" ?></span></a>
              </h4>
              <?php

              $getCategoriesNames = $database->prepare("SELECT Category_Name FROM categories");
              $getCategoriesNames->execute();
              $categoriesNames = $getCategoriesNames->fetchAll();
              foreach ($categoriesNames as $catName) {
                $countProductsByCat = $database->prepare("SELECT COUNT(*) FROM products JOIN categories ON products.Category_Id = categories.Category_Id WHERE categories.category_Name = :CatName");
                $countProductsByCat->bindParam("CatName", $catName['Category_Name']);
                $countProductsByCat->execute();
                $nbOfProInCat = $countProductsByCat->fetchColumn();
                echo '<li class="nav-item" id="' . $catName['Category_Name'] . '" >
                    <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/showProducts.php/' . $catName["Category_Name"] . "#" . $catName["Category_Name"] . '" aria-disabled="true">' . $catName["Category_Name"] . " (" . $nbOfProInCat . ") " . '</a>
                </li>';
              }
              ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
  include("./footer.php");
  ?>
  <!-- EDITED BY JAWAD --> <!-- get customerId,productId and add data to table [`orders`] -->

  <?php

    if (isset($_GET['id']) && isset($_GET['username'])) {

        $getProductId = $database->prepare('SELECT Product_Id FROM Products WHERE Product_Id = :Product_Id');
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

            $addToCard = $database->prepare('INSERT INTO orders(Customer_Id,Product_Id) VALUES(:Customer_Id,:Product_Id)');
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