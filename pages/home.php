<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home Page</title>
    <link href="../css/bootstrap.css" rel="stylesheet" type="text/css" />
</head>

<body>
    <?php
    include('./nav.php');
    
    ?>

    <!-- START SLIDER -->

    <div id="carouselExampleInterval" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active" data-bs-interval="5000">
                <img src="https://placehold.co/600x400" class="d-block w-100 position-relative" alt="...">
                <div class="position-absolute end-50 top-50 z-1001 flex">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 class="display-6">Lorem, ipsum dolor.</h3>
                            <h1 class="display-5">Lorem ipsum dolor sit.</h1>
                            <button class="btn btn-dark rounded-pill text-uppercase">VIEW COLLECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item" data-bs-interval="2500">
                <img src="https://placehold.co/600x400" class="d-block w-100 position-relative" alt="...">
                <div class="position-absolute start-50 top-50 z-1001 flex">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 class="display-6">Lorem, ipsum dolor.</h3>
                            <h1 class="display-5">Lorem ipsum dolor sit.</h1>
                            <button class="btn btn-dark rounded-pill text-uppercase">VIEW COLLECTION</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="carousel-item">
                <img src="https://placehold.co/600x400" class="d-block w-100 position-relative" alt="...">
                <div class="position-absolute start-50 bottom-50 z-1001 flex">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h3 class="display-6">Lorem, ipsum dolor.</h3>
                            <h1 class="display-5">Lorem ipsum dolor sit.</h1>
                            <button class="btn btn-dark rounded-pill text-uppercase">VIEW COLLECTION</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleInterval"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>

    <!-- END SLIDER -->

    <!-- START CATEGORY -->

    <div class="container mt-5">
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle bg-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="32"
                        height="32" fill="white" class="bi bi-truck" viewBox="0 0 16 16">
                        <path
                            d="M0 3.5A1.5 1.5 0 0 1 1.5 2h9A1.5 1.5 0 0 1 12 3.5V5h1.02a1.5 1.5 0 0 1 1.17.563l1.481 1.85a1.5 1.5 0 0 1 .329.938V10.5a1.5 1.5 0 0 1-1.5 1.5H14a2 2 0 1 1-4 0H5a2 2 0 1 1-3.998-.085A1.5 1.5 0 0 1 0 10.5zm1.294 7.456A2 2 0 0 1 4.732 11h5.536a2 2 0 0 1 .732-.732V3.5a.5.5 0 0 0-.5-.5h-9a.5.5 0 0 0-.5.5v7a.5.5 0 0 0 .294.456M12 10a2 2 0 0 1 1.732 1h.768a.5.5 0 0 0 .5-.5V8.35a.5.5 0 0 0-.11-.312l-1.48-1.85A.5.5 0 0 0 13.02 6H12zm-9 1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m9 0a1 1 0 1 0 0 2 1 1 0 0 0 0-2" />
                    </svg></button>
                <h5 class="text-uppercase">Free delivery from S 250</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, id?</p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle bg-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="32"
                        height="32" fill="white" class="bi bi-wallet2" viewBox="0 0 16 16">
                        <path
                            d="M12.136.326A1.5 1.5 0 0 1 14 1.78V3h.5A1.5 1.5 0 0 1 16 4.5v9a1.5 1.5 0 0 1-1.5 1.5h-13A1.5 1.5 0 0 1 0 13.5v-9a1.5 1.5 0 0 1 1.432-1.499zM5.562 3H13V1.78a.5.5 0 0 0-.621-.484zM1.5 4a.5.5 0 0 0-.5.5v9a.5.5 0 0 0 .5.5h13a.5.5 0 0 0 .5-.5v-9a.5.5 0 0 0-.5-.5z" />
                    </svg></button>
                <h5 class="text-uppercase">money back guaranteed</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, id?</p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle bg-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="32"
                        height="32" fill="white" class="bi bi-shield-lock" viewBox="0 0 16 16">
                        <path
                            d="M5.338 1.59a61 61 0 0 0-2.837.856.48.48 0 0 0-.328.39c-.554 4.157.726 7.19 2.253 9.188a10.7 10.7 0 0 0 2.287 2.233c.346.244.652.42.893.533q.18.085.293.118a1 1 0 0 0 .101.025 1 1 0 0 0 .1-.025q.114-.034.294-.118c.24-.113.547-.29.893-.533a10.7 10.7 0 0 0 2.287-2.233c1.527-1.997 2.807-5.031 2.253-9.188a.48.48 0 0 0-.328-.39c-.651-.213-1.75-.56-2.837-.855C9.552 1.29 8.531 1.067 8 1.067c-.53 0-1.552.223-2.662.524zM5.072.56C6.157.265 7.31 0 8 0s1.843.265 2.928.56c1.11.3 2.229.655 2.887.87a1.54 1.54 0 0 1 1.044 1.262c.596 4.477-.787 7.795-2.465 9.99a11.8 11.8 0 0 1-2.517 2.453 7 7 0 0 1-1.048.625c-.28.132-.581.24-.829.24s-.548-.108-.829-.24a7 7 0 0 1-1.048-.625 11.8 11.8 0 0 1-2.517-2.453C1.928 10.487.545 7.169 1.141 2.692A1.54 1.54 0 0 1 2.185 1.43 63 63 0 0 1 5.072.56" />
                        <path
                            d="M9.5 6.5a1.5 1.5 0 0 1-1 1.415l.385 1.99a.5.5 0 0 1-.491.595h-.788a.5.5 0 0 1-.49-.595l.384-1.99a1.5 1.5 0 1 1 2-1.415" />
                    </svg></button>
                <h5 class="text-uppercase">secure payment</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, id?</p>
            </div>
            <div class="col-xxl-3 col-xl-3 col-md-6 col-sm-6 col-12 text-center">
                <button class="btn rounded-circle bg-secondary"><svg xmlns="http://www.w3.org/2000/svg" width="32"
                        height="32" fill="white" class="bi bi-check-square" viewBox="0 0 16 16">
                        <path
                            d="M14 1a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1zM2 0a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2z" />
                        <path
                            d="M10.97 4.97a.75.75 0 0 1 1.071 1.05l-3.992 4.99a.75.75 0 0 1-1.08.02L4.324 8.384a.75.75 0 1 1 1.06-1.06l2.094 2.093 3.473-4.425z" />
                    </svg></button>
                <h5 class="text-uppercase">authenticity 100% guaranteed</h5>
                <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique, id?</p>
            </div>
        </div>
    </div>

    <!-- END CATEGORY -->

    <script src="../js/bootstrap.js"></script>
</body>

</html>