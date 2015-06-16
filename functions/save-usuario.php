<?php
session_start();
require_once('../conn/conn.php');

mysql_select_db($dataBase, $conn) or die(mysql_error());

if(isset($_POST['edit'])){ //Edit Profile
	if($_POST['edit'] == "true"){

		if(isset($_POST['id'])){
			//Edit User desde administrador
			$editar = sprintf("UPDATE usuario SET nombre='%s', email='%s', contrasenia='%s', tel='%s' WHERE id=%d",
			mysql_real_escape_string(trim($_POST['nombre'])),
			mysql_real_escape_string(trim($_POST['email'])),
			mysql_real_escape_string(trim($_POST['contrasenia'])),
			mysql_real_escape_string(trim($_POST['tel'])),
			mysql_real_escape_string(trim($_POST['id'])));

			$resQEdit = mysql_query($editar, $conn) or die(mysql_error());

			echo 1;

		}else{

			//Edit profile user normal
			$editar = sprintf("UPDATE usuario SET nombre='%s', email='%s', contrasenia='%s', tel='%s' WHERE id=%d",
			mysql_real_escape_string(trim($_POST['nombre'])),
			mysql_real_escape_string(trim($_POST['email'])),
			mysql_real_escape_string(trim($_POST['contrasenia'])),
			mysql_real_escape_string(trim($_POST['tel'])),
			mysql_real_escape_string(trim($_SESSION['id'])));

			$resQEdit = mysql_query($editar, $conn) or die(mysql_error());

			echo 1;

		}
		
	}else{
		echo "Ha ocurrido un error, inténtelo más tarde.";
	}



}else{//Register
	$qConsulta = sprintf("SELECT * FROM usuario WHERE email = '%s'",
	mysql_real_escape_string(trim($_POST['email'])));

	$resQConsulta = mysql_query($qConsulta, $conn) or die(mysql_error());

	if ($resQConsulta){

		$registrado = mysql_num_rows($resQConsulta);

		if ($registrado){
			echo "Este correo ya está en uso, intente uno nuevo";
		}
		else{
			$aleatorio = uniqid();

			$qInsert = sprintf("INSERT INTO usuario VALUES(null, '%s', '%s', '%s', '%s', '%s', '%s', '')",
				 mysql_real_escape_string(trim($_POST['nombre'])),
				 mysql_real_escape_string(trim($_POST['email'])),
				 mysql_real_escape_string(trim($_POST['contrasenia'])),
				 mysql_real_escape_string(trim('2')),
				 mysql_real_escape_string(trim('')),
				 mysql_real_escape_string(trim($aleatorio)));

			$resQInsert = mysql_query($qInsert, $conn) or die(mysql_error());

			$mensaje = "Gracias por registrarte con nosotros, tu cuenta ha sido creada con éxito, por favor guarda bien tus datos de acceso...\n\n"; 
			$mensaje .= "Estos son tus datos de registro:\n"; 
			$mensaje .= "Nombre: ".$_POST['nombre']." \n";
			$mensaje .= "Email: ".$_POST['email']." \n";
			$mensaje .= "Contraseña: ".$_POST['contrasenia']." \n";
			$mensaje .= "Da Click en el siguiente enlace para activar tu cuenta: http://sentirsesaludable.com/BackOffice/functions/activar.php?id=$aleatorio"; 

			$para 		= $_POST['email'];
			$asunto 	= 'Activación de tu cuenta PagoTuDeuda';
			$de 		= 'infoo@pagotudeudaa.com';
			$headers 	= 'From: '.$de."\r\n".'Reply-To: '.$para;

			mail($para, $asunto, $mensaje, $headers);

			if($resQInsert) {			
			 echo 1;
			} else {
			 echo "Ha ocurrido un error, inténtelo más tarde.";
			}

		}

	}else{
		echo "Ha ocurrido un error, inténtelo más tarde.";	
	}//Fin Register

}


?>