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
    <title>Promotions</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container-fluid">
        <a href="./home.php" style="text-decoration: none;color:black"><i class="bi bi-arrow-left-circle" style="font-size: 40px;"></i></a>
        <div class="row">
            <div class="col-8 col-md-10">
                <h2>Promotions</h2>
            </div>
            <div class="col-4 col-md-2">
                <button name="add" type="submit" class="btn btn-primary float-end"><a href="http://localhost/server/marketplace/pages/insertPromotion.php" class="text-light" style="text-decoration: none;"><i class="bi bi-plus-lg"></i>
                        Add</a></button>
            </div>
        </div>
        <table class="table table-success  table-striped-columns table-bordered mt-3 text-center" id="doctorInfo">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Start Date</th>
                    <th>End Date</th>
                    <th>Discount Type</th>
                    <th>Discount Value</th>
                    <th>Operation</th>
                </tr>
            </thead>
            <?php
            $data = "SELECT * FROM promotions";
            $result = $database->query($data);
            if ($result->rowCount() > 0) {
                foreach ($result as $promotion) {
                    echo "<tbody>";
                    echo "<tr id='newTr'>";
                    echo "<td>" . $promotion['Promotion_Id'] . "</td>";
                    echo "<td>" . $promotion['Name'] . "</td>";
                    echo "<td>" . $promotion['Start_Date'] . "</td>";
                    echo "<td>" . $promotion['End_Date'] . "</td>";
                    echo "<td>" . $promotion['Discount_Type'] . "</td>";
                    echo "<td>" . $promotion['Discount_Value'] . "</td>";
                    echo "<td><button class='btn update-btn btn-warning btn-sm' name='update'><a href='http://localhost/server/marketplace/pages/updatePromotion.php?updateid=" . $promotion['Promotion_Id'] . "'' class='text-dark' style='text-decoration: none;'><i class='bi bi-pencil-square' style='color:white;'></i></a></button> ";
                    echo " <button class='btn delete-btn btn-danger btn-sm' name='delete'><a href='http://localhost/server/marketplace/pages/deletePromotion.php?deleteid=" . $promotion['Promotion_Id'] . "' class='text-dark' style='text-decoration: none;'><i class='bi bi-trash'></i></a></button></form></td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
            } else {
                echo "<tr><td colspan='8'>No Promotions found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>

<?php
$currentDate = date('Y-m-d');

$expiredPromotions = $database->query("SELECT * FROM promotions WHERE End_Date < '$currentDate'");
$expiredPromotions->execute();

if ($expiredPromotions->rowCount() > 0) {
    foreach ($expiredPromotions as $promotion) {
        $deletePromotion = $database->prepare("DELETE FROM Promotions WHERE Promotion_Id = :promotionId");
        $deletePromotion->bindParam("promotionId", $promotion['Promotion_Id']);
        $deletePromotion->execute();
    }
}

?>