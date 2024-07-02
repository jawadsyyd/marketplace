<?php 
$username = 'root';
$serverName = "localhost";
$password = '';
$dbname = "bishop";
$database = new PDO('mysql:host=localhost;dbname=bishop;', $username, $password);
$conn = new mysqli($serverName, $username, $password, $dbname);
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

<?php
$getCustomerId = $database->prepare('SELECT Customer_Id FROM users WHERE Username = :Username');
$getCustomerId->bindParam("Username", $customerName);
$getCustomerId->execute();
$idOfCustomer = $getCustomerId->fetch();
$id = $idOfCustomer['Customer_Id'];
$select = "SELECT FName, LName, Email, Username, profilePicture FROM users WHERE Customer_Id = $id";
$result = mysqli_query($conn, $select);
$row = mysqli_fetch_assoc($result);
$fname = $row['FName'];
$lname = $row['LName'];
$email = $row['Email'];
$username = $row['Username'];
$profilePicture = $row['profilePicture'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>
<body>
    <div class="container-fluid border">
        <h1 class="mt-3 text-center">Welcome to your Profile</h1>
        <form id="doctorForm" method="POST" enctype="multipart/form-data">
            <div class="container mt-4">
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productName" class="form-label fw-semibold">Profile Picture:</label>
                        <input type="file" class="form-control" id="profilePic" name="profilePic"
                            value="<?php echo $profilePicture; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productDescription" class="form-label fw-semibold">First Name:</label>
                        <input type="text" class="form-control" id="FName" name="FName" value="<?php echo $fname; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="qtyInStock" class="form-label fw-semibold">Last Name:</label>
                        <input type="text" class="form-control" id="LName" name="LName"
                            value="<?php echo $lname; ?>">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label for="productPrice" class="form-label fw-semibold">Username:</label>
                        <input type="text" class="form-control" id="username" name="username" value="<?php $username; ?>">
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label for="productImage" class="form-label fw-semibold">Email:</label>
                        <input type="text" class="form-control" id="email" name="email"
                            value="<?php echo $email; ?>">
                    </div>
                </div>
            </div>
            <div class="text-center mb-3">
                <button type="submit" name="submit" class="btn btn-primary" id="update">Edit Profile</button>
            </div>
        </form>
    </div>
</body>
</html>
<?php 
    include("./footer.php");
?>

<?php 
    if (isset($_POST['submit'])) {
        $user_image = $_FILES['Image']['name'];
        $temporary_image = $_FILES['Image']['tmp_name'];
        move_uploaded_file($temporary_image, "../users_images/$user_image");
    
        $update = $database->prepare("UPDATE users SET
                    FName =:FName,
                    LName =:LName,
                    Email =:Email,
                    Username =:Username,
                    profilePicture =:profilePicture
                    WHERE Customer_Id=$id");
    
        $update->bindParam("FName", $_POST['FName']);
        $update->bindParam("LName", $_POST['LName']);
        $update->bindParam("Email", $_POST['Email']);
        $update->bindParam("Username", $_POST['Username']);
        $update->bindParam("profilePicture", $prod_image);
        if ($update->execute()) {
            echo '<div class="alert alert-success" role="alert">
                                A simple success alert—check it out!
                            </div>';
        } else {
            echo '<div class="alert alert-danger" role="alert">
                                A simple success alert—check it out!
                            </div>';
        }
        header('location:home.php');
    }
?>