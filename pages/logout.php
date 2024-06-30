<?php
session_start();

unset($_SESSION["user_type"]);

header("Location: http://localhost/server/marketplace/pages/welcome.php");
exit();
