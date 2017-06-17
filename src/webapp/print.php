<?php
include('db_conf.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");


$printer_id = -1;
if(isset($_POST['printer_id'])){
  $printer_id = $_POST['printer_id'];
}

if(isset($_GET['printer_id'])){
  $printer_id = $_GET['printer_id'];
}


if($printer_id == -1){
    //print for all printers
$fetchinfo_dev = mysql_query("UPDATE `items` SET `print`='1' WHERE `printed`='0' AND `print`='0';");
}else{
//TODO
$fetchinfo_dev = mysql_query("UPDATE `items` SET `print`='1' WHERE `printed`='0' AND `print`='0' AND `printerid`='".$printer_id."';");
}


header('Location: index.php');
exit();  
?>
