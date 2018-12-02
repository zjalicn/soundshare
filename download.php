<?php require('header.php');
ini_set('display_errors', 1);
require_once 'connect-db.php'; 
function downloadSound($file){

 
$path = '/sounds/';

header("Cache-Control: private");
header("Content-type: audio/mpeg3");
header("Content-Transfer-Encoding: binary");
header("Content-Disposition: attachment; filename=".$file);

}  

$id = $_POST['id'];
echo $id;

$sql = "SELECT file FROM sounds where id = '$id' "; 
if ($result = mysqli_query($mysqli, $sql)){
       while($row = mysqli_fetch_array($result)){
                          
                            $file = $row["file"];
downloadSound($file);

}}
?>