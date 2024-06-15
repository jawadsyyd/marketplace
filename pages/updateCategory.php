<?php
$username = 'root';
$password = '';
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
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
<?php

if(isset($_GET['updateid'])) {
    $updateid = $_GET['updateid'];

    $getCatName = $database->prepare("SELECT Category_Name FROM categories WHERE Category_Id = :id");
    $getCatName->bindParam("id",$updateid);
    $getCatName->execute();
    $catName = $getCatName->fetchColumn();
} else {
    echo "updateid parameter is missing in the URL.";
}
?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Category</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body class="my-5 mx-5">
    <div class="container-fluid border" style="border-radius: 10px; background-color: rgb(188, 227, 226);">
        <h1 class="my-3 text-center">Update Category</h1>
        <form id="doctorForm" method="POST" enctype="multipart/form-data" class="text-center">
            <input type="text" class="form-control my-3" name="catName" id="" placeholder="Enter A Category Name"
                value="<?php echo$catName?>" required>
            <button type="submit" class="btn bg-light px-5 mb-3" name="submit">Update</button>
        </form>
    </div>
</body>

</html>
<?php
if(isset($_POST['submit'])){
    $updateCatName = $database->prepare("UPDATE categories SET Category_Name = :catName
    WHERE Category_Id = :id");
    $updateCatName->bindParam("catName",$_POST['catName']);
    $updateCatName->bindParam("id",$updateid);
    if($updateCatName->execute()){
        header("Location: http://localhost/server/marketplace/pages/categories.php");
    }
    else{
        echo '<div class="alert alert-danger" role="alert">
  Failed to update Category Name
</div>';
    }
}
?>