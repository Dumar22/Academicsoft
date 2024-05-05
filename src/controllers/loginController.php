<?php

	namespace controllers;
	use models\mainModel;

	class loginController extends mainModel{

		/*----------  Controlador iniciar sesion  ----------*/
		public function iniciarSesionControlador(){

			$usuario=$this->cleanQuery($_POST['login_usuario']);
		    $clave=$this->cleanQuery($_POST['login_clave']);
            echo $usuario;
            echo $clave;

		    # Verificando campos obligatorios #
		    if($usuario=="" || $clave==""){
		        echo "<script>
			        Swal.fire({
					  icon: 'error',
					  title: 'Ocurrió un error inesperado',
					  text: 'No has llenado todos los campos que son obligatorios'
					});
				</script>";
		    }else{

			    # Verificando integridad de los datos #
			    if($this->verifyData("[a-zA-Z0-9]{4,20}",$usuario)){
			        echo "<script>
				        Swal.fire({
						  icon: 'error',
						  title: 'Ocurrió un error inesperado',
						  text: 'El USUARIO no coincide con el formato solicitado'
						});
					</script>";
			    }else{

			    	# Verificando integridad de los datos #
				    if($this->verifyData("[a-zA-Z0-9$@.-]{7,100}",$clave)){
				        echo "<script>
					        Swal.fire({
							  icon: 'error',
							  title: 'Ocurrió un error inesperado',
							  text: 'La CLAVE no coincide con el formato solicitado'
							});
						</script>";
				    }else{

					    # Verificando usuario #
					    $check_usuario=$this->executeQuery("SELECT * FROM usuarios WHERE usuario_usuario='$usuario'");

					    if($check_usuario->rowCount()==1){

					    	$check_usuario=$check_usuario->fetch();

					    	if($check_usuario['usuario_usuario']==$usuario && password_verify($clave,$check_usuario['usuario_clave'])){

					    		$_SESSION['id']=$check_usuario['usuario_id'];
					            $_SESSION['nombre']=$check_usuario['usuario_nombre'];
					            $_SESSION['apellido']=$check_usuario['usuario_apellido'];
					            $_SESSION['usuario']=$check_usuario['usuario_usuario'];
					            $_SESSION['rol']=$check_usuario['usuario_rol'];
					            $_SESSION['foto']=$check_usuario['usuario_foto'];


					            if(headers_sent()){
					                echo "<script> window.location.href='".SERVER_URL."src/dashboard/'; </script>";
					            }else{
					                header("Location: ".SERVER_URL."src/dashboard/");
					            }

					    	}else{
					    		echo "<script>
							        Swal.fire({
									  icon: 'error',
									  title: 'Ocurrió un error inesperado',
									  text: 'Usuario o clave incorrectos'
									});
								</script>";
					    	}

					    }else{
					        echo "<script>
						        Swal.fire({
								  icon: 'error',
								  title: 'Ocurrió un error inesperado',
								  text: 'Usuario o clave incorrectos'
								});
							</script>";
					    }
				    }
			    }
		    }
		}


		/*----------  Controlador cerrar sesion  ----------*/
		public function cerrarSesionControlador(){

			session_destroy();

		    if(headers_sent()){
                echo "<script> window.location.href='".SERVER_URL."src/login/'; </script>";
            }else{
                header("Location: ".SERVER_URL."src/login/");
            }
		}

	}


    ?>