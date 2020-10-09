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
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300&display=swap" rel="stylesheet"/>
    <style>
        body {
            background: #0F2027;  /* fallback for old browsers */
            background: -webkit-linear-gradient(to right, #2C5364, #203A43, #0F2027);  /* Chrome 10-25, Safari 5.1-6 */
            background: linear-gradient(to right, #2C5364, #203A43, #0F2027); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
            font-family: 'Poppins', sans-serif;
        }
        button:hover{
            background-color: #36667c !important;
        }
        button{
            width: 100%;
            background-color: #2193b0 !important;
            color: white !important;
        }
    </style>
</head>

<body>
<div class="container" style="padding: 100px 250px 100px 250px">
    <div class="row">
        <div class="col align-self-center col-md-8 offset-md-2">
            <div class="card" style="border: none;">
                <div class="card-header text-center" style="background-color: #2193b0">
                    <div style="margin-top: 100px; margin-bottom: 100px">
                        <i class="fas fa-university" style="color: white; font-size: 10rem;"></i><br/>
                        <span class="lead" style="color: white;">Bank of Asia</span>
                    </div>
                </div>
                <div class="card-body">
                    <form class="needs-validation" novalidate action="index.php" method="POST">
                        <div class="form-group">
                            <label for="username">Username</label>
                            <input type="text" name="username" autocomplete="username" required class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" autocomplete="current-password" required class="form-control"/>
                        </div>
                        <div class="text-center" style="width: 100%">
                            <button type="submit" name="submit" value="submit" class="btn" >Submit </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function() {
  'use strict';
  window.addEventListener('load', function() {
    // Fetch all the forms we want to apply custom Bootstrap validation styles to
    var forms = document.getElementsByClassName('needs-validation');
    // Loop over them and prevent submission
    var validation = Array.prototype.filter.call(forms, function(form) {
      form.addEventListener('submit', function(event) {
        if (form.checkValidity() === false) {
          event.preventDefault();
          event.stopPropagation();
        }
        form.classList.add('was-validated');
      }, false);
    });
  }, false);
})();
</script>

</body>

</html>