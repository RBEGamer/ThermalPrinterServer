<?php
include('db_conf.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

$dont_delete = 0;
if(isset($_GET['noprinter'])){
$dont_delete = 1;
}

$printer_id = -1;
if(isset($_GET['printer_id'])){
$printer_id = $_GET['printer_id'];
}

$fetchinfo_dev = mysql_query("SELECT * FROM `items` WHERE `print`='1' AND `printed`='0'");

if($printer_id > -1){
$fetchinfo_dev = mysql_query("SELECT * FROM `items` WHERE `print`='1' AND `printed`='0' AND `printerid`='".$printer_id."'");
}
//print only a headline if items are there
if(mysql_num_rows($fetchinfo_dev) >0){
$result = "--- ITEM LIST ---" ."\r\n";
}
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
	 $result = $result .$row_dev['item_count'] ." x ".$row_dev['item_name']. "\r\n";

   if($dont_delete==0){
  $fetchinfo_push = mysql_query("UPDATE `items` SET `printed`='1' WHERE `id`='".$row_dev['id']."' AND");
  }
}
if(mysql_num_rows($fetchinfo_dev) >0){
$result = $result ."---------------" ."\r\n";
}
echo $result;
?>
