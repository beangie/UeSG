<?php
session_start();

require_once('../conn/conn.php');

mysql_select_db($dataBase, $conn) or die (mysql_error());

//Query
$query = sprintf("SELECT * FROM usuario WHERE email = '%s' and contrasenia = '%s'",
	mysql_real_escape_string(trim($_POST['email'])),
	mysql_real_escape_string(trim($_POST['contrasenia'])));

$resultQuery = mysql_query($query) or die(mysql_error());

$loggeado = mysql_num_rows($resultQuery);

if($loggeado){

	$usuario = mysql_fetch_assoc($resultQuery);

	if ($usuario['pausar'] == 1) {

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

		//Crear cookies si el checkbox fue seleccionado
		if(isset($_POST['check_cookie'])){
			if($_POST['check_cookie'] == 'check'){
				mt_srand(time());
				$rand = mt_rand(1000000,9999999);
				mysql_query("UPDATE usuario SET cookie='".$rand."' 
								WHERE id=".$_SESSION['id']) or die(mysql_error());

				setcookie("id_user", $_SESSION['id'], time() + 604800,'/');
				setcookie("marca", $rand, time() + 604800,'/');

				
			}
			//Resultados Login normal y admin
			if(isset($_POST['ad']) && $_POST['ad'] == 'true'){
				if($_SESSION['perfil'] == 1){
					echo 1;
				}else{
					echo "No estás autorizado para acceder a esta área."; 
				}
			}else{
				echo 1;
			}
			
		}

	}else{
		echo "Tu cuenta ha sido congelada debido a que no ha sido cubierto el último pago. Si tienes alguna duda envía un correo a info@pagotudeuda.com";
	}

	
} else {
	echo "Correo o contraseña incorrectos...";
}

?>