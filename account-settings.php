<!DOCTYPE html>
<html>
<head>
  <?php 
    require('header.php');
    if(!isset($_SESSION['login'])){ //if login in session is not set
        header("Location: index.php");
    }
  ?>
</head>
<body>
<?php require("navbar.php"); ?>

<div class="container">
    <div class="row dashboard text-centered">
        <div class="col col-lg-7 dashboard-col"> 
            <p>profile pic</p>
            <p>USERID: </p>
            <p>NAME: </p>
            <p>LNAME: </p>
            <p>JOINED:</p>
            <p>UPLOADS</p>
            <p>ABOUT ME: </p>
        </div>
        <div class="col col-lg-4 centered">
            <div class="row">
                <div class="col dashboard-col">
                    <p>Change Password</p>
                    <p>Your Email: <br>test@gmail.com</p>
                </div>
            </div>
            <div class="row">
                <div class="col dashboard-col">
                    <p>Your Uploads</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php') ?>