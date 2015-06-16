<?php
session_start();
require_once('../conn/conn.php');

mysql_select_db($dataBase, $conn) or die(mysql_error());

	//Eliminar Noticias
	if(isset($_GET['deleteNoticias'])){
		$query = "DELETE FROM noticias WHERE id = ".$_GET["id"];

		$resultQuery = mysql_query($query) or die(mysql_error());

		//Alert y redireccionar
		echo "<script type='text/javascript'>
      		window.location = '../administration/noticias.php';
    		</script>";
	}

	//Eliminar Usuarios
	if(isset($_GET['deleteUsuarios'])){
		$query = "DELETE FROM usuario WHERE id = ".$_GET["id"];

		$resultQuery = mysql_query($query) or die(mysql_error());

		//Alert y redireccionar
		echo "<script type='text/javascript'>
      		window.location = '../administration/usuarios.php';
    		</script>";
	}

	//Eliminar Curso y sus videos
	if(isset($_GET['deleteCursos'])){
		$query = "DELETE FROM cursos WHERE id = ".$_GET["id"];

		$resultQuery = mysql_query($query) or die(mysql_error());

		//Alert y redireccionar
		echo "<script type='text/javascript'>
      		window.location = '../administration/cursos.php';
    		</script>";
	}

	//Eliminar videos de cursos
	if(isset($_GET['deleteinfoCursos'])){
		$query = "DELETE FROM videoscurso WHERE id = ".$_GET["id"];

		$resultQuery = mysql_query($query) or die(mysql_error());

		//Alert y redireccionar
		echo "<script type='text/javascript'>
      		window.location = '../administration/cursos.php';
    		</script>";
	}

	//Eliminar elemento de sidebar
	if(isset($_GET['deleteSidebar'])){
		$query = "DELETE FROM sidebar WHERE id = ".$_GET["id"];

		$resultQuery = mysql_query($query) or die(mysql_error());

		//Alert y redireccionar
		echo "<script type='text/javascript'>
      		window.location = '../administration/sidebar.php';
    		</script>";
	}

	//Eliminar elemento de ayuda
	if(isset($_GET['deleteAyuda'])){
		$query = "DELETE FROM ayuda WHERE id = ".$_GET["id"];

		$resultQuery = mysql_query($query) or die(mysql_error());

		//Alert y redireccionar
		echo "<script type='text/javascript'>
      		window.location = '../administration/ayuda.php';
    		</script>";
	}
?>