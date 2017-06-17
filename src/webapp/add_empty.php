<?php
include('db_conf.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");
$printer_id = -1;
if(isset($_POST['printer_id'])){
  $printer_id = $_POST['printer_id'];
}



if($printer_id == -1){
//adde für alle
$fetchinfo_dev = mysql_query("SELECT * FROM `printers` WHERE 1");
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$fetchinfo_dev_ina = mysql_query("INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '', '1', '0', CURRENT_TIMESTAMP, '-1', '".$row_dev['printerid']."');");
}

}else{
//adde für diesen
if($printer_id != -1){
$fetchinfo_dev_inb = mysql_query("INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '', '1', '0', CURRENT_TIMESTAMP, '-1', '".$printer_id."');");

}
}




header('Location: index.php');
exit();  

?>



