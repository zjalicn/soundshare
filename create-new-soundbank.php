<?php require('header.php');?>
<?php
    include('fetch-tags.php');
    require("connect-db.php");

    if (isset($_POST['upload'])){ //creates the new bank
        $id = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM soundbanks"));
        $name = $_POST['name'];
        $genre = $_POST['genre'];
        $tags = str_replace(","," ",$_POST['tags']); //removes all commas and replaces it with spaces
        $collabs = $_SESSION['username'] . " " . str_replace(","," ",$_POST['collabInput']); //removes all commas and replaces it with spaces
       
        $sql = "
        INSERT INTO soundbanks(name, id, genre, tags, users) 
        VALUES ('$name', '".++$id."', '$genre', '$tags', '$collabs')";
        if(mysqli_query($mysqli, $sql)){
            $statusMsg = "Created successfully.";
        }else{
            $statusMsg = "File upload failed, please try again.";
        } 
        echo $statusMsg;    
    }
    
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
?>

<main>
<div class="container">
    <div class="row dashboard" >
        <div class="col col-lg-7 dashboard-col">
        <h5>Create New Soundbank</h5>
        <div class="form-group" >
            <form method="post" style="width:60%; display: inline" enctype="multipart/form-data">
                <p>Fill out the following meta data:</p> <br/>          
                <label for="filename">Name:</label>
                <input type="text" name="name" placeholder="Name" required/> <br/> <!--req -->

                <label for="filename">Genre:</label>
                <input type="text" name="genre" placeholder="Genre"/> <br/> <!--req -->

                <label for="tags">Tags:</label>
                <input type="text" name="tags" maxlength="30" placeholder="(max 30 chars)" id='tags-input'/>
                <br/>

                <label for="collabs">Collaborators:</label>
                <input type="text" name="collabInput" maxlength="100" placeholder="Add friends' user ID" id="collabInput"/>
                <br/>

                <button type="upload" name="upload" class="btn-sml btn-primary">Upload</button>
                <p style="display:none" name="">error</p>
            </form></div>
        </div>

        <div class="col col-lg-4 centered" style="text-align:center"> 
            <div class="row"> <!-- TAGS -->
                <div class="col dashboard-col">
                    <h5>Tags:</h5>
                    <div class="row tagsDiv" id="tagsDiv">    
                        <?php 
                            fetch_tags(); 
                        ?>
                        <script>
                            var printHTML = ""
                            var tagsArray = document.getElementById('tagsString').innerText.split(" ");
                            var selectedTags = [];

                            function selectTag(tagid){ //select a tag to filter by and add it to the tags
                                tag = document.getElementById("tag"+tagid);
                                document.getElementById('tags-input').value += " " + tag.innerText.substring(1);
                                tag.parentNode.removeChild(tag);
                                delete tagsArray[tagid];
                            }
                        </script>

                    </div>
                </div>
            </div>

            <div class="row"> <!-- SOUNDBANKS -->
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
                                        while($row = mysqli_fetch_array($result)){
                                            if ($row['status']==3){
                                                if ($row['user1'] == $_SESSION['username']){ 
                                                    echo "<tr onClick=\"addCollab('".$row['user2']."')\">";
                                                    echo "<td>".$row["user2"]."</td>"; 
                                                } else { 
                                                    echo "<tr onClick=\"addCollab('".$row['user1']."')\">";
                                                    echo "<td>".$row["user1"]."</td>"; 
                                                }
                                            } else {
                                                if ($row['user1'] == $_SESSION['username']){ 
                                                    echo "<tr>";
                                                    echo "<td>".$row["user2"]."</td>"; 
                                                } else { 
                                                    echo "<tr>";
                                                    echo "<td>".$row["user1"]."</td>"; 
                                                }
                                            }
                                            if ($row['status']==1){
                                                echo "<td>Request Sent</td>"; 
                                            } elseif ($row['status']==2) {
                                                echo "<td>
                                                        <form method='post'>
                                                        <button type='accept-friend-".$row['id']."' name='accept-friend-".$row['id']."' class='btn-sml btn-primary'>Accept</button>
                                                        </form>
                                                        </td>"; 
                                            } else {
                                                echo "<td>Friends</td>"; 
                                            }
                                            echo "</tr>";
                                        }
                                    } else { echo "Database cannot be loaded at this current time";}
                                ?>
                                <script>
                                    function addCollab(friendid){
                                        if (!document.getElementById('collabInput').value.split(" ").includes(friendid)){
                                            friend = document.getElementById(friendid);
                                            document.getElementById('collabInput').value += " " +friendid;
                                        }
                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
</div>
</main>

<?php require('footer.php') ?>