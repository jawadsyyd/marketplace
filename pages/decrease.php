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
?>
<?php
if (isset($_GET['productId'])) {
    $productID = $_GET['productId'];

    $checkPromotion = $database->prepare("SELECT Product_Id FROM product_promotion WHERE Product_Id = :Product_Id");
    $checkPromotion->bindParam('Product_Id', $productID);
    $checkPromotion->execute();
    $promoted = $checkPromotion->fetchColumn();

    if ($promoted) {
        $getPriceAfterPromotion = $database->prepare('SELECT P.Price, promotions.Discount_Value 
        FROM products P
        INNER JOIN product_promotion PP ON P.Product_Id = PP.Product_Id
        INNER JOIN promotions ON PP.Promotion_Id = promotions.Promotion_Id WHERE P.Product_Id = :Product_Id');
        $getPriceAfterPromotion->bindParam('Product_Id', $productID);
        $getPriceAfterPromotion->execute();
        $priceAfterPromotion = $getPriceAfterPromotion->fetch();
        $priceINeed = $priceAfterPromotion['Price'] - ($priceAfterPromotion['Price'] * $priceAfterPromotion['Discount_Value'] / 100);
    } else {
        $getPriceBeforePromotion = $database->prepare("SELECT Price FROM products WHERE Product_Id = :Product_Id");
        $getPriceBeforePromotion->bindParam('Product_Id', $productID);
        $getPriceBeforePromotion->execute();
        $priceBeforePromotion = $getPriceBeforePromotion->fetchColumn();
        $priceINeed = $priceBeforePromotion;
    }

    $CustomerID = $database->prepare('SELECT Customer_Id FROM users WHERE Username = :username');
    $CustomerID->bindParam('username', $customerName);
    $CustomerID->execute();
    $cid = $CustomerID->fetchColumn();

    $oldQuantity = $database->prepare('SELECT Qty,Price FROM orders WHERE Customer_Id = :Customer_Id AND Product_Id = :Product_Id');
    $oldQuantity->bindParam('Customer_Id', $cid);
    $oldQuantity->bindParam('Product_Id', $productID);
    $oldQuantity->execute();
    $quantity = $oldQuantity->fetch();
    if ($quantity > 1) {
        $updateQuantity = $database->prepare('UPDATE orders SET Qty = :newQty ,Price = :Price WHERE Customer_Id = :Customer_Id AND Product_Id = :Product_Id');
        $newQuantity = $quantity['Qty'] - 1;
        $newPrice = $priceINeed * $newQuantity;
        $updateQuantity->bindParam('newQty', $newQuantity);
        $updateQuantity->bindParam('Price', $newPrice);
        $updateQuantity->bindParam('Customer_Id', $cid);
        $updateQuantity->bindParam('Product_Id', $productID);
        if ($updateQuantity->execute()) {
            header('location:http://localhost/server/marketplace/pages/cart.php');
        }
    } else {
        header('location:http://localhost/server/marketplace/pages/cart.php');
    }
}
?>