<?php require('header.php');
ini_set('display_errors', 1);
require_once 'connect-db.php';   
?>

<main>
<div class="container">
    <div class="row dashboard ">
        <div class="col col-lg-7 dashboard-col scrolltable" style="overflow-y:scroll; position:relative;height: 500px;">
            <h5 class="centered">Browse Sounds</h5>
            <table class="table table-hover table-striped"> 
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Genre</th> 
                        <th>Tags</th> 
                        <th>Uploaded:</th>
                        <th>Uploader:</th>
                    </tr>
                </thead>
                <tbody id="sounds">
                    <?php
                    $sql = "SELECT name, type, genre, tags, timestamp, username FROM sounds ORDER BY timestamp"; 
                    if ($result = mysqli_query($mysqli, $sql)){
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>" . $row["genre"] . "</td>";
                            echo "<td>" . $row["tags"] . "</td>";
                            echo "<td>" . $row["timestamp"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "</tr>";
                        }
                    } else { echo "Database cannot be loaded at this current time";}
                    ?>
                </tbody>
                <tbody id="searchtags">
                </tbody>
            </table>
        </div>
        <div class="col col-lg-4 centered" style="text-align:center">
            <div class="row">
                <div class="col dashboard-col">
                    <h5>Welcome <?php echo ucfirst($_SESSION['username']) ?>!</h5>
                    <p style="font-size:10px"><?php
                    date_default_timezone_set('EST');
                    echo date('h:i:s l F jS Y e');?></p>

                    <form method="POST" action="search_results.php">
                        <input type="text" placeholder="Search for sounds" name="search_sounds">
                        <button type="search" name="search" class="btn-primary" style="display:inline">Search</Button>
                    </form>
                </div>
            </div>
            <div class="row">
                <div class="col dashboard-col">
                <h5>Filter By Tag</h5>
                    <div class="row tagsDiv" id="tagsDiv">
                        <?php 
                        include('fetch-tags.php'); 
                        fetch_tags(); 
                        ?>
                    </div>
                    <h5 id="selected" style="display:block">Selected:</h5>
                    <div class="row tagsDiv" id="selectedTagsDiv">
                        <script>
                            var printHTML = ""
                            var tagsArray = document.getElementById('tagsString').innerText.split(" ");
                            var selectedTags = [];
                            var stagid=0;
                            if (selectedTags.length > 0){
                                for (stagid=0; stagid < selectedTags.length; stagid++){
                                    if (selectedTags[stagid]){
                                        printHTML += '<span class="tagspan" id="stag'+stagid+'" onClick="removeTag(\''+stagid+'\')">⨯' + selectedTags[stagid] + '</span>';
                                    }
                                }
                            } else {
                                document.getElementById('selected').setAttribute('style', 'display:none');
                            }
                            document.write(printHTML);

                            function selectTag(tagid){ //select a tag to filter by and move it to the selected tags array
                                tag = document.getElementById("tag"+tagid)
                                tag.parentNode.removeChild(tag);
                                document.getElementById('selectedTagsDiv').innerHTML += '<span class="tagspan" id="stag'+selectedTags.length+'" onClick="removeTag(\''+selectedTags.length+'\')">'+tag.innerText+'</span>';
                                selectedTags.push(tagsArray[tagid]);
                                delete tagsArray[tagid];
                                document.getElementById('searchTags').innerText = selectedTags.join(" "); //updates search tags for mysql query
                                if (selectedTags.filter(Boolean).length > 0) 
                                    document.getElementById('selected').setAttribute("style", "display:block");
                                updateDatabase();
                                return false;
                            }

                            function removeTag(tagid){ //move a tag from selected tags to tagsArray
                                tag = document.getElementById("stag"+tagid)
                                tag.parentNode.removeChild(tag);
                                document.getElementById('tagsDiv').innerHTML += '<span class="tagspan" id="tag'+tagsArray.length+'" onClick="selectTag(\''+tagsArray.length+'\')">'+tag.innerText+'</span>';
                                tagsArray.push(selectedTags[tagid]);
                                delete selectedTags[tagid];
                                document.getElementById('searchTags').innerText = selectedTags.join(" "); //updates search tags for mysql query
                                if (selectedTags.filter(Boolean).length == 0){ //if the number of elements excluding empties is zero
                                    document.getElementById('selected').setAttribute('style', 'display:none');
                                }
                                updateDatabase();
                                return false;
                            }        

                            function updateDatabase(){
                                if (selectedTags.filter(Boolean).length != 0){ // if there is atleast one tag
                                    for (var i=0; i < document.getElementById('sounds').rows.length; i++){
                                        document.getElementById('sounds').rows[i].setAttribute('style','display:none');
                                        for (var tag in selectedTags){ //basically just check if any of the user's tags are in the sound's tags
                                            if (document.getElementById('sounds').rows[i].cells[3].innerText.split(" ").includes(selectedTags[tag])){
                                                document.getElementById('sounds').rows[i].setAttribute('style','display:""');
                                            }
                                        }
                                    }
                                } else {
                                    for (var i=0; i < document.getElementById('sounds').rows.length; i++){
                                        document.getElementById('sounds').rows[i].setAttribute('style','display:""');
                                    }
                                }
                            }             
                        </script>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col dashboard-col">
                    <p><a href="upload.php">Upload</a></p>
                    <p><a href="create-new-soundbank.php">Create New Soundbank</a></p>
                    <p><a href="collaborate.php">Collaborate</a></p>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<?php require('footer.php') ?>