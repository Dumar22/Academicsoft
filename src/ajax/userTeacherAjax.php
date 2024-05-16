<?php
	
	require_once "../config/App.php";
	require_once "../autoload.php";
	require_once "../views/inc/Sesion_start.php";

       use controllers\teacherController;


	if(isset($_POST['modulo_profesor'])){

		$insUsuario = new teacherController();

		if($_POST['modulo_profesor']=="registrar"){
			echo $insUsuario->registrarProfesorControlador();
		}

		if($_POST['modulo_profesor']=="eliminar"){
			echo $insUsuario->eliminarProfesorControlador();
		}

		if($_POST['modulo_profesor']=="actualizar"){
			echo $insUsuario->actualizarProfesorControlador();
		}

		if($_POST['modulo_profesor']=="eliminarFoto"){
			echo $insUsuario->eliminarFotoProfesorControlador();
		}

		if($_POST['modulo_profesor']=="actualizarFoto"){
			echo $insUsuario->actualizarFotoProfesorControlador();
		}
		
		

		
	}else{
		session_destroy();
	    header("Location: ".SERVER_URL."login/");
	}


    ?>