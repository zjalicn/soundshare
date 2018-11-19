<?php require('header.php');?>

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
        
        // File upload path
        $fileName = basename($_FILES['uploadfile']['name']);
        $targetFilePath = './sounds/' . $fileName;
        $fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
       
        
        //if we have time make it check so that files being saved to the server dont share names
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
                $statusMsg = "Sorry, there was an error uploading your file."; //File upload failed, please try again.
            }
        }else{
            $statusMsg = 'Sorry, only MP3 and WAV files are allowed to upload.';
        }
        echo $statusMsg;
        /*
        if (mysqli_query($mysqli, $sql){
            echo 'ay';
        } else{
            echo 'nope';
        }*/
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
        <div class="form-group" >
            <form method="post" style="width:60%; display: inline" enctype="multipart/form-data">
                <p>Select sound to upload and fill out the meta data:
                <span style="font-size:10px">(Max 16mb, .mp3 and .wav only)</span></p>

                <input type="file" name="uploadfile"/> <br/> <!--req -->
                
                <label for="filename">File Name:</label>
                <input type="text" name="filename" placeholder="File name" /> <br/> <!--req -->

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
                <input type="text" name="genre" placeholder="Genre"/> <br/> <!--req -->

                <label for="tags">Tags:</label>
                <input type="text" name="tags" maxlength="30" placeholder="(max length 30 chars)"></textarea>
                <br/>

                <button type="upload" name="upload" class="btn-sml btn-primary">Upload</button>
            </form></div>
        </div>

        <div class="col col-lg-4 centered" style="text-align:center">
            <div class="row">
                <div class="col dashboard-col">
                    <h5>Tags:</h5>
                   <div class="row tagsDiv" id="tagsDiv">
                        <?php 
                        fetch_tags(); 
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<?php require('footer.php') ?>