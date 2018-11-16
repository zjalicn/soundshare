<?php
  include 'php-pre55-password-hash-utils.php';
  function authenticate(){ //auth via db
    $username = $_POST['username'];
    $password = $_POST['password'];
    require("connect-db.php");

    $sql = "SELECT password FROM accounts WHERE accounts.username = '$username' LIMIT 1;";
    $result = mysqli_query($mysqli, $sql);
    $resultCheck = mysqli_num_rows($result);
    /*if ($resultCheck > 0){
      while ($row = mysqli_fetch_assoc($result)){
        echo $row['username'];
      }
    }*/
    $sql = "SELECT 1 FROM accounts WHERE accounts.username = '$username' LIMIT 1;";

    if ((mysqli_query($mysqli, $sql)) ){
      //if (password_verify($password, $password)){ //change second to dbpassword && mysqli_num_rows(mysqli_query($mysqli, $sql)) != 0)
      return true;
      //}
    }
    return false; 
    echo '<script type="text/javascript">document.getElementById("login_error").style.display = "block";</script>';
  }

  if (isset($_POST['submit'])){ //on form submit, authenticate, call login if true , $_POST['password']
    if (authenticate()){
      $_SESSION['username'] = $_POST['username'];
      header("Location: logged-in.php"); 
    }
  }
  if (isset($_POST['logout'])){ //on form submit, authenticate, call login if true
    $_SESSION['username'] = "";
    header("Location: index.php"); 
  }
?>

<nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <img src="images/logo.png" style="height:20%; width:20%">
          <?php 
            if ($_SESSION['username']==""){ //not logged in 
              echo '<a class="navbar-brand" href="index.php">SoundShare</a>';
            } else { echo '<a class="navbar-brand" href="logged-in.php">SoundShare</a>'; }
          ?>
        </div>
        <div id="navbar" class="navbar-nav">
          <?php 
            if ($_SESSION['username']==""){ //not logged in
              $navbar = <<<EOD
                        <!--LOGIN FORM-->
                        <form method="post" class="navbar-right" action="">
                          <input type="text" name="username" placeholder="Username" required>
                          <input type="password" name="password" placeholder="Password" required>
                          <button type="submit" name="submit" class="btn-sml btn-primary">Sign in</button>
                        </form>
EOD;
//<p id="login_error" >ERROR: INCORRECT USERNAME OR PASSWORD</p>
            } else { //logged in
              $navbar = '
                        <form method="post" class="navbar-right">
                          <p style="display:inline"><a href="account-settings.php">Account Settings</a> | </p>
                          <button type="logout" name="logout" class="btn-sml btn-primary">Log Out</button>
                        </form>';
            }
            echo $navbar;
            
          ?>
        </div><!--/.navbar-collapse -->
            <div >
        </div>
      </div>

    </nav>
<?php    
/*Redirect to index if not logged in REMEBER TO SET THIS SO IT ONLY CHECKS If YOU USE THE LGO IN BUTTON NOT SIGN UP
if($_SESSION['username']==''){ //if login in session is not set
    header("Location: index.php");
} */
?>