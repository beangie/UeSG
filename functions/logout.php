<?php 

	session_start();
	session_unset();
	session_destroy();
	setcookie("id_user", "", time() - 604800,'/');
	setcookie("marca", "", time() - 604800,'/');
	header ("Location:../index.php");
?>


