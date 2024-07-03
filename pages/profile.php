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
if ($profilePicture == '') {
    $profilePicture = 'avatar.png';
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
</head>

<body>
    <div class="container-fluid px-5" style="background-color: #1D3557;">
        <h1 class="text-center text-white">Welcome to your Profile</h1>
        <div class="container mt-3 text-center">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="profile-picture">
                        <img src="../users_images/<?php echo $profilePicture ?>" class="img-fluid rounded-circle img-thumbnail" alt="Profile Picture">
                    </div>
                </div>
            </div>
        </div>
        <form id="doctorForm" method="POST" enctype="multipart/form-data">
            <div class="container mt-3">
                <div class="row">
                    <div class="col-12">
                        <label for="productName" class="form-label fw-semibold text-white">Profile Picture:</label>
                        <input type="file" class="form-control" id="profilePic" name="profilePic" value="<?php echo $profilePicture; ?>">
                    </div>
                    <div class="col-12">
                        <label for="productDescription" class="form-label fw-semibold text-white">First Name:</label>
                        <input type="text" class="form-control" id="FName" name="FName" value="<?php echo $fname; ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="qtyInStock" class="form-label fw-semibold text-white">Last Name:</label>
                        <input type="text" class="form-control" id="LName" name="LName" value="<?php echo $lname; ?>" required>
                    </div>
                    <div class="col-12">
                        <label for="productPrice" class="form-label fw-semibold text-white">Username:</label>
                        <input type="text" class="form-control" id="username" name="Username" value="<?php echo $username; ?>" r justify-content-centerequired>
                    </div>
                    <div class="col-12">
                        <label for="productImage" class="form-label fw-semibold text-white">Email:</label>
                        <input type="text" class="form-control" id="email" name="Email" value="<?php echo $email; ?>" required>
                    </div>
                    <div class="col-12">
                        <div class="text-center">
                            <button type="submit" name="submit" class="btn mt-3 px-5 py-2 mb-3" id="update" style="background-color: #E63946;color:white">Edit Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $user_image = $_FILES['profilePic']['name'];
            $temporary_image = $_FILES['profilePic']['tmp_name'];
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
            $update->bindParam("profilePicture", $user_image);
            if ($update->execute()) {
                echo '<div class="alert alert-success" role="alert">
                                A simple success alert—check it out!
                            </div>';
            } else {
                echo '<div class="alert alert-danger" role="alert">
                                A simple success alert—check it out!
                            </div>';
            }
            header('location:login.php');
        }
        ?>
    </div>
</body>

</html>
<?php
include("./footer.php");
?>