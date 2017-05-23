<?php
include('db_conf.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");

$fetchinfo_dev = mysql_query("UPDATE `items` SET `print`='1' WHERE `printed`='0' AND `print`='0';");
header('Location: index.php');
exit();  
?>
