<?php
	
	require_once "../config/App.php";
	require_once "../autoload.php";
	require_once "../views/inc/Sesion_start.php";

       use controllers\gradesController;


	if(isset($_POST['modulo_grado'])){

		$insUsuario = new gradesController();

		if($_POST['modulo_grado']=="registrar"){
			echo $insUsuario->registrarGradoControlador();
		}

		if($_POST['modulo_grado']=="eliminar"){
			echo $insUsuario->eliminarGradoControlador();
		}

		if($_POST['modulo_grado']=="actualizar"){
			echo $insUsuario->actualizarGradoControlador();
		}

		

	
		

		
	}else{
		session_destroy();
	    header("Location: ".SERVER_URL."login/");
	}


    ?>