<?php
session_start();
require_once('conn/conn.php');
mysql_select_db($dataBase, $conn) or die (mysql_error());

if(isset($_COOKIE['id_user']) && isset($_COOKIE['marca'])){
	if($_COOKIE['id_user']!="" || $_COOKIE['marca']!=""){
		
		$query = sprintf("SELECT * FROM usuario WHERE id = '%s' and cookie = '%s'",
		mysql_real_escape_string(trim($_COOKIE['id_user'])),
		mysql_real_escape_string(trim($_COOKIE['marca'])));

		$resultQuery = mysql_query($query) or die(mysql_error());

		$loggeado = mysql_num_rows($resultQuery);

		if($loggeado){

			$usuario = mysql_fetch_assoc($resultQuery);

			//Agarrar primer palabra del nombre.
			$nombreCrop  = $usuario['nombre'];
			$porciones = explode(" ", $nombreCrop);
			

			$_SESSION['id'] = $usuario['id'];
			$_SESSION['nombre'] = $usuario['nombre'];
			$_SESSION['contrasenia'] = $usuario['contrasenia'];
			$_SESSION['perfil'] = $usuario['perfil'];
			$_SESSION['email'] = $usuario['email'];
			$_SESSION['nombre-crop'] =  ucfirst($porciones[0]);
			$_SESSION['tel'] = $usuario['tel'];

			if(isset ($porciones[1])){
			$_SESSION['apellido'] =  ucfirst($porciones[1]);
			}else{
				$_SESSION['apellido'] =  "";
			}

			header("Location: home.php");
		}
	}
}
?>