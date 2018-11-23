<?php require('header.php');?>

<?php
    require('connect-db.php');

    //Find all friends
    $sql = "
        SELECT *
        FROM relationships
        WHERE user1 = '".$_SESSION['username']."' OR user2 = '".$_SESSION['username']."';";
    
    for ($i = 1; $i <= mysqli_num_rows(mysqli_query($mysqli, $sql)); $i++){
        if (isset($_POST['accept-friend-'.(string)$i])){ //sets up checks for all users' friends and requests
            $sql2 = "
                UPDATE relationships
                SET status = 3
                WHERE relationships.id=".$i."";
                if(mysqli_query($mysqli, $sql2)){
                    $statusMsg = "Friend Accepted.";
                }else{
                    $statusMsg = "Could not accept request at this time, please try again later.";
                } 
                echo $statusMsg;  
        }
    }

    if (isset($_POST['addFriend'])){ //Send a friend request
        $friendName = $_POST['addFriendName'];
        $id = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM relationships")) + 1;
        //if () conditional if friend is in accounts table, make sure the account exists
        $sql = "SELECT username FROM accounts WHERE accounts.username = '".$_POST['addFriendName']."' LIMIT 1;";
        if ($result = mysqli_query($mysqli, $sql)){
            $resultCheck = mysqli_num_rows($result);
            if ($resultCheck > 0){
                $sql = "INSERT INTO relationships VALUES (".$id.",'".$_SESSION['username']."','".$friendName."', 1)";
                if ($result = mysqli_query($mysqli, $sql)){
                    echo "User added!";
                } else {
                    echo "User couldn't be added";
                }
            }
        } else {
            echo "User does not exist.";
        } 
        echo $sql;
    }

?>

<main>
<div class="container">
    <div class="row dashboard ">
        <div class="col col-lg-7 dashboard-col">
            <div class="row">
                <div class="col dashboard-col">
                    <h5>Click Friends to add to Collaborators:</h5>
                    <div class="row tagsDiv" id="banksDiv" style="overflow-y:scroll; position:relative;height: 250px;">
                        <table class="table table-hover table-striped"> 
                            <thead>
                                <tr>
                                    <th>Username</th>
                                    <th>Status</th> 
                                </tr>
                            </thead>
                            <tbody id="friends">
                                <?php
                                    require('connect-db.php');
                                    $sql = "
                                    SELECT *
                                    FROM relationships
                                    WHERE user1 = '".$_SESSION['username']."' OR user2 = '".$_SESSION['username']."';";
                                    if ($result = mysqli_query($mysqli, $sql)){
                                        $e = 0;
                                        while($row = mysqli_fetch_array($result)){ //make this cleaner using switch cases and check user first not status
                                            echo "<tr>";
                                            if ($row['user1'] == $_SESSION['username']){ 
                                                echo "<td>".$row["user2"]."</td>"; 
                                                switch($row['status']){
                                                    case 1:
                                                        echo "<td>Request Sent</td>"; 
                                                        break;
                                                    case 2:
                                                        echo "<td>
                                                            <form method='post'>
                                                            <button type='accept-friend-".$row['id']."' name='accept-friend-".$row['id']."' class='btn-sml btn-primary'>Accept</button>
                                                            </form>
                                                            </td>"; 
                                                        break;
                                                    case 3:
                                                        echo "<td>Friends</td>"; 
                                                        break;
                                                }
                                            } else { //current user logged in is second user in the relationship table
                                                echo "<td>".$row["user1"]."</td>"; 
                                                switch($row['status']){
                                                    case 1:
                                                        echo "<td>
                                                            <form method='post'>
                                                            <button type='accept-friend-".$row['id']."' name='accept-friend-".$row['id']."' class='btn-sml btn-primary'>Accept</button>
                                                            </form>
                                                            </td>"; 
                                                        break;
                                                    case 2:
                                                        echo "<td>Request Sent</td>"; 
                                                        break;
                                                    case 3:
                                                        echo "<td>Friends</td>"; 
                                                        break;
                                                }
                                            }
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
        <div class="col col-lg-4 centered" style="text-align:center">
            <div class="row">
                <div class="col dashboard-col">
                    <form method="post" action=''>
                        <h5>Add more friends!</h5>
                        <input type="text" name="addFriendName" placeholder="Enter Friend's Username"/>
                        <button class="btn-primary" type="addFriend" name="addFriend">Send Request</Button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col dashboard-col">
                    <p> maybe something else random here or a way to sort by who is online, pending, accepted, etc</p>
                    <p> also prevent duplicate friend relationships </p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<?php require('footer.php') ?>