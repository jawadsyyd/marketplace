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
    <title>showProducts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid py-3">
        <div class="row">
            <div class="col-4">
                <h1 class="display-5 text-uppercase fw-semibold" style="color: #1D3557;">Products</h1>
            </div>
            <div class="col-8 position-relative">
                <nav class="navbar  position-absolute end-0">
                    <div class="container-fluid">
                        <form class="d-flex" role="search" method="post">
                            <select class="form-select  text-center me-2 d-sm-flex d-none" id="floatingSelect" aria-label="Floating label select example" name="sortBy">
                                <option selected disabled value="Price">Sort By</option>
                                <option value="Price">Price</option>
                                <option value="Promotions">Promotions</option>
                            </select>
                            <select class="form-select  text-center me-2 d-sm-flex d-none" aria-label="Floating label select example" name="sortByCategory">
                                <option selected disabled value="Price">Categories</option>
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
                            <button class="btn btn-outline-danger me-2" type="submit" name="sort" id="btnSort">Sort</button>
                            <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="searchValue">
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
            // NO SORT NO SEARCH
            if (!isset($_POST['search']) && !isset($_POST['sort'])) {
                // SELECT PRODUCTS WITH AND WITHOUT PROMOTION
                // -------------------------------------- SELECT PRODUCTS WITH PROMOTION --------------------------------------
                $getPromotedProducts = $database->prepare("SELECT Product_Id FROM product_promotion");
                $getPromotedProducts->execute();
                $productPromotedId = $getPromotedProducts->fetchAll();
                foreach ($productPromotedId as $idOfProductPromoted) {
                    $productPromotedDetails = $database->prepare("SELECT * FROM products WHERE Product_Id = :Product_Id");
                    $productPromotedDetails->bindParam("Product_Id", $idOfProductPromoted['Product_Id']);
                    $productPromotedDetails->execute();
                    $detailsOfProductPromoted = $productPromotedDetails->fetchAll();
                    foreach ($detailsOfProductPromoted as $detailsPP) {
                        $getpromotionValue = $database->prepare("SELECT Discount_Value FROM promotions INNER JOIN product_promotion ON promotions.Promotion_Id = product_promotion.Promotion_Id WHERE Product_Id = :Product_Id");
                        $getpromotionValue->bindParam("Product_Id", $detailsPP['Product_Id']);
                        $getpromotionValue->execute();
                        $discountValue = $getpromotionValue->fetchAll();
                        foreach ($discountValue as $value) {
                            $discountedPrice = $detailsPP['Price'] - ($detailsPP['Price'] * $value['Discount_Value'] / 100);
                        }
                        echo "
            <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
              <div class='card position-relative' style='width: 19rem;'>
                <span class='position-absolute end-0 top-0 rounded-circle me-2 mt-2 p-1' style='background-color:#E63946;color:#F1FAEE'>" . $value['Discount_Value'] . "%</span>
                <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
                <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $detailsPP['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "true&discountValue=" . $value['Discount_Value'] . "'>
                  <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                    <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                  </svg>
                </a>
              </div>
              <img src='../products_images/" . $detailsPP["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
              <div class='card-body'>
                <h5 class='card-title' style='color:#457B9D'>" . $detailsPP['Name'] . "</h5>
                <p style='height: 10px;'>" . $detailsPP['Description'] . "</p>
              </div>
              <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                <span class='fs-6' style='color:#F1FAEE '><span class='fs-6' style='color:#F1FAEE'><del>$" . $detailsPP['Price'] . "</del></span><b> $" . $discountedPrice . "</b> </span>
                <br>
              </div>
            </div>
            </div>";
                    }
                }

                // -------------------------------------- SELECT PRODUCTS WITHOUT PROMOTION --------------------------------------
                $getProductsNotPromoted = $database->prepare("SELECT P.Product_Id ,P.Image,P.Description,P.Price,P.Name FROM products P LEFT JOIN product_promotion PP ON P.Product_Id = PP.Product_Id WHERE PP.Product_Id IS NULL;");
                $getProductsNotPromoted->execute();
                $productsNotPromoted = $getProductsNotPromoted->fetchAll();
                foreach ($productsNotPromoted as $pnp) {
                    echo "
          <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center'>
            <div class='card  position-relative' style='width: 19rem;'>
              <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
              <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $pnp['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "false" . "'>
                <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                  <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                </svg>
              </a>
            </div>
            <img src='../products_images/" . $pnp['Image'] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
            <div class='card-body'>
                <h5 class='card-title' style='color:#457B9D'>" . $pnp['Name'] . "</h5>
                <p style='height: 10px;'>" . $pnp['Description'] . "</p>
            </div>
            <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                <span class='fs-6' style='color:#F1FAEE '><b>$" . $pnp['Price'] . "</b></span>
                <br>
            </div>
            </div>
          </div>";
                }
            }

            // SEARCH WHEN THE USER CLICK THE SEARCH BUTTON [START]
            if (isset($_POST['search']) && $_POST['searchValue'] != '') {

                // GET PRODUCTS WITH PROMOTION FROM SEARCH END
                $searchValue = '%' . $_POST['searchValue'] . '%';
                $searchOfProductsWithPromotion = $database->prepare("SELECT P.Product_Id, P.Name, P.Description,P.Image, P.Price, PP.Promotion_Id, PR.Discount_Value
        FROM products P
        RIGHT JOIN product_promotion PP ON P.Product_Id = PP.Product_Id
        LEFT JOIN promotions PR ON PP.Promotion_Id = PR.Promotion_Id
        WHERE P.Name LIKE :Search;");
                $searchOfProductsWithPromotion->bindParam('Search', $searchValue);
                $searchOfProductsWithPromotion->execute();
                $searchPP = $searchOfProductsWithPromotion->fetchAll();
                foreach ($searchPP as $detailsPP) {
                    $getpromotionValue = $database->prepare("SELECT Discount_Value FROM promotions INNER JOIN product_promotion ON promotions.Promotion_Id = product_promotion.Promotion_Id WHERE Product_Id = :Product_Id");
                    $getpromotionValue->bindParam("Product_Id", $detailsPP['Product_Id']);
                    $getpromotionValue->execute();
                    $discountValue = $getpromotionValue->fetchAll();
                    foreach ($discountValue as $value) {
                        $discountedPrice = $detailsPP['Price'] - ($detailsPP['Price'] * $value['Discount_Value'] / 100);
                    }
                    echo "
          <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
            <div class='card position-relative' style='width: 19rem;'>
              <span class='position-absolute end-0 top-0 rounded-circle me-2 mt-2 p-1' style='background-color:#E63946;color:#F1FAEE'>" . $value['Discount_Value'] . "%</span>
              <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
              <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $detailsPP['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "true&discountValue=" . $value['Discount_Value'] . "'>
                <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                  <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                </svg>
              </a>
            </div>
            <img src='../products_images/" . $detailsPP["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
            <div class='card-body'>
              <h5 class='card-title' style='color:#457B9D'>" . $detailsPP['Name'] . "</h5>
              <p style='height: 10px;'>" . $detailsPP['Description'] . "</p>
            </div>
            <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
              <span class='fs-6' style='color:#F1FAEE '><span class='fs-6' style='color:#F1FAEE'><del>$" . $detailsPP['Price'] . "</del></span><b> $" . $discountedPrice . "</b> </span>
              <br>
            </div>
          </div>
          </div>";
                }
                // GET PRODUCTS WITH PROMOTION FROM SEARCH END

                // GET PRODUCTS WITHOUT PROMOTION FROM SEARCH START
                $getProductsNotPromoted = $database->prepare("SELECT P.Product_Id ,P.Image,P.Description,P.Price,P.Name FROM products P LEFT JOIN product_promotion PP ON P.Product_Id = PP.Product_Id WHERE PP.Product_Id IS NULL AND P.Name LIKE :Search;");
                $searchValue = '%' . $_POST['searchValue'] . '%';

                $getProductsNotPromoted->bindParam('Search', $searchValue);

                $getProductsNotPromoted->execute();
                $productsNotPromoted = $getProductsNotPromoted->fetchAll();
                foreach ($productsNotPromoted as $pnp) {
                    echo "
          <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center'>
            <div class='card  position-relative' style='width: 19rem;'>
              <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
              <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $pnp['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "false" . "'>
                <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                  <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                </svg>
              </a>
            </div>
            <img src='../products_images/" . $pnp['Image'] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
            <div class='card-body'>
                <h5 class='card-title' style='color:#457B9D'>" . $pnp['Name'] . "</h5>
                <p style='height: 10px;'>" . $pnp['Description'] . "</p>
            </div>
            <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                <span class='fs-6' style='color:#F1FAEE '><b>$" . $pnp['Price'] . "</b></span>
                <br>
            </div>
            </div>
          </div>";
                }
                // GET PRODUCTS WITHOUT PROMOTION FROM SEARCH START

            }
            // SEARCH WHEN THE USER CLICK THE SEARCH BUTTON [END]


            if (isset($_POST['sort'])) {
                if(!isset($_POST['sortByCategory'])){
                    $_POST['sortByCategory'] = '';
                }
                if(!isset($_POST['sortBy'])){
                    $_POST['sortBy'] = '';
                }
                // ----------------CONDITION[1]----------------------------
                if ($_POST['sortBy'] == 'Price' && $_POST['sortByCategory'] !== '') {
                    $categoryName = $_POST['sortByCategory'];
                    $getIdOfCat = $database->prepare("SELECT Category_Id FROM categories WHERE Category_Name = :Category_Name");
                    $getIdOfCat->bindParam("Category_Name", $categoryName);
                    $getIdOfCat->execute();
                    $CatId = $getIdOfCat->fetchColumn();

                    $getPromotedProducts = $database->prepare("SELECT * FROM product_promotion");
                    $getPromotedProducts->execute();
                    $productPromotedId = $getPromotedProducts->fetchAll();
                    foreach ($productPromotedId as $idOfProductPromoted) {
                        $productPromotedDetails = $database->prepare("SELECT * FROM products WHERE Product_Id = :Product_Id AND Category_Id = :Category_Id");
                        $productPromotedDetails->bindParam("Category_Id", $CatId);
                        $productPromotedDetails->bindParam("Product_Id", $idOfProductPromoted['Product_Id']);
                        $productPromotedDetails->execute();
                        $detailsOfProductPromoted = $productPromotedDetails->fetchAll();
                        foreach ($detailsOfProductPromoted as $detailsPP) {
                            $getpromotionValue = $database->prepare("SELECT Discount_Value FROM promotions INNER JOIN product_promotion ON promotions.Promotion_Id = product_promotion.Promotion_Id WHERE product_promotion.Product_Id = :Product_Id");
                            $getpromotionValue->bindParam("Product_Id", $detailsPP['Product_Id']);
                            $getpromotionValue->execute();
                            $discountValue = $getpromotionValue->fetchAll();
                            foreach ($discountValue as $value) {
                                $discountedPrice = $detailsPP['Price'] - ($detailsPP['Price'] * $value['Discount_Value'] / 100);
                            }
                            echo "
                <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
                  <div class='card position-relative' style='width: 19rem;'>
                    <span class='position-absolute end-0 top-0 rounded-circle me-2 mt-2 p-1' style='background-color:#E63946;color:#F1FAEE'>" . $value['Discount_Value'] . "%</span>
                    <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
                    <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $detailsPP['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "true&discountValue=" . $value['Discount_Value'] . "'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                        <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                      </svg>
                    </a>
                  </div>
                  <img src='../products_images/" . $detailsPP["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                  <div class='card-body'>
                    <h5 class='card-title' style='color:#457B9D'>" . $detailsPP['Name'] . "</h5>
                    <p style='height: 10px;'>" . $detailsPP['Description'] . "</p>
                  </div>
                  <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                    <span class='fs-6' style='color:#F1FAEE '><span class='fs-6' style='color:#F1FAEE'><del>$" . $detailsPP['Price'] . "</del></span><b> $" . $discountedPrice . "</b> </span>
                    <br>
                  </div>
                </div>
                </div>";
                        }
                    }
                    $getProductsNotPromoted = $database->prepare("SELECT P.Product_Id ,P.Image,P.Description,P.Price,P.Name FROM products P LEFT JOIN product_promotion PP ON P.Product_Id = PP.Product_Id WHERE PP.Product_Id IS NULL AND P.Category_Id = :Category_Id ORDER BY P.Price");
                    $getProductsNotPromoted->bindParam("Category_Id", $CatId);
                    $getProductsNotPromoted->execute();
                    $productsNotPromoted = $getProductsNotPromoted->fetchAll();
                    foreach ($productsNotPromoted as $pnp) {
                        echo "
              <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center'>
                <div class='card  position-relative' style='width: 19rem;'>
                  <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
                  <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $pnp['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "false" . "'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                      <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                    </svg>
                  </a>
                </div>
                <img src='../products_images/" . $pnp['Image'] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                <div class='card-body'>
                    <h5 class='card-title' style='color:#457B9D'>" . $pnp['Name'] . "</h5>
                    <p style='height: 10px;'>" . $pnp['Description'] . "</p>
                </div>
                <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                    <span class='fs-6' style='color:#F1FAEE '><b>$" . $pnp['Price'] . "</b></span>
                    <br>
                </div>
                </div>
              </div>";
                    }
                } // ----------------CONDITION[1]----------------------------
                // ----------------CONDITION[2]----------------------------
                else if ($_POST['sortBy'] == 'Promotions' && $_POST['sortByCategory'] != '') {
                    $categoryName = $_POST['sortByCategory'];
                    $getIdOfCat = $database->prepare("SELECT Category_Id FROM categories WHERE Category_Name = :Category_Name");
                    $getIdOfCat->bindParam("Category_Name", $categoryName);
                    $getIdOfCat->execute();
                    $CatId = $getIdOfCat->fetchColumn();

                    $getPromotedProducts = $database->prepare("SELECT * FROM product_promotion");
                    $getPromotedProducts->execute();
                    $productPromotedId = $getPromotedProducts->fetchAll();
                    foreach ($productPromotedId as $idOfProductPromoted) {
                        $productPromotedDetails = $database->prepare("SELECT * FROM products WHERE Product_Id = :Product_Id AND Category_Id = :Category_Id");
                        $productPromotedDetails->bindParam("Category_Id", $CatId);
                        $productPromotedDetails->bindParam("Product_Id", $idOfProductPromoted['Product_Id']);
                        $productPromotedDetails->execute();
                        $detailsOfProductPromoted = $productPromotedDetails->fetchAll();
                        foreach ($detailsOfProductPromoted as $detailsPP) {
                            $getpromotionValue = $database->prepare("SELECT Discount_Value FROM promotions INNER JOIN product_promotion ON promotions.Promotion_Id = product_promotion.Promotion_Id WHERE product_promotion.Product_Id = :Product_Id");
                            $getpromotionValue->bindParam("Product_Id", $detailsPP['Product_Id']);
                            $getpromotionValue->execute();
                            $discountValue = $getpromotionValue->fetchAll();
                            foreach ($discountValue as $value) {
                                $discountedPrice = $detailsPP['Price'] - ($detailsPP['Price'] * $value['Discount_Value'] / 100);
                            }
                            echo "
                <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
                  <div class='card position-relative' style='width: 19rem;'>
                    <span class='position-absolute end-0 top-0 rounded-circle me-2 mt-2 p-1' style='background-color:#E63946;color:#F1FAEE'>" . $value['Discount_Value'] . "%</span>
                    <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
                    <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $detailsPP['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "true&discountValue=" . $value['Discount_Value'] . "'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                        <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                      </svg>
                    </a>
                  </div>
                  <img src='../products_images/" . $detailsPP["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                  <div class='card-body'>
                    <h5 class='card-title' style='color:#457B9D'>" . $detailsPP['Name'] . "</h5>
                    <p style='height: 10px;'>" . $detailsPP['Description'] . "</p>
                  </div>
                  <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                    <span class='fs-6' style='color:#F1FAEE '><span class='fs-6' style='color:#F1FAEE'><del>$" . $detailsPP['Price'] . "</del></span><b> $" . $discountedPrice . "</b> </span>
                    <br>
                  </div>
                </div>
                </div>";
                        }
                    }
                } // ----------------CONDITION[2]----------------------------
                else if ($_POST['sortByCategory'] != '' && $_POST['sortBy'] == '') {
                    $categoryName = $_POST['sortByCategory'];
                    $getIdOfCat = $database->prepare("SELECT Category_Id FROM categories WHERE Category_Name = :Category_Name");
                    $getIdOfCat->bindParam("Category_Name", $categoryName);
                    $getIdOfCat->execute();
                    $CatId = $getIdOfCat->fetchColumn();

                    $getPromotedProducts = $database->prepare("SELECT * FROM product_promotion");
                    $getPromotedProducts->execute();
                    $productPromotedId = $getPromotedProducts->fetchAll();
                    foreach ($productPromotedId as $idOfProductPromoted) {
                        $productPromotedDetails = $database->prepare("SELECT * FROM products WHERE Product_Id = :Product_Id AND Category_Id = :Category_Id");
                        $productPromotedDetails->bindParam("Category_Id", $CatId);
                        $productPromotedDetails->bindParam("Product_Id", $idOfProductPromoted['Product_Id']);
                        $productPromotedDetails->execute();
                        $detailsOfProductPromoted = $productPromotedDetails->fetchAll();
                        foreach ($detailsOfProductPromoted as $detailsPP) {
                            $getpromotionValue = $database->prepare("SELECT Discount_Value FROM promotions INNER JOIN product_promotion ON promotions.Promotion_Id = product_promotion.Promotion_Id WHERE Product_Id = :Product_Id");
                            $getpromotionValue->bindParam("Product_Id", $detailsPP['Product_Id']);
                            $getpromotionValue->execute();
                            $discountValue = $getpromotionValue->fetchAll();
                            foreach ($discountValue as $value) {
                                $discountedPrice = $detailsPP['Price'] - ($detailsPP['Price'] * $value['Discount_Value'] / 100);
                            }
                            echo "
                <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
                  <div class='card position-relative' style='width: 19rem;'>
                    <span class='position-absolute end-0 top-0 rounded-circle me-2 mt-2 p-1' style='background-color:#E63946;color:#F1FAEE'>" . $value['Discount_Value'] . "%</span>
                    <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
                    <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $detailsPP['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "true&discountValue=" . $value['Discount_Value'] . "'>
                      <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                        <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                      </svg>
                    </a>
                  </div>
                  <img src='../products_images/" . $detailsPP["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                  <div class='card-body'>
                    <h5 class='card-title' style='color:#457B9D'>" . $detailsPP['Name'] . "</h5>
                    <p style='height: 10px;'>" . $detailsPP['Description'] . "</p>
                  </div>
                  <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                    <span class='fs-6' style='color:#F1FAEE '><span class='fs-6' style='color:#F1FAEE'><del>$" . $detailsPP['Price'] . "</del></span><b> $" . $discountedPrice . "</b> </span>
                    <br>
                  </div>
                </div>
                </div>";
                        }
                    }
                    $getProductsNotPromoted = $database->prepare("SELECT P.Product_Id ,P.Image,P.Description,P.Price,P.Name FROM products P LEFT JOIN product_promotion PP ON P.Product_Id = PP.Product_Id WHERE PP.Product_Id IS NULL AND P.Category_Id = :Category_Id;");
                    $getProductsNotPromoted->bindParam("Category_Id", $CatId);
                    $getProductsNotPromoted->execute();
                    $productsNotPromoted = $getProductsNotPromoted->fetchAll();
                    foreach ($productsNotPromoted as $pnp) {
                        echo "
              <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center'>
                <div class='card  position-relative' style='width: 19rem;'>
                  <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
                  <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $pnp['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "false" . "'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                      <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                    </svg>
                  </a>
                </div>
                <img src='../products_images/" . $pnp['Image'] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                <div class='card-body'>
                    <h5 class='card-title' style='color:#457B9D'>" . $pnp['Name'] . "</h5>
                    <p style='height: 10px;'>" . $pnp['Description'] . "</p>
                </div>
                <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                    <span class='fs-6' style='color:#F1FAEE '><b>$" . $pnp['Price'] . "</b></span>
                    <br>
                </div>
                </div>
              </div>";
                    }
                }else if($_POST['sortBy']=='Price' && $_POST['sortByCategory']===''){
                    // -------SORT PROMOTED PRODUCT BY PRICE START
            $ppSortByPrice = $database->prepare("SELECT P.Product_Id, P.Name, P.Description,P.Image, P.Price, PP.Promotion_Id, PR.Discount_Value
            FROM products P
            RIGHT JOIN product_promotion PP ON P.Product_Id = PP.Product_Id
            LEFT JOIN promotions PR ON PP.Promotion_Id = PR.Promotion_Id ORDER BY P.Price ASC");
        $ppSortByPrice->execute();
        $ppByPrice = $ppSortByPrice->fetchAll();
        foreach ($ppByPrice as $detailsPP) {
          $getpromotionValue = $database->prepare("SELECT Discount_Value FROM promotions INNER JOIN product_promotion ON promotions.Promotion_Id = product_promotion.Promotion_Id WHERE Product_Id = :Product_Id");
          $getpromotionValue->bindParam("Product_Id", $detailsPP['Product_Id']);
          $getpromotionValue->execute();
          $discountValue = $getpromotionValue->fetchAll();
          foreach ($discountValue as $value) {
            $discountedPrice = $detailsPP['Price'] - ($detailsPP['Price'] * $value['Discount_Value'] / 100);
          }
          echo "
              <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
                <div class='card position-relative' style='width: 19rem;'>
                  <span class='position-absolute end-0 top-0 rounded-circle me-2 mt-2 p-1' style='background-color:#E63946;color:#F1FAEE'>" . $value['Discount_Value'] . "%</span>
                  <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
                  <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $detailsPP['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "true&discountValue=" . $value['Discount_Value'] . "'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                      <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                    </svg>
                  </a>
                </div>
                <img src='../products_images/" . $detailsPP["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
                <div class='card-body'>
                  <h5 class='card-title' style='color:#457B9D'>" . $detailsPP['Name'] . "</h5>
                  <p style='height: 10px;'>" . $detailsPP['Description'] . "</p>
                </div>
                <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                  <span class='fs-6' style='color:#F1FAEE '><span class='fs-6' style='color:#F1FAEE'><del>$" . $detailsPP['Price'] . "</del></span><b> $" . $discountedPrice . "</b> </span>
                  <br>
                </div>
              </div>
              </div>";
        } // -------SORT PROMOTED PRODUCT BY PRICE End

        $getProductsNotPromoted = $database->prepare("SELECT P.Product_Id ,P.Image,P.Description,P.Price,P.Name FROM products P LEFT JOIN product_promotion PP ON P.Product_Id = PP.Product_Id WHERE PP.Product_Id IS NULL ORDER BY P.Price ASC");

        $getProductsNotPromoted->execute();
        $productsNotPromoted = $getProductsNotPromoted->fetchAll();
        foreach ($productsNotPromoted as $pnp) {
          echo "
      <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center'>
        <div class='card  position-relative' style='width: 19rem;'>
          <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
          <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $pnp['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "false" . "'>
            <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
              <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
            </svg>
          </a>
        </div>
        <img src='../products_images/" . $pnp['Image'] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
        <div class='card-body'>
            <h5 class='card-title' style='color:#457B9D'>" . $pnp['Name'] . "</h5>
            <p style='height: 10px;'>" . $pnp['Description'] . "</p>
        </div>
        <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
            <span class='fs-6' style='color:#F1FAEE '><b>$" . $pnp['Price'] . "</b></span>
            <br>
        </div>
        </div>
      </div>";
        }
                }
                else if($_POST['sortBy']=='Promotions' && $_POST['sortByCategory']==''){
                    $getPromotedProducts = $database->prepare("SELECT Product_Id FROM product_promotion");
            $getPromotedProducts->execute();
            $productPromotedId = $getPromotedProducts->fetchAll();
            foreach ($productPromotedId as $idOfProductPromoted) {
              $productPromotedDetails = $database->prepare("SELECT * FROM products WHERE Product_Id = :Product_Id");
              $productPromotedDetails->bindParam("Product_Id", $idOfProductPromoted['Product_Id']);
              $productPromotedDetails->execute();
              $detailsOfProductPromoted = $productPromotedDetails->fetchAll();
              foreach ($detailsOfProductPromoted as $detailsPP) {
                $getpromotionValue = $database->prepare("SELECT Discount_Value FROM promotions INNER JOIN product_promotion ON promotions.Promotion_Id = product_promotion.Promotion_Id WHERE Product_Id = :Product_Id");
                $getpromotionValue->bindParam("Product_Id", $detailsPP['Product_Id']);
                $getpromotionValue->execute();
                $discountValue = $getpromotionValue->fetchAll();
                foreach ($discountValue as $value) {
                  $discountedPrice = $detailsPP['Price'] - ($detailsPP['Price'] * $value['Discount_Value'] / 100);
                }
                echo "
            <div class='col-xxl-3 col-xl-3 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center position-relative'>
              <div class='card position-relative' style='width: 19rem;'>
                <span class='position-absolute end-0 top-0 rounded-circle me-2 mt-2 p-1' style='background-color:#E63946;color:#F1FAEE'>" . $value['Discount_Value'] . "%</span>
                <div class='position-absolute bottom-0 end-0 py-2 px-3 rounded-end' style='background-color:#E63946;'>
                <a href='http://localhost/server/marketplace/pages/addToCart.php?id=" . $detailsPP['Product_Id'] . "&username=" . $customerName . "&havePromotion=" . "true&discountValue=" . $value['Discount_Value'] . "'>
                  <svg xmlns='http://www.w3.org/2000/svg' width='26' height='20' fill='#F1FAEE' class='bi bi-bag-plus-fill' viewBox='0 0 16 16'>
                    <path fill-rule='evenodd' d='M10.5 3.5a2.5 2.5 0 0 0-5 0V4h5zm1 0V4H15v10a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2V4h3.5v-.5a3.5 3.5 0 1 1 7 0M8.5 8a.5.5 0 0 0-1 0v1.5H6a.5.5 0 0 0 0 1h1.5V12a.5.5 0 0 0 1 0v-1.5H10a.5.5 0 0 0 0-1H8.5z'/>
                  </svg>
                </a>
              </div>
              <img src='../products_images/" . $detailsPP["Image"] . "' class='card-img-top img-fluid' alt='...' style='width: 100%; height: 200px; object-fit:contain;'>
              <div class='card-body'>
                <h5 class='card-title' style='color:#457B9D'>" . $detailsPP['Name'] . "</h5>
                <p style='height: 10px;'>" . $detailsPP['Description'] . "</p>
              </div>
              <div class='text-center mt-3 rounded-bottom rounded-end py-2' style='background-color:#1D3557;'>
                <span class='fs-6' style='color:#F1FAEE '><span class='fs-6' style='color:#F1FAEE'><del>$" . $detailsPP['Price'] . "</del></span><b> $" . $discountedPrice . "</b> </span>
                <br>
              </div>
            </div>
            </div>";
              }
            }
                }
            }


            ?>
        </div> <!-- END DIV ROW -->
    </div> <!-- END DIV CONTAINER -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>

</html>

<?php
include("./footer.php");
?>