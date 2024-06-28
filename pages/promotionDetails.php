<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
session_start();
if (empty($_SESSION['user_type'])) {
    header("Location : http://localhost/server/marketplace/pages/Login.php");
}
if ($_SESSION['user_type'] === 'Customer') {
    header("Location : http://localhost/server/marketplace/pages/home.php");
}
include('./nav.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Promotion Details</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #btnAdd {
            background-color: #1D3357;
        }

        #btnDelete {
            background-color: #E63946;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-3">
        <div class="row  align-items-center">
            <div class="col-8 col-md-10">
                <h2 class="display-5 fw-semibold" style="color: #1D3357;">Promotion Details</h2>
            </div>
            <div class="col-4 col-md-2">
                <button name="add" type="submit" class="btn float-end" id="btnAdd"><a href="http://localhost/server/marketplace/pages/insertPromotionDetails.php" class="text-light" style="text-decoration: none;"><i class="bi bi-plus-lg"></i>
                        Add</a></button>
            </div>
        </div>
        <table class="table table-bordered table-primary table-striped-columns table-hover   mt-3 text-center" id="doctorInfo">
            <caption>List of Promotion Details</caption>
            <thead>
                <tr>
                    <th>#</th>
                    <th>Promotion Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Discount Value</th>
                    <th>Discount Type</th>
                    <th>Products</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <?php
            $data = "SELECT details.Unique_Id, details.Promotion_Id,
            details.Product_Id, prom.Name AS promotionName,
            prom.Start_Date AS startDate,
            prom.End_Date AS endDate,
            prom.Discount_Value AS discountValue,
            prom.Discount_Type AS discountType,
            prod.Name AS productName
            FROM Product_Promotion details
            JOIN Promotions prom ON details.Promotion_Id = prom.Promotion_Id
            JOIN Products prod ON details.Product_Id = prod.Product_Id";
            $result = $database->query($data);
            if ($result->rowCount() > 0) {
                foreach ($result as $detail) {
                    echo "<tbody>";
                    echo "<tr id='newTr'>";
                    echo "<td>" . $detail['Unique_Id'] . "</td>";
                    echo "<td>" . $detail['promotionName'] . "</td>";
                    echo "<td>" . $detail['startDate'] . "</td>";
                    echo "<td>" . $detail['endDate'] . "</td>";
                    echo "<td>" . $detail['discountValue'] . "</td>";
                    echo "<td>" . $detail['discountType'] . "</td>";
                    echo "<td>" . $detail['productName'] . "</td>";
                    echo "<td><button class='btn delete-btn btn-sm' name='delete' id='btnDelete'><a href='http://localhost/server/marketplace/pages/deletePromotionDetails.php?deleteid=" . $detail['Unique_Id'] . "' class='text-dark' style='text-decoration: none;'>
                        <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='#F1FAEE' class='bi bi-trash3' viewBox='0 0 16 16'>
  <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
</svg>
                    </a></button></form></td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
            } else {
                echo "<tr><td colspan='8'>No Promotions Details found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>