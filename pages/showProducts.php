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
include ('./nav.php');
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>showProducts</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
  <div class="container-fluid py-3">
    <div class="row">
      <div class="col-4">
        <h1>Products</h1>
      </div>
      <div class="col-8 position-relative">
        <nav class="navbar  position-absolute end-0">
          <div class="container-fluid">
            <form class="d-flex" role="search" method="post">
              <select class="form-select  text-center me-2 d-sm-flex d-none" id="floatingSelect"
                aria-label="Floating label select example" name="sortBy" onchange="Change()">
                <option selected disabled>Sort By</option>
                <option value="Price">Price</option>
                <option value="Promotions">Promotions</option>
                <!-- GET CATEGORIES START-->
                <?php
                $getCategories = $database->prepare("SELECT Category_Name FROM Categories");
                $getCategories->execute();
                $categoriesNames = $getCategories->fetchAll();
                foreach ($categoriesNames as $name) {
                  echo '<option value="' . $name['Category_Name'] . '">' . $name['Category_Name'] . '</option>';
                }
                ?>
                <!-- GET CATEGORIES START-->
              </select>
              <button class="btn btn-outline-danger me-2 d-none " type="submit" name="sort" id="btnSort">Sort</button>
              <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search"
                name="searchValue">
              <button class="btn btn-outline-danger" type="submit" name="search" id="btnSearch">Search</button>
            </form>
          </div>
        </nav>
      </div>
    </div>
  </div>
  <div class="container">
    <div class="row">
      <?php
      // SEARCH WHEN THE USER CLICK THE SEARCH BUTTON [START]
      if (isset($_POST['search']) && $_POST['searchValue'] != '') {
        $searchValue = '%' . $_POST['searchValue'] . '%';
        $search = $database->prepare("SELECT * FROM Products WHERE Name LIKE :searchValue");
        $search->bindParam('searchValue', $searchValue);
        $search->execute();
        $searchProduct = $search->fetchAll();
        foreach ($searchProduct as $product) {
          echo "
    <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
        <div class='card' style='width: 19rem;'>
            <img src='../products_images/" . $product["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
            <div class='card-body'>
                <h5 class='card-title' style='color:#457B9D'>" . $product['Name'] . "</h5>
                <p style='height: 10px;'>" . $product['Description'] . "</p>
            </div>
            <div class='text-center mt-3 rounded-bottom py-2' style='background-color:#1D3557;'>
                <span class='fs-6' style='color:#F1FAEE '>$" . $product['Price'] . "</span>
                <br>
            </div>
        </div>
    </div>";
        }
      }
      // SEARCH WHEN THE USER CLICK THE SEARCH BUTTON [END]
      if (isset($_POST['sort'])) {

        if (empty($productsByPrice) && empty($details) && empty($productsSortedByCat)) {
          echo "<p class='text-center mt-3'>No products found under this sort/category.</p>";
        } else {

        }
        if ($_POST['sortBy'] === 'Price') {
          $sales = $database->prepare("SELECT prom.Discount_Value, prod.Price, prod.Product_Id, prod.Name, prod.Price, prod.Description, prod.Image FROM Product_promotion details
                             JOIN Promotions prom ON details.Promotion_Id = prom.Promotion_Id
                             JOIN Products prod ON details.Product_Id = prod.Product_Id");
          $sales->execute();
          $promotionSales = $sales->fetchAll();
          foreach ($promotionSales as $promotion) {
            echo "
          <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
              <div class='card' style='width: 19rem;'>
                  <img src='../products_images/" . $promotion["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                  <div class='card-body'>
                      <h5 class='card-title' style='color:#457B9D'>" . $promotion['Name'] . "</h5>
                      <p style='height: 10px;'>" . $promotion['Description'] . "</p>
                  </div>
                  <div class='text-center mt-3 rounded-bottom py-2' style='background-color:#1D3557;'>
                      <span class='fs-6' style='color:#F1FAEE '>$" . $promotion['Price'] . "</span>
                      <br>
                  </div>
              </div>
          </div>";
          }
          $getProducts = $database->prepare("SELECT p.Name, p.Description, p.Image, p.Price 
          FROM products p LEFT JOIN product_promotion prom ON p.Product_Id = prom.Product_Id
          WHERE prom.Product_Id IS NULL ORDER BY p.Price ASC");
          $getProducts->execute();
          $productsByPrice = $getProducts->fetchAll();
          foreach ($productsByPrice as $product) {
            echo "
          <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
              <div class='card' style='width: 19rem;'>
                  <img src='../products_images/" . $product["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                  <div class='card-body'>
                      <h5 class='card-title' style='color:#457B9D'>" . $product['Name'] . "</h5>
                      <p style='height: 10px;'>" . $product['Description'] . "</p>
                  </div>
                  <div class='text-center mt-3 rounded-bottom py-2' style='background-color:#1D3557;'>
                      <span class='fs-6' style='color:#F1FAEE '>$" . $product['Price'] . "</span>
                      <br>
                  </div>
              </div>
          </div>";
          }
        }
        // SORT PRODUCTS BY PRICE END
      
        // SORT PRODUCTS BY PROMOTION START
        else if ($_POST['sortBy'] === 'Promotions') {
          $getProductsId = $database->prepare("SELECT Product_Id FROM product_promotion");
          $getProductsId->execute();
          $productsIds = $getProductsId->fetchAll();
          foreach ($productsIds as $productsId) {
            $getProductDetails = $database->prepare("SELECT *FROM Products WHERE Product_Id = :Product_Id");
            $getProductDetails->bindParam("Product_Id", $productsId['Product_Id']);
            $getProductDetails->execute();
            $details = $getProductDetails->fetchAll();
            foreach ($details as $detailsOfProduct) {
              echo "
          <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
              <div class='card' style='width: 19rem;'>
                  <img src='../products_images/" . $detailsOfProduct['Image'] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                  <div class='card-body'>
                      <h5 class='card-title' style='color:#457B9D'>" . $detailsOfProduct['Name'] . "</h5>
                      <p style='height: 10px;'>" . $detailsOfProduct['Description'] . "</p>
                  </div>
                  <div class='text-center mt-3 rounded-bottom py-2' style='background-color:#1D3557;'>
                      <span class='fs-6' style='color:#F1FAEE '>$" . $detailsOfProduct['Price'] . "</span>
                      <br>
                  </div>
              </div>
          </div>";
            }
          }
        }
        // SORT PRODUCTS BY PROMOTION END
      
        // SORT PRODUCTS BY CATEGORIES START
        else {
          $getCatId = $database->prepare("SELECT Category_Id FROM categories WHERE Category_Name = :Category_Name");
          $getCatId->bindParam("Category_Name", $_POST['sortBy']);
          $getCatId->execute();
          $catIds = $getCatId->fetchAll();
          foreach ($catIds as $idOfCat) {
            $getProductsByCat = $database->prepare("SELECT * FROM products WHERE Category_Id = :Category_Id");
            $getProductsByCat->bindParam("Category_Id", $idOfCat['Category_Id']);
            $getProductsByCat->execute();
            $productsSortedByCat = $getProductsByCat->fetchAll();
            foreach ($productsSortedByCat as $productSortedByCat) {
              echo "
          <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
              <div class='card' style='width: 19rem;'>
                  <img src='../products_images/" . $productSortedByCat['Image'] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                  <div class='card-body'>
                      <h5 class='card-title' style='color:#457B9D'>" . $productSortedByCat['Name'] . "</h5>
                      <p style='height: 10px;'>" . $productSortedByCat['Description'] . "</p>
                  </div>
                  <div class='text-center mt-3 rounded-bottom py-2' style='background-color:#1D3557;'>
                      <span class='fs-6' style='color:#F1FAEE '>$" . $productSortedByCat['Price'] . "</span>
                      <br>
                  </div>
              </div>
          </div>";
            }
          }
        }
        // SORT PRODUCTS BY CATEGORIES END
      
      }
      // SORT PRODUCTS BY PRICE START
      ?>
    </div>
  </div>
  <script>
    var btnSort = document.getElementById('btnSort');
    var btnSearch = document.getElementById('btnSearch');

    function Change() {
      btnSort.click();
    }

  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
    crossorigin="anonymous"></script>
</body>

</html>

<?php
include ("./footer.php");
?>