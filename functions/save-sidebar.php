<?php
session_start();
require_once('../conn/conn.php');

mysql_select_db($dataBase, $conn) or die(mysql_error());

if(isset($_POST['edit'])){ //Edit Profile
	if($_POST['edit'] == "true"){
		$editar = sprintf("UPDATE sidebar SET titulo='%s', descripcion='%s', image='%s', video='%s' WHERE id=%d",
			mysql_real_escape_string(trim($_POST['titulo'])),
			mysql_real_escape_string(trim($_POST['descripcion'])),
			mysql_real_escape_string(trim($_POST['image'])),
			mysql_real_escape_string(trim($_POST['video'])),
			mysql_real_escape_string(trim($_POST['id'])));

			$resQEdit = mysql_query($editar, $conn) or die(mysql_error());

			echo 1;
	}else{
		echo "Ha ocurrido un error, inténtelo más tarde.";
	}

}else{//Register
		$qInsert = sprintf("INSERT INTO sidebar VALUES(null, '%s', '%s', '%s', '%s')",
			mysql_real_escape_string(trim($_POST['titulo'])),
			mysql_real_escape_string(trim($_POST['descripcion'])),
			mysql_real_escape_string(trim($_POST['image'])),
			mysql_real_escape_string(trim($_POST['video'])));

			$resQInsert = mysql_query($qInsert, $conn) or die(mysql_error());

			if($resQInsert) {			
			 echo 1;
			} else {
			 echo "Ha ocurrido un error, inténtelo más tarde.";
			}

}


?>