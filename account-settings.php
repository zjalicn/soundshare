<?php require('header.php');?>

<main>
<div class="container">
    <div class="row dashboard text-centered">
        <div class="col col-lg-7 dashboard-col"> 
            <img src="./images/profile-stock.png" style="width:120px"/>
            <h1><b><?php echo ucfirst($_SESSION['username']); ?> </b></h1>
            <p><i>actual name here</i> </p>
            <p>JOINED:</p>
            <p>UPLOADS</p>
        </div>
        <div class="col col-lg-4 centered">
            <div class="row">
                <div class="col dashboard-col">
                    <p>Change Password</p>
                    <p>Your Email: <br>test@gmail.com</p>
                </div>
            </div>
        </div>
    </div>
</div>

<?php require('footer.php') ?>