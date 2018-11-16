<?php 
    session_start();
    include("login-check.php");   

    if ($_SESSION['username']){ ?>
        <div id="nav">
            <ul >
                    PUT LOG IN HERE
                <li class="navbar-right"><a href="inlog.php">My Account</a></li>
            </ul>
        </div>

    <?php } else { ?>
        <div id="nav">
            <ul >
                PUT ACCOUNT SETTINGS HERE
                <li class="navbar-right"><a href="inlog.php">Login / Sign Up</a></li>
            </ul>
        </div> 
    <?php } ?>