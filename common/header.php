<?php
session_start();
include_once('config/db_connect.php');
$conn = connect();
if(!$conn) {
    echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>Session timed out!</div>";
    header('Location: index.php');
}
mysqli_close($conn);
?>

<head>
    <title>Bank of Asia</title>
    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <style type="text/css">
        .brand{
            background: #cbb09c !important;
        }
        .brand-text{
            color: #cbb09c !important;
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
<nav>
    <div class="nav-wrapper">
        <a href="http://localhost/sample_project/home.php" class="brand-logo" style="margin-left:1.5em; padding: 10px"><img src="assets/logo.jpg" style="height: 50%; width: 12%; border-radius: 100px"/></a>
        <ul id="nav-mobile" class="right hide-on-med-and-down">
            <li><a href="addBranch.php">Add Branch</a></li>
            <li><a href="config/logout.php">Logout</a></li>
        </ul>
    </div>
</nav>


