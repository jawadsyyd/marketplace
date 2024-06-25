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
    <title>Home Page</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <!-- START SLIDER -->

    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
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
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- END SLIDER -->

    <!-- START CATEGORY -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle bg-dark-subtle mb-3 p-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-truck" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                    </svg></button>
                <h5 class="text-uppercase">Free delivery from S 250</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, id?</p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle bg-dark-subtle mb-3 p-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                    </svg></button>
                <h5 class="text-uppercase">money back guaranteed</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, id?</p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle bg-dark-subtle mb-3 p-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-shield-lock" viewBox="0 0 16 16">
                        <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                        <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415" />
                    </svg></button>
                <h5 class="text-uppercase">secure payment</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, id?</p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle bg-dark-subtle mb-3 p-3"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="black" class="bi bi-check-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                        <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                    </svg></button>
                <h5 class="text-uppercase">authenticity 100% guaranteed</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, id?</p>
            </div>
        </div>
    </div>

    <!-- END CATEGORY -->

    <!-- START BANNER -->
    <div class="container my-5" id="promotion">
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
    </div>
    <!-- END BANNER -->

    <!-- START Product -->
    <div class="container-fluid my-5 d-flex justify-content-around">
        <div class="row my-5">
            <div class="col-12 col-sm-10">
                <div class="row">
                    <?php
                    if ($_SERVER['REQUEST_URI'] == "/server/marketplace/pages/home.php") {
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
                                                    <input type='number' class='quantity-input me-1 text-center' value='1' min='1' style='width:40px; height: 34px; padding: 2px;'>
                                                    <button class='btn btn-outline-secondary quantity-button increase d-flex align-items-center' style='height: 34px;'>+</button>
                                                </div>
                                            </div>
                                            <div class='col-2'></div>
                                            <div class='col-4'>
                                                <a href='http://localhost/server/marketplace/pages/promotionShopping.php?id=" . $product['Product_Id'] . "&username=" . $customerName . "'><svg xmlns='http://www.w3.org/2000/svg' width='24' height='24'
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
                    } else if (preg_match("~^/server/marketplace/pages/home.php/([^/]+)$~", $_SERVER['REQUEST_URI'], $matches)) {
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
                                echo '<div class="col-xxl-3 col-xl-4 col-md-4 col-lg-6 col-md-6 col-sm-12 col-12 mb-4 d-flex justify-content-center"><div class="card" style="width: 18rem; height: 400px;">
                            <img src="../../products_images/' . $product['Image'] . '" class="card-img-top img-fluid" alt="..." style="width: 100%; height: 200px; object-fit:contain;">
                            <div class="card-body">
                            <h5 class="card-title">' . $product['Name'] . '</h5>
                            <p>' . $product['Description'] . '</p>
                            <div class="row pt-4 d-flex align-items-center">
                            <div class="col-8">
                            <span class="fw-semibold">$</span><span class="fw-semibold">' . $product['Price'] . '</span>
                            </div>
                            <div class="col-4">
                                    <a href=\'http://localhost/server/marketplace/pages/showProducts.php?id=' . $product["Product_Id"] . '&username=' . $customerName . '\'><svg xmlns=\'http://www.w3.org/2000/svg\' width="24" height="24"
                                                        fill=\'currentColor\' class=\'bi bi-cart3\' viewBox=\'0 0 16 16\'>
                                                        <path
                                                            d=\'M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2\' />
                                        </svg></a>
                                </div>
                            </div>
                            </div>
                            </div></div>';
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
                        <a class="nav-link link-dark active" id="AllCategories" href="http://localhost/server/marketplace/pages/home.php">All Products<span class="px-1"><?php echo "(" . $nbOfProducts . ")" ?></span></a>
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
                    <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/home.php/' . $catName["Category_Name"] . "#" . $catName["Category_Name"] . '" aria-disabled="true">' . $catName["Category_Name"] . " (" . $nbOfProInCat . ") " . '</a>
                </li>';
                    }
                    ?>
                </ul>
            </div>
        </div>
    </div>
    <!-- END Product -->

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

        $addToCard = $database->prepare('INSERT INTO orders(Customer_Id,Product_Id) VALUES(:Customer_Id,:Product_Id)');
        // $addToCard->bindParam("Qty",);
        // $addToCard->bindParam("Price",);
        $addToCard->bindParam("Customer_Id", $idOfCustomer['Customer_Id']);
        $addToCard->bindParam("Product_Id", $productClicked['Product_Id']);
        $addToCard->execute();
    }
    ?>

    <!-- EDITED BY JAWAD -->
    <?php
    include("./footer.php");
    ?>
    <script src="../js/quantity.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>