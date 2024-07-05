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
$checkUserType = $database->prepare("SELECT UserType FROM users WHERE Username = :Username");
$checkUserType->bindParam("Username", $customerName);
$checkUserType->execute();
$userType = $checkUserType->fetchColumn();
if ($userType == 'Admin') {
  header("Location: http://localhost/server/marketplace/pages/cart.php");
} else {
  $cName = $customerName;
  $getCustomerId = $database->prepare("SELECT Customer_Id FROM users WHERE Username = :username");
  $getCustomerId->bindParam('username', $cName);
  $getCustomerId->execute();
  $cId = $getCustomerId->fetchColumn();

  $checkIfCustomerHaveACreditCard = $database->prepare('SELECT Customer_Id FROM credit_card WHERE Customer_Id = :cId');
  $checkIfCustomerHaveACreditCard->bindParam('cId', $cId);
  $checkIfCustomerHaveACreditCard->execute();
  $haveACredit = $checkIfCustomerHaveACreditCard->fetchColumn();

  $cartisEmpty = $database->prepare('SELECT Order_Id FROM orders WHERE Customer_Id = :cId');
  $cartisEmpty->bindParam('cId', $cId);
  $cartisEmpty->execute();
  $orderId =  $cartisEmpty->fetchColumn();

  if ($haveACredit) {
    if ($orderId) {
      $totalPrice = $database->prepare("SELECT SUM(Price) FROM orders WHERE Customer_Id = :cID");
      $totalPrice->bindParam('cID', $cId);
      $totalPrice->execute();
      $finalPrice = $totalPrice->fetchColumn();
      $withTVA = $finalPrice + ($finalPrice * 11 / 100);

      $getAmount = $database->prepare('SELECT Amount FROM credit_card WHERE Customer_Id = :Customer_Id');
      $getAmount->bindParam('Customer_Id', $cId);
      $getAmount->execute();
      $amount = $getAmount->fetchColumn();

      $updateAmount = $database->prepare('UPDATE credit_card SET Amount = :Amount WHERE Customer_Id = :Customer_Id');
      $newPrice = $amount - $withTVA;
      $updateAmount->bindParam('Amount', $newPrice);
      $updateAmount->bindParam('Customer_Id', $cId);
      if ($updateAmount->execute()) {
        $deleteProductsFromCart = $database->prepare("DELETE FROM orders WHERE Customer_Id = :Customer_Id");
        $deleteProductsFromCart->bindParam("Customer_Id", $cId);
        if ($deleteProductsFromCart->execute()) {
          $getEmailAddress = $database->prepare('SELECT Email FROM users WHERE Customer_Id = :Customer_Id');
          $getEmailAddress->bindParam("Customer_Id", $cId);
          $getEmailAddress->execute();
          $customerEmail = $getEmailAddress->fetchColumn();
          require_once "../mail.php";
          $mail->addAddress($customerEmail);
          $mail->Subject = 'Order Confirmation';
          $mail->Body    = 'Thank you for your order, !<br><br>Your address: ' . $customerEmail . '<br>Your order price:$ ' . $withTVA . '<br><br>We will contact you soon for further details.';
          $mail->setFrom('tradtechstore@gmail.com', 'TradTech Store');
          $mail->send();
          header("Location: http://localhost/server/marketplace/pages/thanks.php");
        }
      }
    } else {
      header("Location: http://localhost/server/marketplace/pages/showProducts.php");
    }
  } else {
    header("Location: http://localhost/server/marketplace/pages/CreditCard.php?customerName=$cName");
  }
}
?>