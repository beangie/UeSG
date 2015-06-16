<?php
session_start();
require_once('../conn/conn.php');

mysql_select_db($dataBase, $conn) or die(mysql_error());

if(isset($_POST['pausa'])){ //Edit Profile
	
		$editar = sprintf("UPDATE usuario SET pausar='%s' WHERE id=%d",
			mysql_real_escape_string(trim($_POST['pausa'])),
			mysql_real_escape_string(trim($_POST['id'])));

			$resQEdit = mysql_query($editar, $conn) or die(mysql_error());

			echo 1;

}