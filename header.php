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
    <link href="./css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <link href="jumbotron.css" rel="stylesheet">
    <script src="./js/ie-emulation-modes-warning.js"></script>

    <?php session_start(); ?>
</head>
<body>
<header>
    <?php require("navbar.php"); ?>
    <?php

    if ($_SESSION['username']=="" && 
    !(in_array($_SERVER["SCRIPT_NAME"], array('/soundshare/index.php','/soundshare/signup.php')))){
        header("Location: index.php");
    }
    ?>
</header>



