<?php require('header.php');?>

<main>
<div class="container">
    <div class="row dashboard ">
        <div class="col col-lg-7 dashboard-col">
            <table class="table table-hover table-striped" style="width:100%">
            <tr>
                <th>Name</th>
                <th>Genre</th> 
                <th>Type</th>
                <th>Uploader:</th>
                <th>Upload date:</th>
            </tr>
            <?php
                for ($i = 0; $i < 10; $i++){
                    echo '<tr>
                            <th>test'.$i.'</th>
                            <th>trap</th> 
                            <th>kick</th>
                            <th>n/a</th>
                            <th>n/a</th>
                         </tr>';
                }
            ?>
            </table>
            <p> we'll think of more meta data columns, lets make a little scrolly wheel thing too on the side. i was thinking of making
                the view consistently be the same size and have it take up most of the screen depending on the device
            </p>
        </div>
        <div class="col col-lg-4 centered" style="text-align:center">
            <div class="row">
                <div class="col dashboard-col">
                    <h5>Welcome <?php echo ucfirst($_SESSION['username']) ?>!</h5>
                    <p style="font-size:10px"><?php
                    date_default_timezone_set('EST');
                    echo date('h:i:s l F jS Y e');?></p>
                </div>
            </div>
            <div class="row">
                <div class="col dashboard-col">
                    <h5>Filter By Tag</h5>
                    <?php
                        for ($i=0; $i<10; $i++) 
                            echo '<input type="checkbox" style="display:inline; margin:5px" name="tag'.$i.'"/>
                                    <label for="tag'.$i.'">'.'Tag'.$i.'</label>';
                    ?>
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