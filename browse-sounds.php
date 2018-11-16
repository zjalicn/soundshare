<!DOCTYPE html>
<html>
<head>
  <?php 
    require('header.php');
    if(!isset($_SESSION['username'])){ //if login in session is not set
        header("Location: index.php");
    }
  ?>
</head>
<body>
<?php require("navbar.php"); ?>

<div class="container">
    <div class="row dashboard ">
        <div class="col col-lg-7 dashboard-col">
            <p>db goes here</p>
        </div>
        <div class="col col-lg-4 centered">
            <div class="row">
                <div class="col dashboard-col">
                    <p>Welcome USERID HERE</p>
                    <p><a href="account-settings.php">Account Settings</a></p>
                </div>
            </div>
            <div class="row">
                <div class="col dashboard-col">
                    <p>Filter By Tag</p>
                </div>
            </div>
            <div class="row">
                <div class="col dashboard-col">
                    <p>User Settings</p>
                    <p><a href="#">Upload your sounds</a></p>
                    <p><a href="#">Create New Soundbank</a></p>
                    <p><a href="#">Collaborate</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php') ?>