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
$getCustomerId = $database->prepare("SELECT Customer_Id FROM users WHERE Username = :username");
$getCustomerId->bindParam('username', $customerName);
$getCustomerId->execute();
$cid = $getCustomerId->fetchColumn();

$deleteOrder = $database->prepare('DELETE FROM orders WHERE Customer_Id = :Customer_Id');
$deleteOrder->bindParam('Customer_Id', $cid);
$deleteOrder->execute();
header('Location:http://localhost/server/marketplace/pages/cart.php');
?>