<?php
session_start();
include_once('config/db_connect.php');
$username = $password = "";
if(isset($_POST["submit"])){
    $password = $_POST["password"];
    $username = $_POST["username"];
    $conn = connectToDb($username, $password);
    if($conn){
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('Location: home.php');
    }
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Bank of Asia | Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style type="text/css">
            .brand{
                background: #cbb09c !important;
            }
            form{
                max-width: 460px;
                margin: 20px auto;
                padding: 20px;
            }
            body{
                background: rgb(145,197,230);
                background: -moz-linear-gradient(90deg, rgba(145,197,230,1) 0%, rgba(255,238,180,1) 51%, rgba(200,195,232,1) 100%);
                background: -webkit-linear-gradient(90deg, rgba(145,197,230,1) 0%, rgba(255,238,180,1) 51%, rgba(200,195,232,1) 100%);
                background: linear-gradient(90deg, rgba(145,197,230,1) 0%, rgba(255,238,180,1) 51%, rgba(200,195,232,1) 100%);
                filter: progid:DXImageTransform.Microsoft.gradient(startColorstr="#91c5e6",endColorstr="#c8c3e8",GradientType=1);
            }
        </style>
</head>

<body>
<div class="container" style="padding: 100px 250px 100px 250px">
    <div class="card">
        <div class="card-body">
            <form action="index.php" method="POST" >
                <div style="text-align:center;">
                    <img src="assets/logo.jpg" alt="logo" style="width: 50%; border-radius: 50%"/>
                    <p class="lead"> Bank of Asia</p>
                </div>
                <div>
                    <label for="username">Username</label>
                    <input type="text" name="username" autocomplete="username" required />
                </div>
                <div>
                    <label for="password">Password</label>
                    <input type="password" name="password" autocomplete="current-password" required />
                </div>
                <div class="center">
                    <input type="submit" name="submit" value="submit" class="btn brand">
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>