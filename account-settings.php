<?php require('header.php');?>

<?php
    require('connect-db.php');

    $name = 'name';
    $email = 'email';
    $timestamp = 'joined';
    $uploads = '0';

    $sql = 'SELECT name, email, timestamp 
            FROM accounts
            WHERE accounts.username = "'.$_SESSION["username"].'"';
    if ($result = mysqli_query($mysqli, $sql)){
        $row = mysqli_fetch_array($result);
        $name = implode(" ",array_map("ucfirst", explode(" ",$row['name'])));
        $email = $row['email'];
        $timestamp = $row['timestamp'];
    }

    $sql = 'SELECT *
            FROM sounds
            WHERE sounds.username = "'.$_SESSION["username"].'"';
    if ($result = mysqli_query($mysqli, $sql)){
        $uploads = mysqli_num_rows($result);
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
                    <p>Change Password</p>
                    <p>(or maybe make this a js pop up)</p>
                    <form method="post" class="form-group">
                        <input type="text" placeholder="Enter new password"/><br/>
                        <input type="text" placeholder="Repeat new password"/><br/>
                        <button type="changepass">Confirm</button>
                    </form>
                </div>
            </div>
            <div class="row">
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

<?php require('footer.php') ?>