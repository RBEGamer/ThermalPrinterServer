<?php
include('db_conf.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

$printer_id = -1;
if(isset($_POST['printer_id'])){
  $printer_id = $_POST['printer_id'];
}

$in = $_POST['item_name'];


// ADD HERE SOME CHARS TO REPLACE like the german ä -> ae 
//because the printer cant print them
$in = str_replace('ä', 'ae', $in);
$in = str_replace('ö', 'oe', $in);
$in = str_replace('ü', 'ue', $in);
$in = str_replace('ß', 'ss', $in);
//$in = str_replace('@', '(at)', $in);

if($printer_id == -1){
//adde für alle
$fetchinfo_dev = mysql_query("SELECT * FROM `printers` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$fetchinfo_dev_in = mysql_query("INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '".$in."', '0', '0', CURRENT_TIMESTAMP, '".$_POST['item_count']."', '".$row_dev['printerid']."');");
}

}else{
//adde für diesen
if($printer_id != -1){
$fetchinfo_dev_in = mysql_query("INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '".$in."', '0', '0', CURRENT_TIMESTAMP, '".$_POST['item_count']."', '".$printer_id."');");
}
}




header('Location: index.php');
exit();  

?>
