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
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Promotion Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="my-5 mx-5">
    <form method="POST">
        <div class="container-fluid border pb-5 position-relative text-center" style="border-radius: 10px; background-color: rgb(188, 227, 226); height:540px;">
            <h1 class="text-center">Promotion Details</h1>
            <div class="container mt-4">
                <div class="row">
                    <div class="col-6">
                        <label for="">Promotion:</label>
                        <select name="Promotions" id="Promotions" class="form-select">
                            <option value="">Select A Promotion</option>
                            <?php
                            $getPromotionName = $database->prepare("SELECT * FROM Promotions");
                            $getPromotionName->execute();
                            print_r($getPromotionName);
                            if ($getPromotionName->rowCount() > 0) {
                                foreach ($getPromotionName as $promName) {
                                    echo "<option value='" . $promName['Promotion_Id'] . "'>" . $promName['Name'] . "</option>";
                                }
                            } else {
                                echo "<option value='NotFound' selected>Not Found</option>";
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="table" style="height: 200px;">
                        <?php
                        $products = $database->query("SELECT p.Product_Id, p.Name, p.Category_Id, c.Category_Name AS categoryName FROM Products p JOIN Categories c ON p.Category_Id = c.Category_Id")->fetchAll(PDO::FETCH_ASSOC);
                        ?>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Select</th>
                                    <th>Product Name</th>
                                    <th>Category Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($products as $product) : ?>
                                    <tr>
                                        <td><input type="checkbox" name="productIds[]" value="<?php echo $product['Product_Id']; ?>"></td>
                                        <td><?php echo $product['Name']; ?></td>
                                        <td><?php echo $product['categoryName']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="row position-absolute  bottom-0 end-0 mb-3 me-1">
                    <div class="text-center">
                        <button type="submit" name="submit" class="btn btn-primary">Add Details</button>
                    </div>
                </div>
            </div>

        </div>
    </form>
</body>

</html>

<?php
if (isset($_POST['submit'])) {

    if (isset($_POST['productIds'])) {
        $productIds = $_POST['productIds'];
        $getPromotionId = $database->prepare('SELECT Promotion_Id FROM Promotions WHERE Promotion_ID = :promName');
        $getPromotionId->bindParam("promName", $_POST['Promotions']);
        $getPromotionId->execute();
        $Promotion_id = $getPromotionId->fetchColumn();

        foreach ($productIds as $productId) {
            $insertPromotionProduct = $database->prepare("INSERT INTO Product_promotion(Promotion_Id, Product_Id) VALUES(:Promotion_Id, :Product_Id)");
            $insertPromotionProduct->bindParam("Promotion_Id", $Promotion_id);
            $insertPromotionProduct->bindParam("Product_Id", $productId);
            $insertPromotionProduct->execute();
        }

        header("Location: http://localhost/server/marketplace/pages/promotionDetails.php");
    } else {
        echo "<p class='text-center text-danger'>Please select a promotion and products!</p>";
    }
}
?>