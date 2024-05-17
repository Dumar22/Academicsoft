<?php
	
	require_once "../config/App.php";
	require_once "../autoload.php";
	require_once "../views/inc/Sesion_start.php";

       use controllers\notesController;


	if(isset($_POST['modulo_nota'])){

		$insUsuario = new notesController();

		if($_POST['modulo_nota']=="registrar"){
			echo $insUsuario->registrarNotaControlador();
		}

		if($_POST['modulo_nota']=="eliminar"){
			echo $insUsuario->eliminarNotaControlador();
		}

		if($_POST['modulo_nota']=="actualizar"){
			echo $insUsuario->actualizarNotaControlador();
		}

		

	
		

		
	}else{
		session_destroy();
	    header("Location: ".SERVER_URL."login/");
	}


    ?>