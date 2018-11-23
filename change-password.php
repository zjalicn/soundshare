<?php
    session_start();
    require('connect-db.php');


    $pw = $_POST['psw'];
    $pwrepeat = $_POST['psw2'];
    if ($pw != $pwrepeat){
        echo "The passwords you entered did not match <br/>";
    } else {
        $sql = 'UPDATE accounts SET accounts.password = "'.$pw.'" WHERE accounts.username = "'.$_SESSION["username"].'"';
        if ($result = mysqli_query($mysqli, $sql)){
            echo "Password successfully changed. <br/>";
        } else {
            echo "Error in changing password <br/>";
        }
    }
    echo "You will be redirected to the main page shortly alternatively click <a href='logged-in.php'>here</a>"; 
?>

<script>
    setTimeout("location.href = 'logged-in.php';", 3000);
</script>