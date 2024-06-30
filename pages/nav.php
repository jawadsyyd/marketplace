<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #numberOfProductsInCart {
            background-color: #E63946;
        }

        .active {
            color: #E63946;
        }
    </style>
</head>

<body>
    <?php
    if (empty($_SESSION['user_type'])) {
        header("Location : http://localhost/server/marketplace/pages/login.php");
        exit();
    }
    // session_start();
    $is_admin = ($_SESSION['user_type'] === 'Admin');
    ?>
    <nav class="navbar navbar-expand-lg bg-white-tertiary py-4" style="background-color: #F1FAEE;">
        <div class="container-fluid">
            <h1 class="ps-3"><i style="color: #E63946;">Bi</i><span style="color: #1D3557;">Shop</span></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="black" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="col-9">
                    <ul class="navbar-nav d-flex justify-content-center">
                        <li class="nav-item ms-xl-5 ps-xl-5 fs-5">
                            <a class="nav-link link-dark" aria-current="page" href="http://localhost/server/marketplace/pages/home.php">Home</a>
                        </li>
                        <li class="nav-item ms-xl-5 fs-5">
                            <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/showProducts.php">Shop</a>
                        </li>
                        <li class="nav-item ms-xl-5 d-xl-none fs-5">
                            <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/cart.php">Cart</a>
                        </li>
                        <!-- DROPDOWN -->
                        <?php if ($is_admin) : ?>
                            <li class="nav-item ms-xl-5">
                                <div class="dropdown">
                                    <button class="btn btn-link link-dark link-underline-opacity-0 dropdown-toggle  fs-5" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                        Pages
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item" href="http://localhost/server/marketplace/pages/products.php">Products</a>
                                        </li>
                                        <li><a class="dropdown-item" href="http://localhost/server/marketplace/pages/categories.php">Categories</a>
                                        </li>
                                        <li><a class="dropdown-item" href="http://localhost/server/marketplace/pages/promotions.php">Promotions</a>
                                        </li>
                                        <li><a class="dropdown-item" href="http://localhost/server/marketplace/pages/promotionDetails.php">Promotion
                                                Details</a>
                                        </li>
                                        <li><a class="dropdown-item" href="http://localhost/server/marketplace/pages/admins.php">Admins</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                        <!-- DROPDOWN -->
                        <li class="nav-item ms-xl-5 fs-5">
                            <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/home.php#footer">Contact</a>
                        </li>
                        <li class="nav-item ms-xl-5 fs-5  d-block d-xl-none">
                            <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
                <div class="col-3 d-flex justify-content-end px-3">
                    <button type="button" class="btn position-relative d-none d-xl-flex">
                        <a href="logout.php" class="link-dark"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="27" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
                                <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z" />
                            </svg></a>
                    </button>
                    <button type="button" class="btn position-relative d-none d-xl-flex">
                        <a href="http://localhost/server/marketplace/pages/cart.php" class="link-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-cart4" viewBox="0 0 16 16">
                                <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l.5 2H5V5zM6 5v2h2V5zm3 0v2h2V5zm3 0v2h1.36l.5-2zm1.11 3H12v2h.61zM11 8H9v2h2zM8 8H6v2h2zM5 8H3.89l.5 2H5zm0 5a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill" id="numberOfProductsInCart">
                                <?php
                                $username = 'root';
                                $password = '';
                                $database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
                                if (empty($_SESSION['user_type'])) {
                                    header("Location : http://localhost/server/marketplace/pages/login.php");
                                    exit();
                                }
                                if (!empty($_SESSION['username'])) {
                                    $customerName = $_SESSION['username'];
                                } else {
                                    $customerName = "";
                                }
                                $getCustomerId = $database->prepare('SELECT Customer_Id FROM users WHERE Username = :Username');
                                $getCustomerId->bindParam("Username", $customerName);
                                $getCustomerId->execute();
                                $idOfCustomer = $getCustomerId->fetch();
                                $span = $database->prepare("SELECT COUNT(*) FROM orders WHERE Customer_Id = :Customer_Id");
                                $span->bindParam("Customer_Id", $idOfCustomer['Customer_Id']);
                                $span->execute();
                                $number = $span->fetchColumn();
                                print_r($number);
                                ?>
                                <span class="visually-hidden">unread messages</span>
                            </span>
                        </a>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>