<?php require('header.php');?>

<style>
form * {
    display:table-cell;
}
</style>

<?php
     function upload(){
        require("connect-db.php");
        $id = mysqli_num_rows(mysqli_query($mysqli, "SELECT * FROM sounds"));
        $file = $_FILES['uploadfile']['name'];
        $filename = $_POST['filename'];
        $type = $_POST['type'];
        $genre = $_POST['genre'];
        $username = $_SESSION['username'];
        $tags = str_replace(","," ",$_POST['tags']); //removes all commas and replaces it with spaces
        $banks = str_replace(","," ",$_POST['banks']); //removes all commas and replaces it with spaces
        // File upload path
        $fileName = basename($_FILES['uploadfile']['name']);
        $targetFilePath = './sounds/' . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
  
        if(in_array($fileType,array('mp3','wav'))){// Upload file to server
            if(move_uploaded_file($_FILES["uploadfile"]["tmp_name"], $targetFilePath)){
                // Insert
                $sql = "
                INSERT INTO sounds(id, name, type, genre, tags, timestamp, username, file) 
                VALUES ('".++$id."', '$filename', '$type', '$genre', '$tags', CURRENT_TIMESTAMP, '$username', '$file')";
                //echo $sql;
                if(mysqli_query($mysqli, $sql)){
                    $statusMsg = "The file ".$fileName. " has been uploaded successfully.";
                }else{
                    $statusMsg = "File upload failed, please try again.";
                } 
            }else{
                $statusMsg = "Sorry, there was an error uploading your file.";
            }
        }else{
            $statusMsg = 'Please make sure you have uploaded an MP3 or WAV file.';
        }
        echo $statusMsg;
    }

    include('fetch-tags.php');

    if (isset($_POST['upload'])){
        upload();
    }

?>

<main>
<div class="container">
    <div class="row dashboard" >
        <div class="col col-lg-7 dashboard-col">
        <img src="./images/waveform.png" style="width:90px; margin: 0 auto;"/>
        <div class="form-group" > <!--  UPLOAD SOUND-->
            <form method="post" style="width:60%; display: inline" enctype="multipart/form-data">
                <p>Select sound to upload and fill out the meta data:
                <span style="font-size:10px">(Max 16mb, .mp3 and .wav only)</span></p>

                <input type="file" name="uploadfile" required/> <br/> <!--req -->
                
                <label for="filename">File Name:</label>
                <input type="text" name="filename" placeholder="File name" required/> <br/> <!--req -->

                <label for="filename">Type:</label>
                <select name="type">
                    <option value="Drum">Drum</option>
                    <option value="Synth">Synth</option>
                    <option value="Fx">Fx</option>
                    <option value="Vocal">Vocal</option>
                    <option value="Loop">Loop</option>
                    <option value="Bass">Bass</option>
                </select> <br/>

                <label for="filename">Genre:</label>
                <input type="text" name="genre" placeholder="Genre" required/> <br/> <!--req -->

                <label for="tags">Tags:</label>
                <input type="text" name="tags" maxlength="30" placeholder="(max 30 chars)" id='tags-input'/>
                <br/>

                <label for="banks">Soundbanks:</label>
                <input type="text" name="banks" maxlength="100" placeholder="ID only (max 100 chars)" id="banksInput"/>
                <br/>

                <button type="upload" name="upload" class="btn-sml btn-primary">Upload</button>
                <p style="display:none" name="">error</p>
            </form></div>
        </div>

        <div class="col col-lg-4 centered" style="text-align:center"> 
            <div class="row"> <!-- SOUNDBANKS -->
                <div class="col dashboard-col">
                    <h5>Soundbanks:</h5>
                    <div class="row tagsDiv" id="banksDiv" style="overflow-y:scroll; position:relative;height: 250px;">
                        <table class="table table-hover table-striped"> 
                            <thead>
                                <tr>
                                    <th>Soundbank</th>
                                    <th>ID</th>
                                    <th>Genre</th> 
                                </tr>
                            </thead>
                            <tbody id="banks">
                                <?php
                                    require('connect-db.php');
                                    $sql = "
                                    SELECT name, id, genre, tags, timestamp, users
                                    FROM soundbanks
                                    ORDER BY timestamp"; 
                                    if ($result = mysqli_query($mysqli, $sql)){
                                        while($row = mysqli_fetch_array($result)){
                                            //Only show banks this user has access to
                                            if (in_array($_SESSION['username'], explode(" ", $row['users']))){
                                                echo "<tr id='" . $row["id"] . "' onClick='addBank(". $row["id"] .")'>";
                                                echo "<td>" . $row["name"] . "</td>";
                                                echo "<td>" . $row["id"] . "</td>";
                                                echo "<td>" . $row["genre"] . "</td>";
                                                echo "</tr>";
                                            }
                                        }
                                    } else { echo "Database cannot be loaded at this current time";}
                                ?>
                                <script>
                                    function addBank(bankid){
                                        if (!document.getElementById('banksInput').value.split(" ").includes(bankid+"")){
                                            bank = document.getElementById(bankid);
                                            document.getElementById('banksInput').value += " " + bankid;
                                        }
                                    }
                                </script>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

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
        </div>
        
        
    </div>
</div>
</main>

<?php require('footer.php') ?>