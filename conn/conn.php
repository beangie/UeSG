<?php

$server = 'localhost';
$dataBase = 'backoffice';
$user = 'root';
$pass = '';

$conn = mysql_connect($server, $user, $pass) or trigger_error(mysql_error, E_USER_ERROR);
mysql_query("SET NAMES 'utf8'");

?>
