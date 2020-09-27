<!DOCTYPE html>
<html>

<?php
    session_start();
    include_once("common/header.php");
    include_once("config/db_connect.php");
    $conn = connect();
    if(isset($_POST["submit"])){
        $name = $_POST["name"];
        $location = $_POST["location"];
        $building = $_POST["building"];

        $sql = "INSERT INTO branch VALUES('', '$location', '$name', '$building')";

        if(mysqli_query($conn, $sql)){
            echo "<div style='color:white; background-color: #78dcb7; font-weight: 400; border: solid 4px #27ca8d'>ENTRY ADDED!</div>";
        }else{
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->connect_error</div>";
        }
        mysqli_close($conn);
    }
?>

<section class="container">

    <h6 class="center">Add Branch</h6>

    <form class="white" action="addBranch.php" method="POST">

        <label>Name</label>
        <input type="text" name="name" required>

        <label>Location</label>
        <input type="text" name="location" required>

        <label>Building Area</label>
        <input type="text" name="building" required>

        <div class="center">
            <input type="submit" name="submit" value="submit" class="btn brand">
        </div>

    </form>

</section>

</html>
