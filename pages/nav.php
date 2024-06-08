<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
    <style>
    .active {
        font-weight: 500;
    }
    </style>
</head>
<nav class="navbar navbar-expand-lg bg-body-tertiary py-4">
    <div class="container-fluid">
        <img src="../images/logo.jpeg" class="img-fluid" alt="..." width="96" height="88">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo02"
            aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32"
                    fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                    <path fill-rule="evenodd"
                        d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5" />
                </svg></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarTogglerDemo02">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item ms-xl-5 ps-xl-5">
                    <a class="nav-link active link-dark" aria-current="page" href="#">Home</a>
                </li>
                <li class="nav-item ms-xl-5">
                    <a class="nav-link link-dark" href="#">Shop</a>
                </li>
                <li class="nav-item ms-xl-5">
                    <a class="nav-link link-dark" href="#">Contact</a>
                </li>
                <li class="d-flex d-xl-none nav-item ms-xl-5">
                    <a class="nav-link link-dark" href="#">Sign up</a>
                </li>
            </ul>
            <form class="d-none d-xl-flex align-items-xl-center" role="search">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-cart3"
                    viewBox="0 0 16 16" style="margin-right: 1rem;">
                    <path
                        d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                </svg>
                <button type="button" class="btn btn-outline-dark btn-sm">Sign up</button>
            </form>
        </div>
    </div>
</nav>

<body>
    <script src="../js/bootstrap.js"></script>
</body>

</html>