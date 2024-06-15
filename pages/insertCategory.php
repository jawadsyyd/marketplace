<?php
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;',$username,$password);
    session_start();
        if(empty($_SESSION['user_type'])){
            header("Location : http://localhost/server/marketplace/pages/Login.php");
        }
        if($_SESSION['user_type'] === 'Customer'){
            header("Location : http://localhost/server/marketplace/pages/home.php");
        }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body class="my-5 mx-5">
    <div class="container-fluid border" style="border-radius: 10px; background-color: rgb(188, 227, 226);">
        <h1 class="my-3 text-center">Add Category</h1>
        <form id="doctorForm" method="POST" enctype="multipart/form-data" class="text-center">
            <input type="text" class="form-control my-3" name="categoryName" id="" placeholder="Enter A Category Name"
                required>
            <button type="submit" class="btn bg-light px-5 mb-3" name="submit">Add</button>
        </form>
    </div>

    <?php
      if (isset($_POST['submit'])) {
        $categoryName = htmlspecialchars($_POST['categoryName']);

        try {
          $addCategory = $database->prepare("INSERT INTO categories (Category_Name) VALUES(:Category_Name)");
          $addCategory->bindParam(":Category_Name", $categoryName);
          $addCategory->execute();

          echo '<div class="alert alert-success" role="alert">
                Category added successfully!
              </div>';
          header("Location:http://localhost/server/marketplace/pages/categories.php");
        } catch (PDOException $e) {
          echo '<div class="alert alert-danger" role="alert">
                Error adding category! ' . $e->getMessage() . '
              </div>';
        }
      }
      ?>
</body>

</html>