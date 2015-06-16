<?php

$path = '../assets/img/uploads/';

foreach($_FILES as $img) {

	if($img['error'] == UPLOAD_ERR_OK) {

		$name 		= $img['name'];
		$extension 	= pathinfo($img['name'], PATHINFO_EXTENSION);

		if($extension == 'png' || $extension == 'jpg' || $extension == 'JPG') {

			if(move_uploaded_file($img['tmp_name'], $path.$name)) {
				echo 1;
			} else {
				echo 0;
			}

		} else {
			echo 'Tipo de archivo no permitido';
		}

	} else {

		echo $img['error'];

	}

}

?>