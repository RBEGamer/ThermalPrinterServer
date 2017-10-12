<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include('db_conf.php');
//search for same value ann inc count +1
//else insert new Datenbank

//if prodfound < 1 then add to the ean table
$ean = "";
if(isset($_POST['ean'])){
  $ean = $_POST['ean'];
}
if(isset($_GET['ean'])){
  $ean = $_GET['ean'];
}
if(strlen($ean) <= 0){
  echo "error_ean_len";
  exit();
}
$itemname = "";
if(isset($_POST['itemname'])){
  $itemname = $_POST['itemname'];
}
if(isset($_GET['itemname'])){
  $itemname = $_GET['itemname'];
}

$itemname = str_replace('ä', 'ae', $itemname);
$itemname = str_replace('ö', 'oe', $itemname);
$itemname = str_replace('ü', 'ue', $itemname);
$itemname = str_replace('ß', 'ss', $itemname);


$prodfound = 1;
if(isset($_POST['prodfound'])){
  $prodfound = $_POST['prodfound'];
}
if(isset($_GET['prodfound'])){
  $prodfound = $_GET['prodfound'];
}


//INSERT OR UPDATE PRODUCT IN THE EAN DATABASE
  $fetchinfo_count = mysqli_query($mysqli,"SELECT * FROM `ean_database` WHERE `item_ean`='".$ean."'");
  if(mysqli_num_rows($fetchinfo_count) <= 0){
    if($itemname == ""){
      $fetchinfo_insertb = mysqli_query($mysqli,"INSERT INTO `ean_database` (`id`, `item_name`, `item_ean`, `insert_date`,`insert_without_name`) VALUES (NULL, '".$itemname."', '".$ean."', CURRENT_TIMESTAMP,1);");
    }else{
    $fetchinfo_insertb = mysqli_query($mysqli,"INSERT INTO `ean_database` (`id`, `item_name`, `item_ean`, `insert_date`,`insert_without_name`) VALUES (NULL, '".$itemname."', '".$ean."', CURRENT_TIMESTAMP,0);");
  }
  }
  $fetchinfo_countc = mysqli_query($mysqli,"SELECT * FROM `ean_database` WHERE `item_ean`='".$ean."'");
  if(mysqli_num_rows($fetchinfo_countc) <= 0){
    if($row_dev['item_name'] == "" && $itemname == ""){
  $fetchinfo_name = mysqli_query($mysqli,"UPDATE `ean_database` SET `item_name`='".$itemname."', `name_updated`='1' WHERE `item_ean`='".$ean."'");
}
  }




//IF ITEM EXISTS INCREASE AMOUNT
$fetchinfo_count = mysqli_query($mysqli,"SELECT * FROM `items` WHERE `printed`='0' AND `item_name`='".$itemname."'");
if(mysqli_num_rows($fetchinfo_count) > 0){
while($row_dev = mysqli_fetch_array($fetchinfo_count)) {
$cc = $row_dev['item_count'];
$cc = $cc +1;
$fetchinfo_devaccount = mysqli_query($mysqli,"UPDATE `items` SET `item_count`='".$cc."' WHERE `id`='".$row_dev['id']."'");
}
echo "ok";
exit();
}



//ADD TO PRINT QUEUE -> ACTIVE PRINTER
    $fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `printers` WHERE 1");
    while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
    $fetchinfo_dev_in = mysqli_query($mysqli,"INSERT INTO `items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '".$itemname."', '0', '0', CURRENT_TIMESTAMP, '1', '".$row_dev['printerid']."');");
    }




 echo "ok";






 ?>
