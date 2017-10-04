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

</tr><tr><td> SELECT PRINTER TO ADD ITEM</td><td>
<?php
include('db_conf.php');

$counter=0;
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `printers` WHERE 1");
$result = "<select name='printer_id' id='printer_id'><option value='-1'>ALL</option>";
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
	 $result = $result ."<option value='".$row_dev['printerid']. "'>".$row_dev['printername']. "</option>";
}
 $result = $result ."</select>";
 echo $result;
?>
</td></tr>
<tr><td><input type='submit' value='ADD ITEM' /></td></tr>
</table>
</form>


</form>
<form method='POST' action='add_empty.php'>
<input type='submit' value='PRINT EMTPY LINE' />
</form>


<br><br>
<h2>PRINT ITEMS</h2>
<form method='POST' action='print.php'>
<table>
<tr><td> SELECT PRINTER TO ADD ITEM</td><td>
<?php
//include('db_conf.php');

$counter=0;
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `printers` WHERE 1");
$result = "<select name='printer_id' id='printer_id'><option value='-1'>ALL</option>";
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
	 $result = $result ."<option value='".$row_dev['printerid']. "'>".$row_dev['printername']. "</option>";
}
 $result = $result ."</select>";
 echo $result;
?>
</td></tr>
<tr><td><input type='submit' value='PRINT ON SELECTED PRINTER' /></td></tr>
</table>
</form>







<br><br>
<h2>ITEM LIST</h2>
<?php
//include('db_conf.php');
$counter=0;
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `items` LEFT JOIN `printers` ON `items`.`printerid` = `printers`.`printerid` WHERE `printed` = '0'");
$result = "<table><tr><th>COUNT</th><th>ITEM</th><th>PRINT ON PRINTER</th></tr>";
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
if($row_dev['item_count'] == -1 && $row_dev['item_name'] == ""){
$result = $result . "<tr><td></td><td></td><td></td><td></td></tr>";
	continue;
}

if($row_dev['printed'] == "1"){continue;} //print nothing if already printed
//show print queue state
	if($row_dev['print'] == "1"){
	 $result = $result ."<tr><td>" .$row_dev['item_count'] ."</td><td>".$row_dev['item_name']. "</td><td>".$row_dev['printername']."</td></tr>";
	}else {
		$result = $result ."<tr><td>" .$row_dev['item_count'] ."</td><td>".$row_dev['item_name']. "</td><td>".$row_dev['printername']."</td></tr>";
	}
	$counter++;
}
 $result = $result ."</table>";
 echo $result;
?>


<h3>EAN DATABASE EDITOR</h3>
<a href='ean_editor.php'> EAN MISSING NAME EDITOR </a>
</center>
</body>
</html>
