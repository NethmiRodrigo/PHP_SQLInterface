<?php
error_reporting(0);
session_start();
function connectToDb($username, $password){
    $conn =  new mysqli("localhost",$username, $password, "bankofasia");
    if($conn->connect_error){
        echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->connect_error</div>";
        return false;
    }
    else return $conn;
}

function connect(){
    $username = $_SESSION['username'];
    if($username){
        $password = $_SESSION['password'];
        return connectToDb($username, $password);
    }
    else return false;
}


