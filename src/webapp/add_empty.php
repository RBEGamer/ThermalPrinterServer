<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include('db_conf.php');



$printer_id = -1;
if(isset($_POST['printer_id'])){
  $printer_id = $_POST['printer_id'];
}
if(isset($_GET['printer_id'])){
  $printer_id = $_GET['printer_id'];
}



if($printer_id < 0){
//adde für alle
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `printers` WHERE 1");
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
$fetchinfo_dev_ina = mysqli_query($mysqli, "INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '', '1', '0', CURRENT_TIMESTAMP, '-1', '".$row_dev['printerid']."');");
}

}else{
//adde für diesen
$fetchinfo_dev_inb = mysqli_query($mysqli, "INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '', '1', '0', CURRENT_TIMESTAMP, '-1', '".$printer_id."');");
}



echo "ok";
header('Location: index.php');
exit();

?>
