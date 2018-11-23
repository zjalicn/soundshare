<?php require('header.php');?>

<?php
    require('connect-db.php'); 

    $name = 'name';
    $email = 'email';
    $timestamp = 'joined';
    $uploads = '0';
    //Retrieve Name, Email, and Timestamp from the user's account in the db
    $sql = 'SELECT name, email, timestamp  
            FROM accounts
            WHERE accounts.username = "'.$_SESSION["username"].'"';
    if ($result = mysqli_query($mysqli, $sql)){
        $row = mysqli_fetch_array($result);
        $name = implode(" ",array_map("ucfirst", explode(" ",$row['name'])));
        $email = $row['email'];
        $timestamp = $row['timestamp'];
    }
    //Get sounds seperately since they're in a different table
    $sql = 'SELECT *
            FROM sounds
            WHERE sounds.username = "'.$_SESSION["username"].'"';
    if ($result = mysqli_query($mysqli, $sql)){
        $uploads = mysqli_num_rows($result); //number of uploads by the user
    } 
?>

<main>
<div class="container">
    <div class="row dashboard text-centered">
        <div class="col col-lg-7 dashboard-col"> 
            <img src="./images/profile-stock.png" style="width:120px"/>
            <h1><p style='margin:0px;font-size:12px'>User:</p>
                <b><?php echo ucfirst($_SESSION['username']); ?> </b>
            </h1>
            <p>Name: <?php echo $name; ?></p>
            <p>Your Email: <br><?php echo $email ?></p>
            <p>Joined: <?php echo $timestamp; ?></p>
            <p>Uploads: <?php echo $uploads; ?></p>
        </div>
        <div class="col col-lg-4 centered">
            <div class="row">
                <div class="col dashboard-col">
                <button class="btn cancel open-button" onClick="openForm()" id="change-pass-btn">Change Password</button>
                    <div class="form-popup" id="changePassForm">
                        <form action="change-password.php" method="post" class="form-container">
                            <label for="email"><b>New Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw" required>

                            <label for="psw"><b>Repeat New Password</b></label>
                            <input type="password" placeholder="Enter Password" name="psw2" required>

                            <button type="confirm-new-pass" class="btn btn-primary">Confirm</button>
                            <button type="" class="btn cancel" onClick="closeForm()">Close</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row" id="users-sounds">
                <div class="col dashboard-col scrolltable" style="height:300px">
                    <h5>Your Sounds:</h5>
                    <table class="table table-hover table-striped"> 
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Genre</th> 
                            <th>Tags</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            $sql = "
                            SELECT name, type, genre, tags, timestamp, username 
                            FROM sounds
                            WHERE username = '".$_SESSION["username"]."'"; 
                            if ($result = mysqli_query($mysqli, $sql)){
                                while($row = mysqli_fetch_array($result)){
                                    echo "<tr>";
                                    echo "<td>" . $row['name'] . "</td>";
                                    echo "<td>" . $row['type'] . "</td>";
                                    echo "<td>" . $row['genre'] . "</td>";
                                    echo "<td>" . $row['tags'] . "</td>";
                                    echo "</tr>";
                                }
                            } else { echo "Database cannot be loaded at this current time";}
                        ?>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
</main>
<!-- CSS styling for the password change form -->
<style>
    {box-sizing: border-box;}

    .open-button {
    background-color: #555;
    color: white;
    padding: 16px 20px;
    opacity: 0.8;
    width: 280px;
    margin: 0 auto;
    }
    .form-popup {
    display: none;

    border: 3px solid #f1f1f1;
    z-index: 9;
    }

    /* Add styles to the form container */
    .form-container {
    max-width: 300px;
    padding: 10px;
    background-color: white;
    }

    /* Full-width input fields */
    .form-container input[type=text], .form-container input[type=password] {
    width: 100%;
    padding: 15px;
    margin: 5px 0 22px 0;
    border: none;
    background: #f1f1f1;
    }

    /* When the inputs get focus, do something */
    .form-container input[type=text]:focus, .form-container input[type=password]:focus {
    background-color: #ddd;
    outline: none;
    }

    /* Set a style for the submit/login button */
    .form-container .btn {
    background-color: #4CAF50;
    color: white;
    padding: 16px 20px;
    border: none;
    cursor: pointer;
    width: 100%;
    margin-bottom:10px;
    opacity: 0.8;
    }

    /* Add a red background color to the cancel button */
    .form-container .cancel {
    background-color: red;
    }

    /* Add some hover effects to buttons */
    .form-container .btn:hover, .open-button:hover {
    opacity: 1;
    }
</style>
<!-- JS code to make the button/form appear/dissapear as needed-->
<script>
    function openForm() {
        document.getElementById("changePassForm").style.display = "block";
        document.getElementById("change-pass-btn").style.display = "none";
        document.getElementById("users-sounds").style.display = "none";
    }

    function closeForm() {
        document.getElementById("changePassForm").style.display = "none";
        document.getElementById("change-pass-btn").style.display = "block";
        document.getElementById("users-sounds").style.display = "block";

    }
</script>

<?php require('footer.php') ?>

