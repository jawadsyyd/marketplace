<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
    .active {
        font-weight: 500;
    }
    </style>
</head>

<body>
    <?php
        session_start();
        $is_admin = ($_SESSION['user_type'] === 'Admin');
    ?>
    <nav class="navbar navbar-expand-lg bg-white-tertiary py-4">
        <div class="container">
            <img src="https://placehold.co/600x400/black/white" class="img-fluid" alt="..." width="96" height="88">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
                aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
                <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="black" class="bi bi-list"
                    viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg>
            </button>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
                <div class="col-9">
                    <ul class="navbar-nav d-flex justify-content-around">
                        <li class="nav-item ms-xl-5 ps-xl-5">
                            <a class="nav-link active link-dark" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item ms-xl-5">
                            <a class="nav-link link-dark" href="#AllCategories">Shop</a>
                        </li>
                        <li class="nav-item ms-xl-5">
                            <a class="nav-link link-dark" href="#promotion">Promotions</a>
                        </li>
                        <li class="nav-item ms-xl-5 d-xl-none">
                            <a class="nav-link link-dark" href="#">Cart</a>
                        </li>
                        <!-- DROPDOWN -->
                        <?php if ($is_admin): ?>
                            <li class="nav-item ms-xl-5">
                                <div class="dropdown">
                                    <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown"
                                        aria-expanded="false">
                                        Pages
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a class="dropdown-item"
                                                href="http://localhost/server/marketplace/pages/products.php">Products</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="http://localhost/server/marketplace/pages/categories.php">Categories</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="http://localhost/server/marketplace/pages/promotions.php">Promotions</a>
                                        </li>
                                        <li><a class="dropdown-item"
                                                href="http://localhost/server/marketplace/pages/selectProducts.php">Promotion Details</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                        <?php endif; ?>
                        <!-- DROPDOWN -->
                        <li class="nav-item ms-xl-5">
                            <a class="nav-link link-dark" href="#footer">Contact</a>
                        </li>
                    </ul>
                </div>
                <div class="col-3 d-flex justify-content-end  d-none d-xl-flex">
                    <button type="button" class="btn position-relative">
                        <svg xmlns="http://www.w3.org/2000/svg" width="28" height="28" fill="currentColor"
                            class="bi bi-cart2" viewBox="0 0 16 16">
                            <path
                                d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0" />
                        </svg>
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            99+
                            <span class="visually-hidden">unread messages</span>
                        </span>
                    </button>
                </div>
            </div>
        </div>
        </div>
    </nav>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>