<?
function authenticate(){ //auth via db
    $username = $_POST['username'];
    $password = $_POST['password'];
    require("connect-db.php");



    $sql = "SELECT password FROM accounts WHERE accounts.username = '$username' LIMIT 1;";
    $result = mysqli_query($mysqli, $sql);
    $resultCheck = mysqli_num_rows($result);
    if ($resultCheck > 0){
      while ($row = mysqli_fetch_assoc($result)){
        echo $row['username'] . '<br/>';
      }
    }

    $sql = "SELECT 1 FROM accounts WHERE accounts.username = '$username' LIMIT 1;";

    if ((mysqli_query($mysqli, $sql)) ){
      return true;
   
    }


    echo '<script type="text/javascript">document.getElementById("login_error").style.display = "block";</script>';
    return false; 
  } 
  ?>