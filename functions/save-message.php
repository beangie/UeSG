<?php
session_start();

	$mensaje = $_POST['mensaje']; 

	$para 		= 'beangiie@gmail.com';
	$asunto 	= $_POST['asunto'].' - '.$_POST['nombre'];
	$de 		= $_POST['email'];
	$headers 	= 'From: '.$de."\r\n".'Reply-To: '.$para;


	if(mail($para, $asunto, $mensaje, $headers)) {			
		echo 1;
	} else {
		echo "Ha ocurrido un error, inténtelo más tarde.";
	}



?>