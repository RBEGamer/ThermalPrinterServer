<?php
include('db_conf.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

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
if($printer_name != "" && $printer_id > 0){
	$fetchinfo_reg_printer = mysql_query("SELECT * FROM `printers` WHERE `printerid`='".$printer_id."' AND `printername`='".$printer_name."'");
	if(mysql_num_rows($fetchinfo_reg_printer) <= 0){
		$fetchinfo_reg_printer_reg = mysql_query("INSERT INTO `buyprinter`.`printers` (`id`, `printerid`, `printername`, `added`) VALUES (NULL, '".$printer_id."', '".$printer_name."', CURRENT_TIMESTAMP);");
	}
	//TODO PRINTER EINTRAGEN
}


$fetchinfo_dev = mysql_query("SELECT * FROM `items` WHERE `print`='1' AND `printed`='0'");

if($printer_id > -1){
$fetchinfo_dev = mysql_query("SELECT * FROM `items` WHERE `print`='1' AND `printed`='0' AND `printerid`='".$printer_id."'");
}
$result = "";
//print only a headline if items are there
if(mysql_num_rows($fetchinfo_dev) > $item_list_start_treshhold && $row_dev['item_count'] > 0 && $row_dev['item_name'] != ""){
$result = "--- ITEM LIST ---";
}
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {

	if($row_dev['item_count'] < 0 && $row_dev['item_name'] == ""){
		$result = "\r\n";
		continue;
	}
	 $result = $result .$row_dev['item_count'] ." x ".$row_dev['item_name'] ."\n";

   if($dont_delete==0){
  $fetchinfo_push = mysql_query("UPDATE `items` SET `printed`='1' WHERE `id`='".$row_dev['id']."'");
  }
}
if(mysql_num_rows($fetchinfo_dev) > $item_list_start_treshhold && $row_dev['item_count'] > 0 && $row_dev['item_name'] != ""){
$result = $result ."---------------" ."\r\n";
}
echo $result;
?>
