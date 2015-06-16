<?php
session_start();
require_once('../conn/conn.php');

mysql_select_db($dataBase, $conn) or die(mysql_error());

if(isset($_POST['edit'])){ //Edit Profile
	if($_POST['edit'] == "true"){

		$editar = sprintf("UPDATE seguimiento SET titulo='%s', descripcion='%s', video='%s', titleLink1='%s', link1='%s', titleLink2='%s', link2='%s' WHERE id=%d",
			mysql_real_escape_string(trim($_POST['titulo'])),
			mysql_real_escape_string(trim($_POST['descripcion'])),
			mysql_real_escape_string(trim($_POST['video'])),
			mysql_real_escape_string(trim($_POST['titulo1'])),
			mysql_real_escape_string(trim($_POST['link1'])),
			mysql_real_escape_string(trim($_POST['titulo2'])),
			mysql_real_escape_string(trim($_POST['link2'])),
			mysql_real_escape_string(trim($_POST['id'])));

			$resQEdit = mysql_query($editar, $conn) or die(mysql_error());

			echo 1;
	}else{
		echo "Ha ocurrido un error, inténtelo más tarde.";
	}
}