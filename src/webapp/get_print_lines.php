<?php



include('db_conf.php');




$item_list_start_treshhold = 10;
$dont_delete = 0;
if(isset($_GET['noprinter'])){
$dont_delete = 1;
}

$printer_id = -1;
if(isset($_GET['printer_id'])){
$printer_id = $_GET['printer_id'];
}

$printer_name = "";
if(isset($_GET['printer_name'])){
$printer_name = $_GET['printer_name'];
}

//REGISTER PRINTER
//ID -1 is reserved for all printers
if($printer_name != "" && $printer_id != -1){
	$fetchinfo_reg_printer = mysqli_query($mysqli,"SELECT * FROM `printers` WHERE `printername`='".$printer_name."'");
	if(mysqli_num_rows($fetchinfo_reg_printer) <= 0){
		$fetchinfo_reg_printer_reg = mysqli_query($mysqli,"INSERT INTO `printers` (`id`, `printerid`, `printername`, `added`) VALUES (NULL, '".$printer_id."', '".$printer_name."', CURRENT_TIMESTAMP);");
		echo "PRINTER REGISTERED";
		exit();
	}
}


$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `items` WHERE `print`='1' AND `printed`='0'");

if($printer_id > -1){
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `items` WHERE `print`='1' AND `printed`='0' AND `printerid`='".$printer_id."'");
}
$result = "";
//print only a headline if items are there
if(mysqli_num_rows($fetchinfo_dev) > $item_list_start_treshhold && $row_dev['item_count'] > 0 && $row_dev['item_name'] != ""){
$result = "--- ITEM LIST ---";
}
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {

	if($row_dev['item_count'] < 0 && $row_dev['item_name'] == ""){
		$result = "\r\n";
		continue;
	}
	 $result = $result .$row_dev['item_count'] ." x ".$row_dev['item_name'] ."\n";

   if($dont_delete==0){
  $fetchinfo_push = mysqli_query($mysqli,"UPDATE `items` SET `printed`='1' WHERE `id`='".$row_dev['id']."'");
  }
}
if(mysqli_num_rows($fetchinfo_dev) > $item_list_start_treshhold && $row_dev['item_count'] > 0 && $row_dev['item_name'] != ""){
$result = $result ."---------------" ."\r\n";
}
echo $result;
?>
