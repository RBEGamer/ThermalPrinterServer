<?php
include('db_conf.php');


$printer_id = -1;
if(isset($_POST['printer_id'])){
  $printer_id = $_POST['printer_id'];
}
if(isset($_GET['printer_id'])){
  $printer_id = $_GET['printer_id'];
}


if($printer_id < 0){
    //print for all printers
$fetchinfo_dev = mysqli_query($mysqli,"UPDATE `items` SET `print`='1' WHERE `printed`='0' AND `print`='0';");
}else{
//TODO
$fetchinfo_dev = mysqli_query($mysqli,"UPDATE `items` SET `print`='1' WHERE `printed`='0' AND `print`='0' AND `printerid`='".$printer_id."';");
}


header('Location: index.php');
exit();
?>
