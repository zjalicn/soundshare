<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="./images/favicon.ico">

    <title>SoundShare</title>

    <link href="./css/styles.css" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="./css/bootstrap.min.css" rel="stylesheet">

    <?php session_start(); ?>
</head>
<body>
<header>
    <?php 
    require("navbar.php");

    //echo $_SERVER["SCRIPT_NAME"];
    if ($_SESSION['username']=="" && //ill clean this up a bit its just while im working on localhost & myweb, urls are slightly different
    !(in_array($_SERVER["SCRIPT_NAME"], array('/soundshare/index.php','/index.php','/soundshare/signup.php','/signup.php')))){
        header("Location: index.php");
    } 
    ?>
</header>



