<?php require('header.php');?>

<main>
<div class="container">
    <div class="row dashboard ">
        <div class="col col-lg-7 dashboard-col">
        <img src="./images/waveform.png" style="width:90px; margin: auto"/>
        <div class="form-group" >
            
            <form method="post" enctype="multipart/form-data" style="width:60%; text-align:center; display: inline">
                <p>Select sound to upload and fill out the meta data:</p>

                <input type="file" name="uploadfile" id="fileToUpload"/> <br/>
                
                <label for="filename">File Name:</label>
                <input type="text" name="filename" placeholder="File name"/> <br/>

                <label for="filename">Type:</label>
                <select name="soundtype">
                    <option value="">Drum</option>
                    <option value="">Synth</option>
                    <option value="">Fx</option>
                    <option value="">Vocal</option>
                    <option value="">Loop</option>
                    <option value="">Bass</option>
                </select> <br/>

                <label for="filename">Genre:</label>
                <input type="text" name="genre" placeholder="Genre"/> <br/>

                <textarea rows="4" cols="50" name="tags" maxlength="30" placeholder="Tags: (max length 30 chars)"></textarea>
                <br/>

                <input type="submit" value="Upload Sound" name="submit"/>
            </form></div>
        </div>

        <div class="col col-lg-4 centered" style="text-align:center">
            <div class="row">
                <div class="col dashboard-col">
                    write in meta data fields here
                </div>
            </div>
            <div class="row">
                <div class="col dashboard-col">
                    confirm button here
                </div>
            </div>
        </div>
    </div>
</div>
</main>

<?php require('footer.php') ?>