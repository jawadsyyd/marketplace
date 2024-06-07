<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=clinicdb;', $username, $password);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctors</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="mx-5 my-3">
    <a href="./home.php" style="text-decoration: none;color:black"><i class="bi bi-arrow-left-circle"
            style="font-size: 40px;"></i></a>
    <div class="row">
        <div class="col-8 col-md-10">
            <h2>Doctors</h2>
        </div>
        <div class="col-4 col-md-2">
            <button type="submit" class="btn btn-primary float-end"><a href="insertDoctor.php" class="text-light"
                    style="text-decoration: none;"><i class="bi bi-plus-lg"></i>
                    Add</a></button>
        </div>
    </div>
    <table class="table table-success  table-striped-columns table-bordered mt-3 text-center" id="doctorInfo">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Description</th>
                <th>Quantity in Stock</th>
                <th>Price</th>
                <th>Operations</th>
            </tr>
        </thead>
        <?php
    $data = "SELECT * FROM products";
    $result = $database->query($data);
    if ($result->rowCount() > 0) {
      foreach ($result as $product) {
        echo "<tbody>";
        echo "<tr id='newTr'>";
        echo "<td>" . $product['Product_id'] . "</td>";
        echo "<td>" . $product['Name'] . "</td>";
        echo "<td>" . $product['Description'] . "</td>";
        echo "<td>" . $product['Qty_In_Stock'] . "</td>";
        echo "<td>" . $product['Price'] . "</td>";
        echo "<td><button class='btn update-btn btn-warning btn-sm' name='update'><a href='updateProduct.php?updateid=" . $product['Doctor_id'] . "'' class='text-dark' style='text-decoration: none;'><i class='bi bi-pencil-square' style='color:white;'></i></a></button> ";
        echo " <button class='btn delete-btn btn-danger btn-sm' name='delete'><a href='deleteProduct.php?deleteid=" . $product['Doctor_id'] . "' class='text-dark' style='text-decoration: none;'><i class='bi bi-trash'></i></a></button></form></td>";
        echo "</tr>";
        echo "</tbody>";
      }
    } else {
      echo "<tr><td colspan='7'>No doctors found</td></tr>";
    }
    ?>
    </table>
</body>

</html>