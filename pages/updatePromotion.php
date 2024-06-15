<?php
$username = 'root';
$serverName = "localhost";
$password = '';
$dbname = "bishop";
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
$conn = new mysqli($serverName, $username, $password, $dbname);
session_start();
        if(empty($_SESSION['user_type'])){
            header("Location : http://localhost/server/marketplace/pages/Login.php");
        }
        if($_SESSION['user_type'] === 'Customer'){
            header("Location : http://localhost/server/marketplace/pages/home.php");
        }
?>

<?php
$id = $_GET['updateid'];
$select = "SELECT * FROM promotions WHERE Promotion_Id=$id";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$name = $row['Name'];
$start_date = $row['Start_Date'];
$end_Date = $row['End_Date'];
$discountType= $row['Discount_Type'];
$discountValue = $row['Discount_Value'];

if (isset($_POST['submit'])) {

    $update = $database->prepare("UPDATE promotions SET
                Name =:Name,
                Start_Date =:Start_Date,
                End_Date =:End_Date,
                Discount_Type =:Discount_Type,
                Discount_Value =:Discount_Value
                WHERE Promotion_Id=$id");

    $update->bindParam("Name",$_POST['Name']);
    $update->bindParam("Start_Date",$_POST['Start_Date']);
    $update->bindParam("End_Date",$_POST['End_Date']);
    $update->bindParam("Discount_Type",$_POST['Discount_Type']);
    $update->bindParam("Discount_Value",$_POST['Discount_Value']);
    if ($update->execute()) {
        echo '<div class="alert alert-success" role="alert">
                            A simple success alert—check it out!
                        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                            A simple success alert—check it out!
                        </div>';
    }
    header('location:promotions.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Promotion</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="my-5 mx-5">
    <div class="container-fluid border" style="border-radius: 10px; background-color: rgb(188, 227, 226);">
        <h1 class="mt-3 text-center">Update Promotion</h1>
        <form id="doctorForm" method="POST" enctype="multipart/form-data">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productName" class="form-label fw-semibold">Name:</label>
                        <input type="text" class="form-control" id="productName" name="Name"
                            value="<?php echo $name; ?>" required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productPrice" class="form-label fw-semibold">Discount Type:</label>
                        <input type="text" name="Discount_Type" class="form-control" value="<?php echo $discountType?>"
                            required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productDescription" class="form-label fw-semibold">Start date:</label>
                        <input type="date" name="Start_Date" class="form-control" value="<?php echo $start_date?>"
                            required>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productImage" class="form-label fw-semibold">discount Value:</label>
                        <input type="text" name="Discount_Value" class="form-control"
                            value="<?php echo $discountValue?>" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qtyInStock" class="form-label fw-semibold">End Date:</label>
                        <input type="date" name="End_Date" class="form-control" value="<?php echo $end_Date?>" required>
                    </div>
                </div>
            </div>
            <div class="text-center mb-3">
                <button type="submit" name="submit" class="btn btn-primary" id="update">Update Product</button>
            </div>
        </form>
    </div>
</body>

</html>