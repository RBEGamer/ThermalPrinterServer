<?php
include('db_conf.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

$printer_id = -1;
if(isset($_POST['printer_id'])){
  $printer_id = $_POST['printer_id'];
}


if(isset($_POST['item_name']) && $_POST['item_name'] != "" && isset($_POST['item_count'])){
$fetchinfo_dev = mysql_query("INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '".$_POST['item_name']."', '0', '0', CURRENT_TIMESTAMP, '".$_POST['item_count']."', '".$printer_id."');");
header('Location: index.php');
exit();  
}else{
echo "item_name or item_count not set";
}
?>
