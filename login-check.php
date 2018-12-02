<?php
include('connection.php');
session_start();
$loginst = 0;
if ($_SESSION['username']){ 

$user_check = $_SESSION['username'];

$ses_sql = mysqli_query($db,"SELECT username FROM users WHERE username='$user_check' ");

$row=mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);

$login_user=$row['username'];

if(!empty($login_user)) 
{
   $loginst = 1;
}


}

?>