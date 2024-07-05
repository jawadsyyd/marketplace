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
    <style>
        #btnCategory {
            background-color: #457B9D;
        }

        #categoryTitle {
            color: #1D3557;
        }

        #btnShowMore:hover {
            background-color: #E63946;
        }

        .feedback-card {
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            padding: 15px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }

        .user-profile {
            margin-bottom: 10px;
        }

        .user-profile img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            margin-right: 10px;
        }

        .username {
            font-weight: bold;
        }

        .feedback-title {
            margin-top: 10px;
            font-size: 1.2em;
            color: #333;
        }

        .feedback-description {
            margin-top: 5px;
            color: #666;
        }
    </style>
</head>

<body>
    <!-- START SLIDER -->

    <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="../images/mobilePhones.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/tabletsAndEReaders.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/laptopsAndComputers.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/wearables.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="../images/audio.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
    </div>

    <!-- END SLIDER -->

    <!-- START CATEGORY -->

    <div class="container mt-2">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle mb-3 p-3" id="btnCategory"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F1FAEE" class="bi bi-truck" viewBox="0 0 16 16">
                        <path d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                    </svg></button>
                <h5 class="text-uppercase" id="categoryTitle">Free delivery from S 250</h5>
                <p></p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle mb-3 p-3" id="btnCategory"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F1FAEE" class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                    </svg></button>
                <h5 class="text-uppercase" id="categoryTitle">money back guaranteed</h5>
                <p></p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle mb-3 p-3" id="btnCategory"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F1FAEE" class="bi bi-shield-lock" viewBox="0 0 16 16">
                        <path d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                        <path d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415" />
                    </svg></button>
                <h5 class="text-uppercase" id="categoryTitle">secure payment</h5>
                <p></p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle mb-3 p-3" id="btnCategory"><svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="#F1FAEE" class="bi bi-check-square" viewBox="0 0 16 16">
                        <path d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                        <path d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                    </svg></button>
                <h5 class="text-uppercase" id="categoryTitle">authenticity 100%</h5>
                <p></p>
            </div>
        </div>
    </div>

    <!-- END CATEGORY -->

    <!-- START BANNER -->
    <div class="container mb-3" id="promotion">
        <div class="row">
            <div class="col-md-6 col-12 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 position-relative ">
                <img src="../images/banner.jpeg" alt="" class="img-fluid">
            </div>
            <div class="col-md-6 col-12 col-sm-12 col-lg-6 col-xl-6 col-xxl-6 position-relative ">
                <img src="../images/banner.jpeg" alt="" class="img-fluid">
            </div>
        </div>
    </div>
    <!-- END BANNER -->

    <!-- START Product -->

    <div class="container-fluid">
        <div class="row">
            <?php
            $getProducts = $database->prepare("
    SELECT * FROM products ORDER BY Product_Id ASC
    LIMIT 4
");
            $getProducts->execute();
            $products = $getProducts->fetchAll();
            foreach ($products as $product) {
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
            #1D3557 #457B9D #A8DADC #F1FAEE #E63946 
            ?>
        </div>
    </div>
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="showMore">
                <button type="button" class="btn btn-outline-danger" onclick="ShowMore()" id="btnShowMore">Show All Products</button>
            </div>
        </div>
    </div>

    <!-- END Product -->

    <!--  -->
    <div id="carouselExampleIndicators" class="carousel slide mt-4">
        <div class="carousel-inner">
            <?php
            $isFirstItem = true;
            $getFeedback = $database->prepare('SELECT * FROM feedback LIMIT 5');
            $getFeedback->execute();
            $feedbackDetails = $getFeedback->fetchAll();
            foreach ($feedbackDetails as $details) {
                $getCustomerDetails = $database->prepare('SELECT * FROM users WHERE Customer_Id = :Customer_Id');
                $id =  $details['Customer_Id'];
                $getCustomerDetails->bindParam('Customer_Id', $id);
                $getCustomerDetails->execute();
                $customerDetails = $getCustomerDetails->fetchAll();
                foreach ($customerDetails as $cDetails) {
                    $profilePicture = $cDetails['profilePicture'];
                    if (empty($profilePicture)) {
                        $profilePicture = 'avatar.png';
                    }
                    if ($isFirstItem) {
                        echo '
                <div class="carousel-item active">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="feedback-card">
                            <div class="user-profile">
                                <img src="../users_images/' . $profilePicture . '" alt="User Profile Image">
                                <span class="username">' . $cDetails['Username'] . '</span>
                            </div>
                            <div class="feedback-date">' . $details['Date'] . '</div>
                            <div class="feedback-title">' . $details['Title'] . '</div>
                            <div class="feedback-description">
                                ' . $details['Text'] . '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                ';
                        $isFirstItem = false;
                    } else {
                        echo '
                <div class="carousel-item">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        <div class="feedback-card">
                            <div class="user-profile">
                                <img src="../users_images/' . $profilePicture . '" alt="User Profile Image">
                                <span class="username">' . $cDetails['Username'] . '</span>
                            </div>
                            <div class="feedback-date">' . $details['Date'] . '</div>
                            <div class="feedback-title">' . $details['Title'] . '</div>
                            <div class="feedback-description">
                                ' . $details['Text'] . '
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                ';
                    }
                }
            }
            ?>
            <!-- Navigation buttons -->
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="prev">
                <span class="carousel-control-prev-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide="next">
                <span class="carousel-control-next-icon bg-dark rounded-circle" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </div>
    <!--  -->
    <?php
    include("./footer.php");
    ?>
    <script>
        function ShowMore() {
            window.location.href = 'http://localhost/server/marketplace/pages/showProducts.php';
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>