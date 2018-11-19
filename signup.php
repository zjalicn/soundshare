<?php require('header.php');?>
  
<main>
<div class="wrapper-main" style="width: 70%; margin: 0 auto">

<form method="post" name="sign-up" style="border:1px solid #ccc">
  <div class="container form">
    <h1>Sign Up</h1><br/>
    <p>Please fill in this form to create an account.</p><br/>

    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="su-username" required>
    <label for="your name"><b>Name</b></label>
    <input type="text" placeholder="Enter your name" name="su-name" required>
    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="su-email" required>
    <label for="password"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="su-password" required>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <a href="index.php"><button type="button" class="cancelbtn">Cancel</button></a>
      <button type="signup" name="signup" class="signupbtn">Sign Up</button>
    </div>
    
  </div>
</form>

</div>
</main>


<?php
if (isset($_POST['signup'])){

  require('connect-db.php');
  $username = $_POST['su-username'];
  $password = $_POST['su-password'];
  $name = $_POST['su-name'];
  $email = $_POST['su-email'];

  $sql = "INSERT INTO accounts(username, password, name, email, timestamp) VALUES('$username','$password','$name','$email',CURRENT_TIMESTAMP)";
  
  if ((mysqli_query($mysqli, $sql)) ){
    header('Location: index.php');
    return true;
  } else {echo 'nope' . '<br/>'. "INSERT INTO accounts(username, password, name, email) VALUES('$username','$password','$name','$email')";}
  //echo '<script type="text/javascript">document.getElementById("login_error").style.display = "block";</script>';
}
?>

<style>
* {box-sizing: border-box}

/* Full-width input fields */
.form input[type=text], .form input[type=password] {
  width: 100%;
  padding: 15px;
  margin: 5px 0 22px 0;
  display: inline-block;
  border: none;
  background: #f1f1f1;
}
.form input[type=text]:focus, .form input[type=password]:focus {
  background-color: #ddd;
  outline: none;
}
.form hr {
  border: 1px solid #f1f1f1;
  margin-bottom: 25px;
}
/* Set a style for all buttons */
.form button {
  background-color: #4CAF50;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 100%;
  opacity: 0.9;
}
.form button:hover {
  opacity:1;
}
.form .cancelbtn {
  padding: 14px 20px;
  background-color: #f44336;
}

/* Add padding to container elements */
.container {
  padding: 16px;
}
/* Clear floats */
.clearfix::after {
  content: "";
  clear: both;
  display: table;
}
@media screen and (max-width: 300px) {
  .cancelbtn, .signupbtn {
    width: 100%;
  }
}
</style>


<?php require('footer.php');?>