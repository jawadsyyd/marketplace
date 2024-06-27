<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome To Bishop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body,
        html {
            height: 100%;
        }

        .container {
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .row {
            background-color: #457B9D;
        }

        #btnLogIn {
            background-color: #1D3557;
        }

        #btnSignUp {
            background-color: #E63946;
        }

        h1,
        h4 {
            color: #F1FAEE;
        }

        #logo {
            color: #000000;
        }
    </style>
</head>

<body>
    <div class="container text-center d-flex align-items-center justify-content-center vh-100">
        <div class="row py-5 rounded">
            <div class="col-12">
                <h1>Welcome To <span id="logo"><strong><i>Bi</i>shop</strong></span></h1>
            </div>
            <div class="col-12">
                <h4>Your Second Home</h4>
            </div>
            <div class="col-12 mt-2">
                <button class='btn' id="btnLogIn"><a href="http://localhost/server/marketplace/pages/Login.php" class="link-light" style="text-decoration: none;">Log In</a></button>
                <button class='btn' id="btnSignUp"><a href="http://localhost/server/marketplace/pages/register.php" class="link-light" style="text-decoration: none;">Sign Up</a></button>
            </div>
        </div>
    </div>
</body>

</html>