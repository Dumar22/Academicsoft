<?php

namespace controllers;

use models\mainModel;

class loginController extends mainModel
{

	/*----------  Controlador iniciar sesion  ----------*/
	public function iniciarSesionControlador()
	{

		$usuario = $this->cleanQuery($_POST['login_usuario']);
		$clave = $this->cleanQuery($_POST['login_clave']);
		echo $usuario;
		echo $clave;

		# Verificando campos obligatorios #
		if ($usuario == "" || $clave == "") {
			echo "<script>
			        Swal.fire({
					  icon: 'error',
					  title: 'Ocurrió un error inesperado',
					  text: 'No has llenado todos los campos que son obligatorios'
					});
				</script>";
		} else {

			# Verificando integridad de los datos #
			if ($this->verifyData("[a-zA-Z0-9]{4,20}", $usuario)) {
				echo "<script>
				        Swal.fire({
						  icon: 'error',
						  title: 'Ocurrió un error inesperado',
						  text: 'El USUARIO no coincide con el formato solicitado'
						});
					</script>";
			} else {

				# Verificando integridad de los datos #
				if ($this->verifyData("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
					echo "<script>
					        Swal.fire({
							  icon: 'error',
							  title: 'Ocurrió un error inesperado',
							  text: 'La CLAVE no coincide con el formato solicitado'
							});
						</script>";
				} else {

					# Verificando usuario administrador#
					#$check_usuario = $this->executeQuery("SELECT * FROM usuarios WHERE usuario_usuario='$usuario'");#

					$check_usuario = $this->executeQuery("SELECT * FROM usuarios WHERE usuario_usuario='$usuario'");
					if ($check_usuario->rowCount() == 0) {
						$check_usuario = $this->executeQuery("SELECT * FROM profesores WHERE profesor_usuario='$usuario'");
					}
					if ($check_usuario->rowCount() == 0) {
						$check_usuario = $this->executeQuery("SELECT * FROM estudiantes WHERE estudiante_usuario='$usuario'");
					}
					if ($check_usuario->rowCount() == 0) {
						$check_usuario = $this->executeQuery("SELECT * FROM acudientes WHERE acudiente_usuario='$usuario'");
					}



					if ($check_usuario->rowCount() > 0) {
						// Obtener datos del usuario
						$usuario_data = $check_usuario->fetch();
					
						// Verificar en qué tabla se encuentra el usuario y validar la contraseña correspondiente
						if ($usuario_data['usuario_usuario'] == $usuario && password_verify($clave, $usuario_data['usuario_clave'])) {
							// Usuario encontrado en la tabla 'usuarios'
							$_SESSION['id'] = $usuario_data['usuario_id'];
							$_SESSION['nombre'] = $usuario_data['usuario_nombre'];
							$_SESSION['apellido'] = $usuario_data['usuario_apellido'];
							$_SESSION['usuario'] = $usuario_data['usuario_usuario'];
							$_SESSION['rol'] = $usuario_data['usuario_rol'];
							$_SESSION['foto'] = $usuario_data['usuario_foto'];
						} elseif ($usuario_data['profesor_usuario'] == $usuario && password_verify($clave, $usuario_data['profesor_clave'])) {
							// Usuario encontrado en la tabla 'profesores'
							$_SESSION['id'] = $usuario_data['profesor_id'];
							$_SESSION['nombre'] = $usuario_data['profesor_nombre'];
							$_SESSION['apellido'] = $usuario_data['profesor_apellido'];
							$_SESSION['usuario'] = $usuario_data['profesor_usuario'];
							$_SESSION['foto'] = $usuario_data['profesor_foto'];
							$_SESSION['rol'] = 'profesor'; // Asignar el rol correspondiente
							// Otras asignaciones específicas para profesores, si las hay
						} elseif ($usuario_data['estudiante_usuario'] == $usuario && password_verify($clave, $usuario_data['estudiante_clave'])) {
							// Usuario encontrado en la tabla 'estudiantes'
							$_SESSION['id'] = $usuario_data['estudiante_id'];
							$_SESSION['nombre'] = $usuario_data['estudiante_nombre'];
							$_SESSION['apellido'] = $usuario_data['estudiante_apellido'];
							$_SESSION['usuario'] = $usuario_data['estudiante_usuario'];
							$_SESSION['foto'] = $usuario_data['estudiante_foto'];
							$_SESSION['rol'] = 'estudiante'; // Asignar el rol correspondiente
							// Otras asignaciones específicas para estudiantes, si las hay
						} elseif ($usuario_data['acudiente_usuario'] == $usuario && password_verify($clave, $usuario_data['acudiente_clave'])) {
							// Usuario encontrado en la tabla 'acudientes'
							$_SESSION['id'] = $usuario_data['acudiente_id'];
							$_SESSION['nombre'] = $usuario_data['acudiente_nombre'];
							$_SESSION['apellido'] = $usuario_data['acudiente_apellido'];
							$_SESSION['usuario'] = $usuario_data['acudiente_usuario'];
							$_SESSION['foto'] = $usuario_data['acudiente_foto'];
							$_SESSION['rol'] = 'acudiente'; // Asignar el rol correspondiente
							// Otras asignaciones específicas para acudientes, si las hay
						}else {
							// Contraseña incorrecta
							echo "<script>
									Swal.fire({
										icon: 'error',
										title: 'Ocurrió un error inesperado',
										text: 'Contraseña o usuario incorrectos :('
									});
								</script>";
							// Detener la ejecución del código
							exit;
						}
					
						// Redirigir después de iniciar sesión
						if (headers_sent()) {
							echo "<script> window.location.href='".SERVER_URL."src/dashboard/'; </script>";
						} else {
							header("Location: ".SERVER_URL."src/dashboard/");
						}
					}else{
						// Usuario no encontrado en ninguna tabla
						echo "<script>
								Swal.fire({
									icon: 'error',
									title: 'Ocurrió un error inesperado',
									text: 'Usuario no existe, contactacte al administrador X('
								});
							</script>";
					}
					
				}
			}
		}
	}


	/*----------  Controlador cerrar sesion  ----------*/
	public function cerrarSesionControlador()
	{

		session_destroy();

		if (headers_sent()) {
			echo "<script> window.location.href='" . SERVER_URL . "src/login/'; </script>";
		} else {
			header("Location: " . SERVER_URL . "src/login/");
		}
	}
}
