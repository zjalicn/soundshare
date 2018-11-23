<?php require('header.php');
ini_set('display_errors', 1);
require_once 'connect-db.php';   
?>

<main>
<div class="container" >
    <div class="row dashboard " >
        <!-- SOUND BANKS -->
        <div class="col col-lg-5 dashboard-col scrolltable" style="margin: 10px auto;overflow-y:scroll; position:relative;height: 500px;">
            <h5 class="centered">Browse Soundbanks</h5>
            <table class="table table-hover table-striped"> 
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Tags</th> 
                    </tr>
                </thead>
                <tbody id="soundbanks">
                    <?php
                    $sql = "SELECT * FROM soundbanks ORDER BY timestamp"; 
                    if ($result = mysqli_query($mysqli, $sql)){
                        while($row = mysqli_fetch_array($result)){
                            if (in_array($_SESSION['username'], explode(" ", $row['users']))){ //only shows ones in which the user has permission
                                echo "<tr id='bank".$row['id']."' onClick='selectBank(bank".$row['id'].")'>";
                                echo "<td>" . implode(" ", array_map('ucfirst', explode(" ",$row["name"]))) . "</td>"; //make all first letters uppercase
                                echo "<td>" . $row["genre"] . "</td>";
                                echo "<td>" . $row["tags"] . "</td>";
                                echo "</tr>";
                            }
                        }
                    } else { echo "Database cannot be loaded at this current time";}
                    ?>
                    <script>
                        function selectBank(bankid){ 
                            /* Takes in Bank ID, sets all banks' font color to black, 
                            sets selected bank's font to red, sound from bank update in the next db over*/
                            var rows = document.getElementById('soundbanks').getElementsByTagName('TR');
                            for (var i=0; i < rows.length ; i++){
                                rows[i].setAttribute('style', 'color:black');
                            }
                            document.getElementById('bankname').innerText = 'Bank: ' + bankid.childNodes[0].innerText;
                            bankid.setAttribute('style', 'color:red');
                            sounds = document.getElementById('sounds').getElementsByTagName('TR');
                            for (var i=0; i < sounds.length ; i++){
                                sounds[i].setAttribute('style', 'display:none');
                                if (sounds[i].childNodes[4].innerText.split(" ").includes(bankid.getAttribute('id').substring(4))){
                                    sounds[i].setAttribute('style', 'display:""');
                                }
                            }
                        }
                    </script>
                </tbody>
            </table>
        </div>
        <!-- SOUNDS IN BANK -->
        <div class="col col-lg-5 dashboard-col scrolltable" style="margin:auto;overflow-y:scroll; position:relative;height: 500px;">
            <h5 class="centered" id="bankname">Bank: </h5>
            <table class="table table-hover table-striped"> 
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Type</th>
                        <th>Genre</th> 
                        <th>Uploader</th> 
                    </tr>
                </thead>
                <tbody id="sounds">
                    <?php
                    $sql = "SELECT * FROM sounds ORDER BY timestamp"; 
                    if ($result = mysqli_query($mysqli, $sql)){
                        while($row = mysqli_fetch_array($result)){
                            echo "<tr style='display:none'>";
                            echo "<td>" . $row["name"] . "</td>";
                            echo "<td>" . $row["type"] . "</td>";
                            echo "<td>" . $row["genre"] . "</td>";
                            echo "<td>" . $row["username"] . "</td>";
                            echo "<td style='display:none'>" . $row["banks"] . "</td>";
                            echo "</tr>";
                        }
                    } else { echo "Database cannot be loaded at this current time";}
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</main>

<?php require('footer.php') ?>