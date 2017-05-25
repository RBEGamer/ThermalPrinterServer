<html>
<head>
</head>
<body>
<center>
<h1> BUY LIST PRINTER INTERFACE </h1>
<h2> ADD NEW ITEM </h2>
<form method='POST' action='add_entry.php'>
<table>
<tr><th>COUNT</th> <th>NAME</th></tr>
<tr>
 <td><input type='number' name="item_count" id='item_count' min='1' max='99' value='1'></td>
<td><input type='text' placeholder='ITEM_NAME' name='item_name' id='item_name'/></td>
</tr>
<tr><td><input type='submit' value='ADD ITEM' /></td></tr>
</table>
</form>


<h2>  ITEMS TO PRINTasd</h2>

<form method='POST' action='print.php'>
<input type='submit' value='PRINT ITEMS' />
</form>





<?php
include('db_conf.php');
$verbindung = mysql_connect ($db_host,
$db_username, $db_password)or die ("keine Verbindung möglich. Benutzername oder Passwort sind falsch");
mysql_select_db($db_name)or die ("Die Datenbank existiert nicht.");
$counter=0;
$fetchinfo_dev = mysql_query("SELECT * FROM `items` WHERE `printed`='0'");
$result = "<table><tr><th>ID</th><th>COUNT</th><th>ITEM</th><th>SEND TO PRINTER</th></tr>";
while($row_dev = mysql_fetch_array($fetchinfo_dev)) {
$counter++;
	if($row_dev['print'] == "1"){
	 $result = $result ."<tr><td>" .$counter ."</td><td>" .$row_dev['item_count'] ."</td><td>".$row_dev['item_name']. "</td><td>YES</td></tr>";
	}else{
		$result = $result ."<tr><td>" .$counter ."</td><td>" .$row_dev['item_count'] ."</td><td>".$row_dev['item_name']. "</td><td>NO</td></tr>";
	
	}
}
 $result = $result ."</table>";
 echo $result;
?>


</center>
</body>
</html>
