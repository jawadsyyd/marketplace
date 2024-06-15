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
$select = "SELECT * FROM products WHERE Product_Id=$id";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$name = $row['Name'];
$description = $row['Description'];
$price = $row['Price'];
$Image = $row['Image'];
$qty = $row['Qty_In_Stock'];
$cid = $row['Category_Id'];
$select_category = "SELECT * FROM categories WHERE Category_Id = $cid";
$result_category = mysqli_query($conn, $select_category);
$row_category = mysqli_fetch_assoc($result_category);
$category_name = $row_category['Category_Name'];
if (isset($_POST['submit'])) {
    $prod_image = $_FILES['Image']['name'];
    $temporary_image = $_FILES['Image']['tmp_name'];
    move_uploaded_file($temporary_image, "../products_images/$prod_image");

    $update = $database->prepare("UPDATE products SET
                Name =:Name,
                Description =:Description,
                Price =:Price,
                Image =:Image,
                Qty_In_Stock =:Qty_In_Stock,
                Category_Id =:Category_Id
                WHERE Product_Id=$id");

    $update->bindParam("Name", $_POST['productName']);
    $update->bindParam("Description", $_POST['productDescription']);
    $update->bindParam("Price", $_POST['productPrice']);
    $update->bindParam("Image", $prod_image);
    echo $prod_image;
    $update->bindParam("Qty_In_Stock", $_POST['qtyInStock']);
    $update->bindParam("Category_Id", $_POST['Categories']);
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
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="my-5 mx-5">
    <div class="container-fluid border" style="border-radius: 10px; background-color: rgb(188, 227, 226);">
        <h1 class="mt-3 text-center">Update Product</h1>
        <form id="doctorForm" method="POST" enctype="multipart/form-data">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productName" class="form-label fw-semibold">Name:</label>
                        <input type="text" class="form-control" id="productName" name="productName"
                            value="<?php echo $name; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productDescription" class="form-label fw-semibold">Description:</label>
                        <textarea type="text" class="form-control" id="productDescription" name="productDescription">
                            <?php echo $description; ?>
                        </textarea>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qtyInStock" class="form-label fw-semibold">Price:</label>
                        <input type="text" class="form-control" id="qtyInStock" name="productPrice"
                            value="<?php echo $price; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productPrice" class="form-label fw-semibold">Image:</label>
                        <input type="file" class="form-control" id="productPrice" name="Image" value="<?php $Image; ?>">
                        <img src="../products_images/<?php $Image; ?>" alt="">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productImage" class="form-label fw-semibold">Quantity In Stock:</label>
                        <input type="text" class="form-control" id="productImage" name="qtyInStock"
                            value="<?php echo $qty; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productCategory" class="form-label fw-semibold">Category:</label>
                        <select name="Categories" id="Categories" class="form-select">
                            <option value="<?php echo $category_id?>"><?php echo $category_name?></option>
                            <?php
                            $select_all_category = "SELECT * FROM categories";
                            $result_all_category = mysqli_query($conn, $select_all_category);
                            while($row_all_category = mysqli_fetch_assoc($result_all_category)){
                                $catName = $row_all_category['Category_Name'];
                                $catId = $row_all_category['Category_Id'];
                                echo "<option value='$catId'>$catName</option>";
                            } 
                            ?>
                        </select>
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