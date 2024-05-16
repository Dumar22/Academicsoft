<?php
	
	require_once "../config/App.php";
	require_once "../autoload.php";
	require_once "../views/inc/Sesion_start.php";

       use controllers\studentController;


	if(isset($_POST['modulo_estudiante'])){

		$insUsuario = new studentController();

		if($_POST['modulo_estudiante']=="registrar"){
			echo $insUsuario->registrarEstudianteControlador();
		}

		if($_POST['modulo_estudiante']=="eliminar"){
			echo $insUsuario->eliminarEstudianteControlador();
		}

		if($_POST['modulo_estudiante']=="actualizar"){
			echo $insUsuario->actualizarEstudianteControlador();
		}

		if($_POST['modulo_estudiante']=="eliminarFoto"){
			echo $insUsuario->eliminarFotoEstudianteControlador();
		}

		if($_POST['modulo_estudiante']=="actualizarFoto"){
			echo $insUsuario->actualizarFotoEstudianteControlador();
		}
		
		

		
	}else{
		session_destroy();
	    header("Location: ".SERVER_URL."login/");
	}


    ?>