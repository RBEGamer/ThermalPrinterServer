<?php
include('db_conf.php');



$in = $_GET['item_name'];


// ADD HERE SOME CHARS TO REPLACE like the german ä -> ae
//because the printer cant print them
$in = str_replace('ä', 'ae', $in);
$in = str_replace('ö', 'oe', $in);
$in = str_replace('ü', 'ue', $in);
$in = str_replace('ß', 'ss', $in);
//$in = str_replace('@', '(at)', $in);

//adde für alle
$fetchinfo_dev = mysqli_query($mysqli,"SELECT * FROM `printers` WHERE 1");
while($row_dev = mysqli_fetch_array($fetchinfo_dev)) {
$fetchinfo_dev_in = mysqli_query($mysqli,"INSERT INTO `buyprinter`.`items` (`id`, `item_name`, `print`, `printed`, `added_date`, `item_count`, `printerid`) VALUES (NULL, '".$in."', '0', '0', CURRENT_TIMESTAMP, '".$_GET['item_count']."', '".$row_dev['printerid']."');");
}

echo "1";
exit();

?>
