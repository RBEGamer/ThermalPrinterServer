<?php
ini_set('display_errors', 'On');
error_reporting(E_ALL);
include('db_conf.php');



$item_name = "";
if(isset($_POST['item_name'])){
  $item_name = $_POST['item_name'];
}
if(isset($_GET['item_name'])){
  $item_name = $_GET['item_name'];
}
$ean = "";
if(isset($_POST['ean'])){
  $ean = $_POST['ean'];
}
if(isset($_GET['ean'])){
  $ean = $_GET['ean'];
}

if($item_name != "" && $ean != ""){
  //REPLACE GERMANY CHARS
  $item_name = str_replace('ä', 'ae', $item_name);
  $item_name = str_replace('ö', 'oe', $item_name);
  $item_name = str_replace('ü', 'ue', $item_name);
  $item_name = str_replace('ß', 'ss', $item_name);
  //UPDATE
$fetchinfo_up = mysqli_query($mysqli,"UPDATE `ean_database` SET `item_name`='".$item_name."', `name_updated`='1' WHERE `item_ean`='".$ean."'");
}

header('Location: ean_editor.php');
exit();

?>
