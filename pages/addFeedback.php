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
    <title>Feedback Form</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Custom styles -->
    <style>
        body {
            background-color: #F1FAEE;
            /* Lightest background color */
        }

        .form-container {
            max-width: 600px;
            margin: 100px auto;
            /* Center the container */
            padding: 30px;
            background-color: #457B9D;
            /* Main background color */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-control {
            background-color: #A8DADC;
            /* Input background color */
            color: #1D3557;
            /* Input text color */
        }

        .form-control:focus {
            background-color: #F1FAEE;
            /* Input background color on focus */
            color: #1D3557;
            /* Input text color on focus */
        }

        .btn-submit {
            background-color: #E63946;
            /* Submit button color */
            border-color: #E63946;
            /* Submit button border color */
            color: #F1FAEE;
            /* Submit button text color */
        }

        .btn-submit:hover {
            background-color: #1D3557;
            /* Submit button color on hover */
            border-color: #1D3557;
            /* Submit button border color on hover */
            color: #F1FAEE;
        }
    </style>
</head>

<body>
    <div class="container form-container">
        <h2 class="text-center mb-4" style="color: #F1FAEE;">Feedback Form</h2>
        <form method="post">
            <div class="form-group">
                <label for="feedbackTitle" class="text-light">Feedback Title</label>
                <input type="text" class="form-control" id="feedbackTitle" placeholder="Enter feedback title" name="title" required>
            </div>
            <div class="form-group">
                <label for="feedbackText" class="text-light">Feedback Text</label>
                <textarea class="form-control" id="feedbackText" rows="5" placeholder="Enter your feedback" name="text" required></textarea>
            </div>
            <button type="submit" class="btn btn-submit btn-block" name="submit">Submit</button>
        </form>
        <?php
        if (isset($_POST['submit'])) {
            $getId = $database->prepare('SELECT Customer_Id FROM users WHERE Username = :username');
            $getId->bindParam('username', $customerName);
            $getId->execute();
            $cId = $getId->fetchColumn();
            $haveFeedback = $database->prepare('SELECT Feedback_Id FROM feedback WHERE Customer_Id = :Customer_Id');
            $haveFeedback->bindParam('Customer_Id', $cId);
            $haveFeedback->execute();
            $feedbackId = $haveFeedback->fetchColumn();

            if ($feedbackId) {
                echo '<div class="alert alert-danger text-center mt-3" role="alert">
                "You have provided feedback before."
              </div>';
            } else {
                $currentDate = date('Y-m-d');
                $setFeddback = $database->prepare('INSERT INTO feedback(Title,Text,Date,Customer_Id) 
        VALUES(:Title,:Text,:Date,:Customer_Id)');
                $setFeddback->bindParam('Title', $_POST['title']);
                $setFeddback->bindParam('Text', $_POST['text']);
                $setFeddback->bindParam('Date', $currentDate);
                $setFeddback->bindParam('Customer_Id', $cId);
                if ($setFeddback->execute()) {
                    header("Location:http://localhost/server/marketplace/pages/home.php");
                }
            }
        }
        ?>
    </div>

    <!-- Bootstrap JS and dependencies (jQuery, Popper.js) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>