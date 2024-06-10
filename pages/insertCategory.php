<?php
    $username = 'root';
    $password = '';
    $database = new PDO('mysql:host=localhost;dbname=bishop;',$username,$password);
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
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .add-category-form {
      background-color: rgb(188, 227, 226);
      border-radius: 10px;
      padding: 20px;
      max-width: 400px;
    }
  </style>
</head>

<body>
  <div class="add-category-form">
    <h1 class="text-center">Add Category</h1>
    <form method="POST">
      <div class="row">
        <div class="col-12 mb-3">
          <label for="categoryName" class="form-label fw-semibold">Name:</label>
          <input type="text" class="form-control" id="categoryName" name="categoryName" required>
        </div>
      </div>

      <div class="text-center">
        <button type="submit" name="submit" class="btn btn-primary" id="submit">Add Category</button>
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
    </form>
  </div>
</body>

</html>
