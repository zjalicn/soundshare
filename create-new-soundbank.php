<?php require('header.php');
ini_set('display_errors', 1);
require ('connect-db.php');
?>

<main>
<style>
.row * {
    margin: 2px auto;
    text-align: center;
}
</style>
<div class="container">
    <div class="row dashboard">
        <div class="col col-lg-12 dashboard-col" style="margin: 0 auto;">
        <h5>Create New Soundbank</h5><br/>
            <img src="./images/waveform.png" style="width:90px; margin: 0 auto;"/>
            <div class="form-group" >
                <form method="post" enctype="multipart/form-data">
                
                    <label for="filename">Soundbank Name:</label>
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
                </form>
            </div>
        </div>
    </div>

    <div class="row dashboard">
        <div class="col col-lg-5 dashboard-col scrolltable" style="width:300px">
            <h5 class="centered">Browse Sounds</h5>
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
                        $sql = "SELECT name, type, genre, tags, timestamp, username from sounds"; 
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
        </div> <!-- browse sounds -->

        <div class="col col-lg-5 dashboard-col scrolltable" style="width:300px">
            <h5 class="centered">New Soundbank</h5>
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
                    <tr><td>gonna keep track of seperate array here which updates any time a sound over on the left is clicked</td></tr>
                    <?php /*
                        $sql = ""; 
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
                    */?> 
                </tbody>
            </table>
        </div> <!-- new bank -->
    </div>
</div>
</main>

<?php require('footer.php') ?>