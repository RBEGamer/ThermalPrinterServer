<html>
<head>
</head>
<body>
<center>
<h1> BUY LIST PRINTER INTERFACE </h1>
<h2> EAN EDITOR</h2>

<?php
include('db_conf.php');
?>

<br><br>
<h2>EAN NAME MISSING NAME EDITOR</h2>
<table>
<tr>
<?php
$counter=0;
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `ean_database` WHERE `insert_without_name`='1' AND `name_updated`='0'");
$result = "";
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
$result = $result . "<form method='POST' action='edit_missing_ean_name.php'><tr><td><input type='text' placeholder='ITEM_NAME' value='".$row_dev['item_name']."' name='item_name' /></td><td><input type='text' value='".$row_dev['item_ean']."' name='ean' readonly /><input type='text' value='".$row_dev['insert_date']."' name='time' readonly /><td> <input type='submit' value='Change name'></td></tr></form>";
}
echo $result;
?>
</table>




<br><br>
<h2>COMPLETE EAN DATABASE</h2>
<table>
<tr>
<?php
$counter=0;
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `ean_database` WHERE 1");
$result = "";
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
  if($row_dev['item_name'] != ""){
$result = $result . "<form method='POST' action='edit_missing_ean_name.php'><tr><td><input type='text' placeholder='ITEM_NAME' value='".$row_dev['item_name']."' name='item_name'/></td><td><input type='text' value='".$row_dev['item_ean']."' name='ean' readonly /><input type='text' value='".$row_dev['insert_date']."' name='time' readonly /><td> <input type='submit' value='Change name'></td></tr></form>";
}
}
echo $result;
?>
</table>

</center>
</body>
</html>
