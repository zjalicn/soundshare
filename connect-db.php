<?php 
    //db connect
    $username = "root";
    $password = "";
    $db = "soundshare_db";

    $mysqli = new mysqli('localhost', $username, $password, $db);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //echo "Connected successfully";
?>