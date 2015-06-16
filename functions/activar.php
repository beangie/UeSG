<?php
session_start();

require_once('../conn/conn.php');

mysql_select_db($dataBase, $conn) or die (mysql_error());

if(isset($_GET['id'])){
	//Query
	$query = sprintf("SELECT * FROM usuario WHERE activation = '%s'",
		mysql_real_escape_string(trim($_GET['id'])));

	$resultQuery = mysql_query($query) or die(mysql_error());

	$loggeado = mysql_num_rows($resultQuery);

	if($loggeado){

		$usuario = mysql_fetch_assoc($resultQuery);

		//Agarrar primer palabra del nombre.
		$nombreCrop  = $usuario['nombre'];
		$porciones = explode(" ", $nombreCrop);
		
		//Guardar variables de session
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

		mysql_query("UPDATE usuario SET activation='1' 
								WHERE id=".$_SESSION['id']) or die(mysql_error());

		header("Location: ../home.php");

	} else {
		header("Location: ../index.php");
		echo "¡Oops! Esta cuenta ya ha sido activada, o el enlace ha sido corrompido. Favor de verificar.";
	}

}else{
	header("Location: ../index.php");
}
?>