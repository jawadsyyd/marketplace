<?php
$username = 'root';
$servername = "localhost";
$password = '';
$dbname = "bishop";
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
$conn = new mysqli($servername, $username, $password, $dbname);
?>

<?php
$id = $_GET['updateid'];
$select = "SELECT * FROM products WHERE Doctor_id=$id";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$name = $row['Name'];
$description = $row['Description'];
$price = $row['Price'];
$Image = $row['Image'];
$qty = $row['Qty_In_Stock'];
$cid = $row['Category_Id'];
if (isset($_POST['submit'])) {
    $update = $database->prepare("UPDATE products SET
                Product_id=$id,
                Name =:Name,
                Description =:Description,
                Price =:Price,
                Image =:Image,
                Qty_In_Stock =:Qty_In_Stock,
                Category_Id =:Category_Id
                WHERE Product_id=$id");

    $update->bindParam("Name", $_POST['productName']);
    $update->bindParam("Description", $_POST['productDescription']);
    $update->bindParam("Price", $_POST['productPrice']);
    $update->bindParam("Image", $_POST['productImage']);
    $update->bindParam("Qty_In_Stock", $_POST['qtyInStock']);
    $update->bindParam("Category_Id", $_POST['productCategory']);
    if ($update->execute()) {
        echo '<div class="alert alert-success" role="alert">
                            A simple success alert—check it out!
                        </div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">
                            A simple success alert—check it out!
                        </div>';
    }
    header('location:products.php');
}
?>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Doctor</title>
</head>

<body class="my-5 mx-5">
    <div class="container-fluid border" style="border-radius: 10px; background-color: rgb(188, 227, 226);">
        <h1 class="mt-3 text-center">Update Doctor</h1>
        <form id="doctorForm" method="POST">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productName" class="form-label fw-semibold">Name:</label>
                        <input type="text" class="form-control" id="productName" name="productName" value=<?php echo $name; ?>>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productDescription" class="form-label fw-semibold">Description:</label>
                        <textarea type="text" class="form-control" id="productDescription" name="productDescription" value=<?php echo $description; ?>></textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qtyInStock" class="form-label fw-semibold">>Quantity In Stock:</label>
                        <input type="text" class="form-control" id="qtyInStock" name="qtyInStock"
                            value=<?php echo $price; ?>>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productPrice" class="form-label fw-semibold">Price:</label>
                        <input type="tel" class="form-control" id="productPrice" name="productPrice"
                            value=<?php echo $Image; ?>>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productImage" class="form-label fw-semibold">Image:</label>
                        <input type="text" class="form-control" id="productImage" name="productImage"
                            value=<?php echo $qty; ?>>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productCategory" class="form-label fw-semibold">Category:</label>
                        <input type="tel" class="form-control" id="productCategory" name="productCategory"
                            value=<?php echo $cid; ?>>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="submit" class="btn btn-primary" id="update">Update Product</button>
            </div>
        </form>
    </div>
</body>

</html>