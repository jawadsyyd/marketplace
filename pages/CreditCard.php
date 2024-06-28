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

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Credit Card Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="my-5 mx-5">
  <div class="container-fluid border" style="border-radius: 10px; background-color: rgb(188, 227, 226);">
    <h1 class="mt-3 text-center">Credit Card Info</h1>
    <form method="POST">
      <div class="container mt-4">
        <div class="row">
          <div class="col-md-12 mb-3">
            <label for="cardNumber" class="form-label fw-semibold">Card Number:</label>
            <input type="text" class="form-control" id="cardNumber" name="cardNumber" required maxlength="16">
          </div>
          <div class="col-md-6 mb-3">
            <label for="expirationMonth" class="form-label fw-semibold">Expiration Month:</label>
            <input type="number" class="form-control" id="expirationMonth" name="expirationMonth" min="1" max="12"
              required>
          </div>
          <div class="col-md-6 mb-3">
            <label for="expirationYear" class="form-label fw-semibold">Expiration Year:</label>
            <input type="number" class="form-control" id="expirationYear" name="expirationYear" min="2024" required>
          </div>
        </div>
        <div class="text-center pb-3">
          <button type="submit" name="submit" class="btn btn-primary">Submit</button>
        </div>
      </div>
    </form>
  </div>
</body>

</html>

<?php 
    if(isset($_POST["submit"])){
        $insert = $database->prepare("INSERT INTO credit_card (Card_Number, Expiration_Month, Expiration_Year)
        VALUES(:Card_Number, :Expiration_Month, :Expiration_Year)");
        $insert->bindParam('Card_Number', $_POST['cardNumber']);
        $insert->bindParam('Expiration_Month', $_POST['expirationMonth']);
        $insert->bindParam('Expiration_Year', $_POST['expirationYear']);
        $insert->execute();
        header("Location: http://localhost/server/marketplace/pages/thanks.php");
    }
?>