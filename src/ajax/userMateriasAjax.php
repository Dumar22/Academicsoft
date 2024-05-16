<?php
	
	require_once "../config/App.php";
	require_once "../autoload.php";
	require_once "../views/inc/Sesion_start.php";

       use controllers\materiasController;


	if(isset($_POST['modulo_materia'])){

		$insUsuario = new materiasController();

		if($_POST['modulo_materia']=="registrar"){
			echo $insUsuario->registrarMateriaControlador();
		}

		if($_POST['modulo_materia']=="eliminar"){
			echo $insUsuario->eliminarMateriaControlador();
		}

		if($_POST['modulo_materia']=="actualizar"){
			echo $insUsuario->actualizarMateriaControlador();
		}

		

	
		

		
	}else{
		session_destroy();
	    header("Location: ".SERVER_URL."login/");
	}


    ?>