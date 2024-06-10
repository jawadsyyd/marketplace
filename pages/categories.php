<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

</head>

<body class="mx-5 my-3">
    <a href="./home.php" style="text-decoration: none;color:black"><i class="bi bi-arrow-left-circle"
            style="font-size: 40px;"></i></a>
    <div class="row">
        <div class="col-8 col-md-10">
            <h2>Categories</h2>
        </div>
        <div class="col-4 col-md-2 position-relative">
            <button type="button" class="btn btn-primary position-absolute end-0" data-bs-toggle="modal"
                data-bs-target="#exampleModal">
                Add
            </button>
        </div>
    </div>
    <table class="table table-success  table-striped-columns table-bordered mt-3 text-center" id="doctorInfo">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Operations</th>
            </tr>
        </thead>
        <?php
    $data = "SELECT * FROM Categories";
    $result = $database->query($data);
    if ($result->rowCount() > 0) {
      foreach ($result as $category) {
        echo "<tbody>";
        echo "<tr id='newTr'>";
        echo "<td>" . $category['Category_Id'] . "</td>";
        echo "<td>" . $category['Category_Name'] . "</td>";
        echo "<td><button class='btn update-btn btn-warning btn-sm' name='update'><a href='http://localhost/server/marketplace/pages/updateCategory.php?updateid=" . $category['Category_Id'] . "'' class='text-dark' style='text-decoration: none;'><i class='bi bi-pencil-square' style='color:white;'></i></a></button> ";
        echo " <button class='btn delete-btn btn-danger btn-sm' name='delete'><a href='http://localhost/server/marketplace/pages/deleteCategory.php?deleteid=" . $category['Category_Id'] . "' class='text-dark' style='text-decoration: none;'><i class='bi bi-trash'></i></a></button></form></td>";
        echo "</tr>";
        echo "</tbody>";
      }
    } else {
      echo "<tr><td colspan='7'>No doctors found</td></tr>";
    }
    ?>
    </table>
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="" method="post" class="py-5 container position-relative">
                    <input type="text" class="form-control mb-5" name="catName" id=""
                        placeholder="Enter A Category Name" required>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" name="add">Add</button>
                    <?php
if(isset($_POST['add'])){
    $addCategory = $database->prepare("INSERT INTO categories(Category_Name) VALUES(:catName)");
    $addCategory->bindParam("catName",$_POST['catName']);
    if($addCategory->execute()){
        header("Location:http://localhost/server/marketplace/pages/categories.php");
    }else{
    }
}
?>
                </form>

            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>