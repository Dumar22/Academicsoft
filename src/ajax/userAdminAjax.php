<?php
	
	require_once "../config/App.php";
	require_once "../views/inc/Sesion_start.php";
	require_once "../autoload.php";

       use controllers\adminController;


	if(isset($_POST['modulo_usuario'])){

		$insUsuario = new adminController();

		if($_POST['modulo_usuario']=="registrar"){
			echo $insUsuario->registrarUsuarioControlador();
		}

		if($_POST['modulo_usuario']=="eliminar"){
			echo $insUsuario->eliminarUsuarioControlador();
		}

		if($_POST['modulo_usuario']=="actualizar"){
			echo $insUsuario->actualizarUsuarioControlador();
		}

		if($_POST['modulo_usuario']=="eliminarFoto"){
			echo $insUsuario->eliminarFotoUsuarioControlador();
		}

		if($_POST['modulo_usuario']=="actualizarFoto"){
			echo $insUsuario->actualizarFotoUsuarioControlador();
		}
		
		

		
	}else{
		session_destroy();
	    header("Location: ".SERVER_URL."login/");
	}


    ?>