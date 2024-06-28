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
include('./nav.php');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        #btnAdd {
            background-color: #1D3357;
        }

        #btnDelete {
            background-color: #E63946;
        }
    </style>
</head>

<body>
    <div class="container-fluid p-3">
        <div class="row align-items-center">
            <div class="col-8 col-md-10">
                <h2 class="display-5 fw-semibold" style="color: #1D3357;">Products</h2>
            </div>
            <div class="col-4 col-md-2">
                <button name="add" type="submit" class="btn float-end" id="btnAdd"><a href="http://localhost/server/marketplace/pages/insertProduct.php" class="text-light" style="text-decoration: none;"><i class="bi bi-plus-lg"></i>
                        Add</a></button>
            </div>
        </div>
        <table class="table table-bordered table-primary table-striped-columns table-hover   mt-3 text-center" id="doctorInfo">
            <caption>List of Products</caption>

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
                    echo "<td>" . $product['Product_Id'] . "</td>";
                    echo "<td>" . $product['Name'] . "</td>";
                    echo "<td>" . $product['Description'] . "</td>";
                    echo "<td>" . $product['Qty_In_Stock'] . "</td>";
                    echo "<td>" . $product['Price'] . "</td>";
                    echo "<td><button class='btn update-btn btn-warning btn-sm' name='update'><a href='http://localhost/server/marketplace/pages/updateProduct.php?updateid=" . $product['Product_Id'] . "'' class='text-dark' style='text-decoration: none;'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='#F1FAEE' class='bi bi-pencil-square' viewBox='0 0 16 16'>
  <path d='M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z'/>
  <path fill-rule='evenodd' d='M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z'/>
</svg>
                    
                    </a></button> ";
                    echo " <button class='btn delete-btn btn-sm' name='delete' id='btnDelete'><a href='http://localhost/server/marketplace/pages/deleteProduct.php?deleteid=" . $product['Product_Id'] . "' class='text-dark' style='text-decoration: none;'>
                    <svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='#F1FAEE' class='bi bi-trash3' viewBox='0 0 16 16'>
  <path d='M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5'/>
</svg>
                    </a></button></form></td>";
                    echo "</tr>";
                    echo "</tbody>";
                }
            } else {
                echo "<tr><td colspan='7'>No doctors found</td></tr>";
            }
            ?>
        </table>
    </div>
</body>

</html>