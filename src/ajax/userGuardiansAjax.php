<?php
	
	require_once "../config/App.php";
	require_once "../autoload.php";
	require_once "../views/inc/Sesion_start.php";

       use controllers\guardianController;


	if(isset($_POST['modulo_acudiente'])){

		$insUsuario = new guardianController();

		if($_POST['modulo_acudiente']=="registrar"){
			echo $insUsuario->registrarAcudienteControlador();
		}

		if($_POST['modulo_acudiente']=="eliminar"){
			echo $insUsuario->eliminarAcudienteControlador();
		}

		if($_POST['modulo_acudiente']=="actualizar"){
			echo $insUsuario->actualizarAcudienteControlador();
		}

		if($_POST['modulo_acudiente']=="eliminarFoto"){
			echo $insUsuario->eliminarFotoAcudienteControlador();
		}

		if($_POST['modulo_acudiente']=="actualizarFoto"){
			echo $insUsuario->actualizarFotoAcudienteControlador();
		}
		
		

		
	}else{
		session_destroy();
	    header("Location: ".SERVER_URL."login/");
	}


    ?>