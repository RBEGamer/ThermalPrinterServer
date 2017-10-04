<?php

ini_set('display_errors', 'On');
error_reporting(E_ALL);

DEFINE('DB_USERNAME', 'root');
DEFINE('DB_PASSWORD', 'root');
DEFINE('DB_HOST', '127.0.0.1');
DEFINE('DB_DATABASE', 'buyprinter');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

if (mysqli_connect_error()) {
  die('Connect Error ('.mysqli_connect_errno().') '.mysqli_connect_error());
}

//echo 'Connected successfully.';




?>
