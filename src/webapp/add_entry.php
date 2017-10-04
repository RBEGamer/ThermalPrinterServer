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
echo $printer_id;
$in = "";
if(isset($_POST['item_name'])){
  $in = $_POST['item_name'];
}
if(isset($_GET['item_name'])){
  $in = $_GET['item_name'];
}



$item_count = 0;
if(isset($_POST['item_count'])){
  $item_count = $_POST['item_count'];
}
if(isset($_GET['item_count'])){
  $item_count = $_GET['item_count'];
}


if($in == ""){
  echo "item_name_get_post_error";
  exit();
}

// ADD HERE SOME CHARS TO REPLACE like the german ä -> ae
//because the printer cant print them
$in = str_replace('ä', 'ae', $in);
$in = str_replace('ö', 'oe', $in);
$in = str_replace('ü', 'ue', $in);
$in = str_replace('ß', 'ss', $in);
//$in = str_replace('@', '(at)', $in);

if($printer_id < 0){
//adde für alle
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `printers` WHERE 1");
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
$fetchinfo_dev_in = mysqli_query($mysqli,"INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '".$in."', '0', '0', CURRENT_TIMESTAMP, '".$item_count."', '".$row_dev['printerid']."');");
}

}else{
//adde für diesen
$fetchinfo_dev_in = mysqli_query($mysqli,"INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '".$in."', '0', '0', CURRENT_TIMESTAMP, '".$item_count."', '".$printer_id."');");
}



echo "ok";
header('Location: index.php');
exit();

?>
