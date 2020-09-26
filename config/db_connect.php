<?php
    error_reporting(0);
    static $conn;
    function connectToDb($username, $password){
        global $conn;
        $conn =  new mysqli("localhost",$username, $password, "test");
        if($conn->connect_error){
            echo "<div style='color:white; background-color: #e2606b; font-weight: 400; border: solid 4px #ff1100'>$conn->connect_error</div>";
            $conn->close();
            return false;
        }
        else{
            return $conn;
        }
    }

    function getDb(){
        global $conn;
        if($conn == null) return false;
        else return $conn;
    }

