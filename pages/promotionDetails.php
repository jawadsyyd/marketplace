<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
session_start();
        if(empty($_SESSION['user_type'])){
            header("Location : http://localhost/server/marketplace/pages/Login.php");
        }
        if($_SESSION['user_type'] === 'Customer'){
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="mx-5 my-3">
    <a href="./home.php" style="text-decoration: none;color:black"><i class="bi bi-arrow-left-circle"
            style="font-size: 40px;"></i></a>
    <div class="row">
        <div class="col-8 col-md-10">
            <h2>Promotion Details</h2>
        </div>
        <div class="col-4 col-md-2">
            <button name="add" type="submit" class="btn btn-primary float-end"><a
                    href="http://localhost/server/marketplace/pages/insertPromotionDetails.php" class="text-light"
                    style="text-decoration: none;"><i class="bi bi-plus-lg"></i>
                    Add</a></button>
        </div>
    </div>
    <table class="table table-success  table-striped-columns table-bordered mt-3 text-center" id="doctorInfo">
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
        echo "<td><button class='btn delete-btn btn-danger btn-sm' name='delete'><a href='http://localhost/server/marketplace/pages/deletePromotionDetails.php?deleteid=" . $detail['Unique_Id'] . "' class='text-dark' style='text-decoration: none;'><i class='bi bi-trash'></i></a></button></form></td>";
        echo "</tr>";
        echo "</tbody>";
      }
    } else {
      echo "<tr><td colspan='8'>No Promotions Details found</td></tr>";
    }
    ?>
    </table>
</body>

</html>