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
            <h1 class="ps-3"><i style="color: #E63946;">TradTech</i><span style="color: #1D3557;"> Store</span></h1>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="black" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="col-8">
                    <ul class="navbar-nav d-flex justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link link-dark" aria-current="page" href="http://localhost/server/marketplace/pages/home.php">Home</a>
                        </li>
                        <li class="nav-item ms-xl-5 ">
                            <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/showProducts.php">Shop</a>
                        </li>
                        <li class="nav-item ms-xl-5 d-xl-none ">
                            <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/cart.php">Cart</a>
                        </li>
                        <!-- DROPDOWN -->
                        <?php if ($is_admin) : ?>
                            <li class="nav-item ms-xl-5">
                                <div class="dropdown">
                                    <button class="btn btn-link link-dark link-underline-opacity-0 dropdown-toggle  " type="button" data-bs-toggle="dropdown" aria-expanded="false">
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
                        <li class="nav-item <?php echo $is_admin ? "d-none" : "d-xl-none" ?>">
                            <div class="dropdown">
                                <button class="btn btn-link link-dark link-underline-opacity-0 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    Settings
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a class="dropdown-item" href="http://localhost/server/marketplace/pages/profile.php">Profile</a>
                                    </li>
                                    <li><a class="dropdown-item" href="http://localhost/server/marketplace/pages/addFeedback.php">Feedback</a>
                                    </li>
                                    <li><a class="dropdown-item" href="http://localhost/server/marketplace/pages/logout.php">Log Out</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        <li class="nav-item ms-xl-5 ">
                            <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/home.php#footer">Contact</a>
                        </li>
                        <li class="nav-item ms-xl-5 <?php echo $is_admin ? "d-block d-xl-none" : "d-none" ?>">
                            <a class="nav-link link-dark" href="http://localhost/server/marketplace/pages/logout.php">Log Out</a>
                        </li>
                    </ul>
                </div>
                <div class="col-4 d-flex justify-content-end px-3">
                    <button type="button" class="btn position-relative <?php echo $is_admin ? "d-none" : "d-none d-xl-flex" ?>">
                        <a href="http://localhost/server/marketplace/pages/profile.php" class="link-dark" style="text-decoration: none;">
                            Go to Profile
                        </a>
                    </button>
                    <button type="button" class="btn position-relative <?php echo $is_admin ? "d-none" : "d-none d-xl-flex" ?>">
                        <a href="http://localhost/server/marketplace/pages/addFeedback.php" class="link-dark">
                            <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor" class="bi bi-shield-exclamation" viewBox="0 0 16 16">
                                <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                                <path d="M7.001 11a1 1 0 1 1 2 0 1 1 0 0 1-2 0M7.1 4.995a.905.905 0 1 1 1.8 0l-.35 3.507a.553.553 0 0 1-1.1 0z" />
                            </svg>
                        </a>
                    </button>
                    <button type="button" class="btn position-relative d-none d-xl-flex">
                        <a href="logout.php" class="link-dark"><svg xmlns="http://www.w3.org/2000/svg" width="28" height="27" fill="currentColor" class="bi bi-door-open" viewBox="0 0 16 16">
                                <path d="M8.5 10c-.276 0-.5-.448-.5-1s.224-1 .5-1 .5.448.5 1-.224 1-.5 1" />
                                <path d="M10.828.122A.5.5 0 0 1 11 .5V1h.5A1.5 1.5 0 0 1 13 2.5V15h1.5a.5.5 0 0 1 0 1h-13a.5.5 0 0 1 0-1H3V1.5a.5.5 0 0 1 .43-.495l7-1a.5.5 0 0 1 .398.117M11.5 2H11v13h1V2.5a.5.5 0 0 0-.5-.5M4 1.934V15h6V1.077z" />
                            </svg></a>
                    </button>
                    <button type="button" class="btn position-relative <?php echo $is_admin ? "d-none" : "d-none d-xl-flex" ?>">
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