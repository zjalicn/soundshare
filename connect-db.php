<?php 
    //db connect  

    $hn = 'localhost';
    $db = 'soundshare_db'; //database
    $un = 'root'; //username
    $pw = ''; //password

    $mysqli = new mysqli($hn, $un, $pw, $db);
    if ($mysqli->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    } 
    //echo "Connected successfully";
?>