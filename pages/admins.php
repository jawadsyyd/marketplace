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
include('./nav.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admins</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
  <div class="container mt-3">
    <h1 class="text-center mb-4">Admins</h1>
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">First Name</th>
          <th scope="col">Last Name</th>
          <th scope="col">Email</th>
          <th scope="col">Operations</th>
        </tr>
      </thead>
      <?php 
        $select = "SELECT User_id, FName, LName, Email FROM users WHERE UserType = 'Admin' AND Activated = false";
        $result = $database->query($select);
        if ($result->rowCount() > 0) {
            foreach($result as $user){
                echo "<tbody>";
                echo "<tr>";
                echo "<td>" . $user["FName"] . "</td>";
                echo "<td>" . $user["LName"] . "</td>";
                echo "<td>" . $user["Email"] . "</td>";
                echo "<td>
                    <a href='http://localhost/server/marketplace/pages/acceptAdmin.php?acceptId=" . $user["User_id"] . "' class='btn btn-sm btn-primary text-light' style='text-decoration= none;'>Accept</a>
                    <a href='http://localhost/server/marketplace/pages/rejectAdmin.php?rejectId=" . $user["User_id"] . "' class='btn btn-sm btn-danger text-light' style='text-decoration= none;'>Delete</a>
                </td>";
                echo "</tr>";
                echo "</tbody>";
            }
        }
      ?>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-wugyQjJSzWRXNqQPglzEAmvezruEj4WLlGt/u7Bs4Nwcq88RWuHqQlEKXIK1bBqn" crossorigin="anonymous"></script>
</body>
</html>
