<?php

   namespace controllers; 
	use models\mainModel;

	class guardianController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarAcudienteControlador(){

			# Almacenando datos#
		    $identificacion=$this->cleanQuery($_POST['acudiente_identificacion']);
		    $nombre=$this->cleanQuery($_POST['acudiente_nombre']);
		    $apellido=$this->cleanQuery($_POST['acudiente_apellido']);

		    $usuario=$this->cleanQuery($_POST['acudiente_usuario']);
		    $rol=$this->cleanQuery($_POST['acudiente_rol']);
		    $direccion=$this->cleanQuery($_POST['acudiente_direccion']);
		    $email=$this->cleanQuery($_POST['acudiente_email']);
		    $telefono=$this->cleanQuery($_POST['acudiente_telefono']);
		    $clave1=$this->cleanQuery($_POST['acudiente_clave_1']);
		    $clave2=$this->cleanQuery($_POST['acudiente_clave_2']);


		    # Verificando campos obligatorios #
		    if($identificacion=="" || $nombre=="" || $apellido=="" || $usuario=="" || $rol=="" || $direccion=="" || $telefono=="" || $clave1=="" || $clave2==""){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return  json_encode($alerta);
		        exit();
		    }

		    # Verificando integridad de los datos #
		    if($this->verifyData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El NOMBRE no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verifyData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El APELLIDO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verifyData("[a-zA-Z0-9]{4,20}",$usuario)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El USUARIO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verifyData("[a-zA-Z0-9$@.-]{7,100}",$clave1) ){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Las CLAVES no coinciden con el formato solicitado , Ejemplo de contraseña válida: Abc123$@", 
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

			# Verificando email #
		    if($email!=""){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->executeQuery(" SELECT acudiente_email FROM acudientes WHERE acudiente_email='$email' ");
					if($check_email->rowCount()>0){
						$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
							"icono"=>"error"
						];
						return json_encode($alerta);
						exit();
					}
				}else{
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Ha ingresado un correo electrónico no valido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
            }
			

            # Verificando claves #
            if($clave1 != $clave2){
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"Las contraseñas que acaba de ingresar no coinciden, por favor verifique e intente nuevamente",
					"icono"=>"error"
				];
				return json_encode($alerta);
				exit();
			}else{
				$clave = password_hash($clave1,PASSWORD_BCRYPT,["cost"=>10]);
            }

            # Verificando usuario #
		    $check_usuario=$this->executeQuery("SELECT acudiente_usuario FROM acudientes WHERE acudiente_usuario='$usuario'");
		    if($check_usuario->rowCount()>0){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El USUARIO ingresado ya se encuentra registrado, por favor elija otro",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    # Directorio de imagenes #
    		$img_dir="../views/fotos/";

    		# Comprobar si se selecciono una imagen #
    		if($_FILES['acudiente_foto']['name']!="" && $_FILES['acudiente_foto']['size']>0){

    			# Creando directorio #
		        if(!file_exists($img_dir)){
		            if(!mkdir($img_dir,0777)){
		            	$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"Error al crear el directorio",
							"icono"=>"error"
						];
						return json_encode($alerta);
		                exit();
		            } 
		        }

		        # Verificando formato de imagenes #
		        if(mime_content_type($_FILES['acudiente_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['acudiente_foto']['tmp_name'])!="image/png"){
		        	$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"La imagen que ha seleccionado es de un formato no permitido",
						"icono"=>"error"
					];
					return json_encode($alerta);
		            exit();
		        }

		        # Verificando peso de imagen #
		        if(($_FILES['acudiente_foto']['size']/1024)>5120){
		        	$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"La imagen que ha seleccionado supera el peso permitido",
						"icono"=>"error"
					];
					return json_encode($alerta);
		            exit();
		        }

		        # Nombre de la foto #
		        $foto=str_ireplace(" ","_",$nombre);
		        $foto=$foto."_".rand(0,100);

		        # Extension de la imagen #
		        switch(mime_content_type($_FILES['acudiente_foto']['tmp_name'])){
		            case 'image/jpeg':
		                $foto=$foto.".jpg";
		            break;
		            case 'image/png':
		                $foto=$foto.".png";
		            break;
		        }

		        chmod($img_dir,0777);

		        # Moviendo imagen al directorio #
		        // if(!move_uploaded_file($_FILES['usuario_foto']['tmp_name'],$img_dir.$foto)){
		        // 	$alerta=[
				// 		"tipo"=>"simple",
				// 		"titulo"=>"Ocurrió un error inesperado",
				// 		"texto"=>"No podemos subir la imagen al sistema en este momento",
				// 		"icono"=>"error"
				// 	];
				// 	return json_encode($alerta);
		        //     exit();
		        // }

    		}else{
    			$foto="";
    		}


		    $acudiente_datos_reg=[
				[
					"campo_nombre"=>"acudiente_identificacion",
					"campo_marcador"=>":Identificacion",
					"campo_valor"=>$identificacion
				],
				[
					"campo_nombre"=>"acudiente_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"acudiente_apellido",
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
				],
				[
					"campo_nombre"=>"acudiente_usuario",
					"campo_marcador"=>":Usuario",
					"campo_valor"=>$usuario
				],
				[
					"campo_nombre"=>"acudiente_rol",
					"campo_marcador"=>":Rol",
					"campo_valor"=>$rol
				],
				[
					"campo_nombre"=>"acudiente_direccion",
					"campo_marcador"=>":Direccion",
					"campo_valor"=>$direccion
				],
				[
					"campo_nombre"=>"acudiente_email",
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				],
				[
					"campo_nombre"=>"acudiente_telefono",
					"campo_marcador"=>":Telefono",
					"campo_valor"=>$telefono
				],
				[
					"campo_nombre"=>"acudiente_clave",
					"campo_marcador"=>":Clave",
					"campo_valor"=>$clave
				],
				[
					"campo_nombre"=>"acudiente_foto",
					"campo_marcador"=>":Foto",
					"campo_valor"=>$foto
				],
				[
					"campo_nombre"=>"acudiente_creado",
					"campo_marcador"=>":Creado",
					"campo_valor"=>date("Y-m-d H:i:s")
				],
				[
					"campo_nombre"=>"acudiente_actualizado",
					"campo_marcador"=>":Actualizado",
					"campo_valor"=>date("Y-m-d H:i:s")
				]
			];

			$registrar_acudiente=$this->saveData("acudientes",$acudiente_datos_reg);

			if($registrar_acudiente->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Acudiente registrado",
					"texto"=>"El acudiente ".$nombre." ".$apellido." se registro con exito",
					"icono"=>"success"
				];
				return json_encode($alerta);
		                exit();
			}else{
				
				if(is_file($img_dir.$foto)){
		            chmod($img_dir.$foto,0777);
		            unlink($img_dir.$foto);
		        }

				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar el acudiente, por favor intente nuevamente",
					"icono"=>"error"
				];
				return json_encode($alerta);
		                exit();
			}

			

		}



		/*----------  Controlador listar usuario  ----------*/
		public function listarAcudienteControlador($pagina,$registros,$url,$busqueda){

			$pagina=$this->cleanQuery($pagina);
			$registros=$this->cleanQuery($registros);

			$url=$this->cleanQuery($url);
			$url=SERVER_URL."src/".$url."/";
		    
			$busqueda=$this->cleanQuery($busqueda);
			
			$tabla="";
			
			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;

			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta_datos="SELECT * FROM acudientes WHERE ((acudiente_id!='".$_SESSION['id']."' AND acudiente_id!='0') AND (acudiente_nombre LIKE '%$busqueda%' OR acudiente_apellido LIKE '%$busqueda%' OR acudiente_email LIKE '%$busqueda%' OR acudiente_usuario LIKE '%$busqueda%')) ORDER BY acudiente_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(acudiente_id) FROM acudientes WHERE ((acudiente_id!='".$_SESSION['id']."' AND acudiente_id!='0') AND (acudiente_nombre LIKE '%$busqueda%' OR acudiente_apellido LIKE '%$busqueda%' OR acudiente_email LIKE '%$busqueda%' OR acudiente_usuario LIKE '%$busqueda%'))";

			}else{

				$consulta_datos="SELECT * FROM acudientes WHERE acudiente_id!='".$_SESSION['id']."' AND acudiente_id!='0' ORDER BY acudiente_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(acudiente_id) FROM acudientes WHERE acudiente_id!='".$_SESSION['id']."' AND acudiente_id!='0'";

			}

			$datos = $this->executeQuery($consulta_datos);
			
			$datos = $datos->fetchAll();

			
			$total = $this->executeQuery($consulta_total);
			$total = (int) $total->fetchColumn();

			
			$numeroPaginas =ceil($total/$registros);

			$tabla.='
			<div class="table-responsive">
		        <table class="table table-bordered table-hover">
		            <thead>
		                <tr class="table-primary">
		                    <th class=" col text-center">Identificación</th>
		                    <th class=" col text-center">Nombre Completo</th>
		                    <th class=" col text-center">Dirección</th>
		                    <th class=" col text-center">Usuario</th>
		                    <th class=" col text-center">Correo</th>
		                    <th class=" col text-center">Teléfono</th>
		                    <th class=" col text-center">Creado</th>
		                    <th class=" col text-center">Actualizado</th>
		                    <th class=" col text-center">Editar</th>
                            <th class=" col text-center">Eliminar</th>
		                </tr>
		            </thead>
		            <tbody>
		    ';

		    if($total>=1 && $pagina<=$numeroPaginas){
				$contador=$inicio+1;
				$pag_inicio=$inicio+1;
				foreach($datos as $rows){
					$tabla.='
						<tr class="has-text-centered" >
						     <!-- <td>'.$contador.'</td> -->
							<td class="text-nowrap">'.$rows['acudiente_identificacion'].'</td>
							<td class="text-nowrap">' . $rows['acudiente_nombre'] . ' ' . $rows['acudiente_apellido'] . '</td>
							<td class="text-nowrap">'.$rows['acudiente_direccion'].'</td>
							<td class="text-nowrap">'.$rows['acudiente_usuario'].'</td>
							<td class="text-nowrap">'.$rows['acudiente_email'].'</td>
							<td class="text-nowrap">'.$rows['acudiente_telefono'].'</td>
							<td class="text-nowrap">'.date("d-m-Y  h:i:s A",strtotime($rows['acudiente_creado'])).'</td>
							<td class="text-nowrap">'.date("d-m-Y  h:i:s A",strtotime($rows['acudiente_actualizado'])).'</td>
							
							<td>					
							
							 <a href="'.SERVER_URL.'src/edit-guardian/'.$rows['acudiente_id'].'/" class="btn btn-warning ">Actualizar</a>
						</td>
			                <td>
			                	<form class="FormularioAjax" action="'.SERVER_URL.'src/ajax/userGuardiansAjax.php" method="POST" autocomplete="off" >

			                		<input type="hidden" name="modulo_acudiente" value="eliminar">
			                		<input type="hidden" name="acudiente_id" value="'.$rows['acudiente_id'].'">

			                    	<button type="submit" class="btn btn-danger">Eliminar</button>
			                    </form>
			                </td>
						</tr>
					';
					$contador++;
				}
				$pag_final=$contador-1;
			}else{
				if($total>=1){
					$tabla.='
						<tr class="has-text-centered" >
			                <td colspan="7">
			                    <a href="'.$url.'1/" class="button is-link is-rounded is-small mt-4 mb-4">
			                        Haga clic acá para recargar el listado
			                    </a>
			                </td>
			            </tr>
					';
				}else{
					$tabla.='
						<tr class="has-text-centered" >
			                <td colspan="7">
			                    No hay registros en el sistema
			                </td>
			            </tr>
					';
				}
			}

			$tabla.='</tbody></table></div>';
			 
			### Paginacion ###
			if($total>0 && $pagina<=$numeroPaginas){
				$tabla.='<p class="has-text-right">Mostrando acudientes <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorBootstrapp($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}


		/*----------  Controlador eliminar usuario  ----------*/
		public function eliminarAcudienteControlador() {
			$id = $this->cleanQuery($_POST['acudiente_id']);
		
			// Verificar si es el acudiente principal
			if ($id == 1) {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No podemos eliminar el acudiente principal del sistema",
					"icono" => "error"
				];
				return json_encode($alerta);
			}
		
			// Verificar si existe el acudiente
			$datos = $this->executeQuery(" SELECT * FROM acudientes WHERE acudiente_id = $id ");
			
			if ($datos->rowCount() <= 0) {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No hemos encontrado el acudiente en el sistema",
					"icono" => "error"
				];
				return json_encode($alerta);
			}
			$datos = $datos->fetch();
		
			// Intentar eliminar el acudiente
			$eliminarAcudiente = $this->deleteData("acudientes", "acudiente_id", $id);
		
			// Procesar el resultado de la eliminación
			if ($eliminarAcudiente->rowCount() >= 1) {
				// Eliminar la foto del acudiente, si existe
				if (is_file("../views/fotos/" . $datos['acudiente_foto'])) {
					chmod("../views/fotos/" . $datos['acudiente_foto'], 0777);
					unlink("../views/fotos/" . $datos['acudiente_foto']);
				}
		
				$alerta = [
					"tipo" => "recargar",
					"titulo" => "acudiente eliminado",
					"texto" => "El acudiente " . $datos['acudiente_nombre'] . " " . $datos['acudiente_apellido'] . " ha sido eliminado del sistema correctamente",
					"icono" => "success"
				];
			} else {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No hemos podido eliminar el acudiente " . $datos['acudiente_nombre'] . " " . $datos['acudiente_apellido'] . " del sistema, por favor intente nuevamente",
					"icono" => "error"
				];
			}
		
			return json_encode($alerta);
		}

		
		/*----------  Controlador actualizar usuario  ----------*/
		public function actualizarAcudienteControlador(){

			$id=$this->cleanQuery($_POST['acudiente_id']);

			# Verificando acudiente #
		    $datos=$this->executeQuery("SELECT * FROM acudientes WHERE acudiente_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el acudiente en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		    // $admin_usuario=$this->cleanQuery($_POST['administrador_usuario']);
		    // $admin_clave=$this->cleanQuery($_POST['administrador_clave']);

		    # Verificando campos obligatorios admin #
		    // if($admin_usuario=="" || $admin_clave==""){
		    //     $alerta=[
			// 		"tipo"=>"simple",
			// 		"titulo"=>"Ocurrió un error inesperado",
			// 		"texto"=>"No ha llenado todos los campos que son obligatorios, que corresponden a su USUARIO y CLAVE",
			// 		"icono"=>"error"
			// 	];
			// 	return json_encode($alerta);
		    //     exit();
		    // }

		    // if($this->verifyData("[a-zA-Z0-9]{4,20}",$admin_usuario)){
		    //     $alerta=[
			// 		"tipo"=>"simple",
			// 		"titulo"=>"Ocurrió un error inesperado",
			// 		"texto"=>"Su USUARIO no coincide con el formato solicitado",
			// 		"icono"=>"error"
			// 	];
			// 	return json_encode($alerta);
		    //     exit();
		    // }

		    // if($this->verifyData("[a-zA-Z0-9$@.-]{7,100}",$admin_clave)){
		    // 	$alerta=[
			// 		"tipo"=>"simple",
			// 		"titulo"=>"Ocurrió un error inesperado",
			// 		"texto"=>"Su CLAVE no coincide con el formato solicitado",
			// 		"icono"=>"error"
			// 	];
			// 	return json_encode($alerta);
		    //     exit();
		    // }

		    # Verificando administrador #
		    // $check_admin=$this->executeQuery("SELECT * FROM usuario WHERE usuario_usuario='$admin_usuario' AND usuario_id='".$_SESSION['id']."'");
		    // if($check_admin->rowCount()==1){

		    // 	$check_admin=$check_admin->fetch();

		    // 	if($check_admin['usuario_usuario']!=$admin_usuario || !password_verify($admin_clave,$check_admin['usuario_clave'])){

		    // 		$alerta=[
			// 			"tipo"=>"simple",
			// 			"titulo"=>"Ocurrió un error inesperado",
			// 			"texto"=>"USUARIO o CLAVE de administrador incorrectos",
			// 			"icono"=>"error"
			// 		];
			// 		return json_encode($alerta);
		    //     	exit();
		    // 	}
		    // }else{
		    //     $alerta=[
			// 		"tipo"=>"simple",
			// 		"titulo"=>"Ocurrió un error inesperado",
			// 		"texto"=>"USUARIO o CLAVE de administrador incorrectos",
			// 		"icono"=>"error"
			// 	];
			// 	return json_encode($alerta);
		    //     exit();
		    // }


			# Almacenando datos#
		    $identificacion=$this->cleanQuery($_POST['acudiente_identificacion']);
		    $nombre=$this->cleanQuery($_POST['acudiente_nombre']);
		    $apellido=$this->cleanQuery($_POST['acudiente_apellido']);

		    $usuario=$this->cleanQuery($_POST['acudiente_usuario']);
		    $rol=$this->cleanQuery($_POST['acudiente_rol']);
		    $direccion=$this->cleanQuery($_POST['acudiente_direccion']);
		    $email=$this->cleanQuery($_POST['acudiente_email']);
		    $telefono=$this->cleanQuery($_POST['acudiente_telefono']);
		    // $clave1=$this->cleanQuery($_POST['acudiente_clave_1']);
		    // $clave2=$this->cleanQuery($_POST['acudiente_clave_2']);

		    # Verificando campos obligatorios #
		    if($nombre=="" || $apellido=="" || $usuario==""){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    # Verificando integridad de los datos #
		    if($this->verifyData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$nombre)){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El NOMBRE no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verifyData("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}",$apellido)){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El APELLIDO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    if($this->verifyData("[a-zA-Z0-9]{4,20}",$usuario)){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"El USUARIO no coincide con el formato solicitado",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    # Verificando email #
		    if($email!="" && $datos['acudiente_email']!=$email){
				if(filter_var($email, FILTER_VALIDATE_EMAIL)){
					$check_email=$this->executeQuery("SELECT acudiente_email FROM acudientes WHERE acudiente_email='$email'");
					if($check_email->rowCount()>0){
						$alerta=[
							"tipo"=>"simple",
							"titulo"=>"Ocurrió un error inesperado",
							"texto"=>"El EMAIL que acaba de ingresar ya se encuentra registrado en el sistema, por favor verifique e intente nuevamente",
							"icono"=>"error"
						];
						return json_encode($alerta);
						exit();
					}
				}else{
					$alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Ha ingresado un correo electrónico no valido",
						"icono"=>"error"
					];
					return json_encode($alerta);
					exit();
				}
            }

            # Verificando claves #
            // if($clave1!="" || $clave2!=""){
            // 	if($this->verifyData("[a-zA-Z0-9$@.-]{7,100}",$clave1) || $this->verifyData("[a-zA-Z0-9$@.-]{7,100}",$clave2)){

			//         $alerta=[
			// 			"tipo"=>"simple",
			// 			"titulo"=>"Ocurrió un error inesperado",
			// 			"texto"=>"Las CLAVES no coinciden con el formato solicitado",
			// 			"icono"=>"error"
			// 		];
			// 		return json_encode($alerta);
			//         exit();
			//     }else{
			//     	if($clave1!=$clave2){

			// 			$alerta=[
			// 				"tipo"=>"simple",
			// 				"titulo"=>"Ocurrió un error inesperado",
			// 				"texto"=>"Las nuevas CLAVES que acaba de ingresar no coinciden, por favor verifique e intente nuevamente",
			// 				"icono"=>"error"
			// 			];
			// 			return json_encode($alerta);
			// 			exit();
			//     	}else{
			//     		$clave=password_hash($clave1,PASSWORD_BCRYPT,["cost"=>10]);
			//     	}
			//     }
			// }else{
			// 	$clave=$datos['usuario_clave'];
            // }

            # Verificando usuario #
            if($datos['acudiente_usuario']!=$usuario){
			    $check_acudiente=$this->executeQuery("SELECT acudiente_usuario FROM estudiates WHERE estudiate_usuario='$usuario'");
			    if($check_acudiente->rowCount()>0){
			        $alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"El USUARIO ingresado ya se encuentra registrado, por favor elija otro",
						"icono"=>"error"
					];
					return json_encode($alerta);
			        exit();
			    }
            }

            $acudiente_datos_up=[
				[
					"campo_nombre"=>"acudiente_identificacion",
					"campo_marcador"=>":Identificacion",
					"campo_valor"=>$identificacion
				],
				[
					"campo_nombre"=>"acudiente_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"acudiente_apellido",
					"campo_marcador"=>":Apellido",
					"campo_valor"=>$apellido
				],
				[
					"campo_nombre"=>"acudiente_usuario",
					"campo_marcador"=>":Usuario",
					"campo_valor"=>$usuario
				],
				[
					"campo_nombre"=>"acudiente_rol",
					"campo_marcador"=>":Rol",
					"campo_valor"=>$rol
				],
				[
					"campo_nombre"=>"acudiente_direccion",
					"campo_marcador"=>":Direccion",
					"campo_valor"=>$direccion
				],
				[
					"campo_nombre"=>"acudiente_email",
					"campo_marcador"=>":Email",
					"campo_valor"=>$email
				],
				[
					"campo_nombre"=>"acudiente_telefono",
					"campo_marcador"=>":Telefono",
					"campo_valor"=>$telefono
				],
				// [
				// 	"campo_nombre"=>"acudiente_clave",
				// 	"campo_marcador"=>":Clave",
				// 	"campo_valor"=>$clave
				// ],
				[
					"campo_nombre"=>"acudiente_actualizado",
					"campo_marcador"=>":Actualizado",
					"campo_valor"=>date("Y-m-d H:i:s")
				]
			];

			$condicion=[
				"condicion_campo"=>"acudiente_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->updateData("acudientes",$acudiente_datos_up,$condicion)){

				if($id==$_SESSION['id']){
					$_SESSION['nombre']=$nombre;
					$_SESSION['apellido']=$apellido;
					$_SESSION['usuario']=$usuario;
				}

				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Acudiente actualizado",
					"texto"=>"Los datos del acudiente ".$datos['acudiente_nombre']." ".$datos['acudiente_apellido']." se actualizaron correctamente",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido actualizar los datos del acudiente ".$datos['acudiente_nombre']." ".$datos['acudiente_apellido'].", por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}


		/*----------  Controlador eliminar foto usuario  ----------*/
		public function eliminarFotoAcudienteControlador(){

			$id=$this->cleanQuery($_POST['usuario_id']);

			# Verificando usuario #
		    $datos=$this->executeQuery("SELECT * FROM usuario WHERE usuario_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el usuario en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		    # Directorio de imagenes #
    		$img_dir="../views/fotos/";

    		chmod($img_dir,0777);

    		if(is_file($img_dir.$datos['usuario_foto'])){

		        chmod($img_dir.$datos['usuario_foto'],0777);

		        if(!unlink($img_dir.$datos['usuario_foto'])){
		            $alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Error al intentar eliminar la foto del usuario, por favor intente nuevamente",
						"icono"=>"error"
					];
					return json_encode($alerta);
		        	exit();
		        }
		    }else{
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado la foto del usuario en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		    $usuario_datos_up=[
				[
					"campo_nombre"=>"usuario_foto",
					"campo_marcador"=>":Foto",
					"campo_valor"=>""
				],
				[
					"campo_nombre"=>"usuario_actualizado",
					"campo_marcador"=>":Actualizado",
					"campo_valor"=>date("Y-m-d H:i:s")
				]
			];

			$condicion=[
				"condicion_campo"=>"usuario_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->updateData("usuario",$usuario_datos_up,$condicion)){

				if($id==$_SESSION['id']){
					$_SESSION['foto']="";
				}

				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Foto eliminada",
					"texto"=>"La foto del usuario ".$datos['usuario_nombre']." ".$datos['usuario_apellido']." se elimino correctamente",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Foto eliminada",
					"texto"=>"No hemos podido actualizar algunos datos del usuario ".$datos['usuario_nombre']." ".$datos['usuario_apellido'].", sin embargo la foto ha sido eliminada correctamente",
					"icono"=>"warning"
				];
			}

			return json_encode($alerta);
		}


		/*----------  Controlador actualizar foto usuario  ----------*/
		public function actualizarFotoAcudienteControlador(){

			$id=$this->cleanQuery($_POST['usuario_id']);

			# Verificando usuario #
		    $datos=$this->executeQuery("SELECT * FROM usuario WHERE usuario_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el usuario en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		    # Directorio de imagenes #
    		$img_dir="../views/fotos/";

    		# Comprobar si se selecciono una imagen #
    		if($_FILES['usuario_foto']['name']=="" && $_FILES['usuario_foto']['size']<=0){
    			$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No ha seleccionado una foto para el usuario",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
    		}

    		# Creando directorio #
	        if(!file_exists($img_dir)){
	            if(!mkdir($img_dir,0777)){
	                $alerta=[
						"tipo"=>"simple",
						"titulo"=>"Ocurrió un error inesperado",
						"texto"=>"Error al crear el directorio",
						"icono"=>"error"
					];
					return json_encode($alerta);
	                exit();
	            } 
	        }

	        # Verificando formato de imagenes #
	        if(mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/jpeg" && mime_content_type($_FILES['usuario_foto']['tmp_name'])!="image/png"){
	            $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"La imagen que ha seleccionado es de un formato no permitido",
					"icono"=>"error"
				];
				return json_encode($alerta);
	            exit();
	        }

	        # Verificando peso de imagen #
	        if(($_FILES['usuario_foto']['size']/1024)>5120){
	            $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"La imagen que ha seleccionado supera el peso permitido",
					"icono"=>"error"
				];
				return json_encode($alerta);
	            exit();
	        }

	        # Nombre de la foto #
	        if($datos['usuario_foto']!=""){
		        $foto=explode(".", $datos['usuario_foto']);
		        $foto=$foto[0];
	        }else{
	        	$foto=str_ireplace(" ","_",$datos['usuario_nombre']);
	        	$foto=$foto."_".rand(0,100);
	        }
	        

	        # Extension de la imagen #
	        switch(mime_content_type($_FILES['usuario_foto']['tmp_name'])){
	            case 'image/jpeg':
	                $foto=$foto.".jpg";
	            break;
	            case 'image/png':
	                $foto=$foto.".png";
	            break;
	        }

	        chmod($img_dir,0777);

	        # Moviendo imagen al directorio #
	        if(!move_uploaded_file($_FILES['usuario_foto']['tmp_name'],$img_dir.$foto)){
	            $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No podemos subir la imagen al sistema en este momento",
					"icono"=>"error"
				];
				return json_encode($alerta);
	            exit();
	        }

	        # Eliminando imagen anterior #
	        if(is_file($img_dir.$datos['usuario_foto']) && $datos['usuario_foto']!=$foto){
		        chmod($img_dir.$datos['usuario_foto'], 0777);
		        unlink($img_dir.$datos['usuario_foto']);
		    }

		    $usuario_datos_up=[
				[
					"campo_nombre"=>"usuario_foto",
					"campo_marcador"=>":Foto",
					"campo_valor"=>$foto
				],
				[
					"campo_nombre"=>"usuario_actualizado",
					"campo_marcador"=>":Actualizado",
					"campo_valor"=>date("Y-m-d H:i:s")
				]
			];

			$condicion=[
				"condicion_campo"=>"usuario_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->updateData("usuario",$usuario_datos_up,$condicion)){

				if($id==$_SESSION['id']){
					$_SESSION['foto']=$foto;
				}

				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Foto actualizada",
					"texto"=>"La foto del usuario ".$datos['usuario_nombre']." ".$datos['usuario_apellido']." se actualizo correctamente",
					"icono"=>"success"
				];
			}else{

				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"Foto actualizada",
					"texto"=>"No hemos podido actualizar algunos datos del usuario ".$datos['usuario_nombre']." ".$datos['usuario_apellido']." , sin embargo la foto ha sido actualizada",
					"icono"=>"warning"
				];
			}

			return json_encode($alerta);
			exit();
		}

	}

	?>