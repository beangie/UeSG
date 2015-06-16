<?php
session_start();
require_once('../conn/conn.php');

mysql_select_db($dataBase, $conn) or die(mysql_error());

	
		$editar = sprintf("UPDATE general SET nombre='%s', logo='%s'",
			mysql_real_escape_string(trim($_POST['nombre'])),
			mysql_real_escape_string(trim($_POST['image'])));

			$resQEdit = mysql_query($editar, $conn) or die(mysql_error());

			echo 1;


?>