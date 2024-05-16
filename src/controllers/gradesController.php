<?php

   namespace controllers; 
	use models\mainModel;

	class gradesController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarGradoControlador(){

			# Almacenando datos#
		    $nombre=$this->cleanQuery($_POST['grado_nombre']);  

		    # Verificando campos obligatorios #
		    if($nombre==""){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return  json_encode($alerta);
		        exit();
		    }


		    $grado_datos_reg=[
			
				[
					"campo_nombre"=>"grado_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				]
				
                ];

			$registrar_grado=$this->saveData("grados",$grado_datos_reg);

			if($registrar_grado->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"grado registrada",
					"texto"=>"El grado ".$nombre." "." se registro con exito",
					"icono"=>"success"
				];
				return json_encode($alerta);
		                exit();
			}else{
								
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar el grado, por favor intente nuevamente",
					"icono"=>"error"
				];
				return json_encode($alerta);
		                exit();
			}

			

		}

		/*----------  Controlador listar usuario  ----------*/
		public function listarGradoControlador($pagina,$registros,$url,$busqueda){

			$pagina=$this->cleanQuery($pagina);
			$registros=$this->cleanQuery($registros);

			$url=$this->cleanQuery($url);
			$url=SERVER_URL."src/".$url."/";
		    
			$busqueda=$this->cleanQuery($busqueda);
			
			$tabla="";
			
			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;

			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta_datos="SELECT * FROM grados WHERE ((grado_id!='".$_SESSION['id']."' AND grado_id!='0') AND (grado_nombre LIKE '%$busqueda%')) ORDER BY grado_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(grado_id) FROM grados WHERE ((grado_id!='".$_SESSION['id']."' AND grado_id!='0') AND (grado_nombre LIKE '%$busqueda%'))";

			}else{

				$consulta_datos="SELECT * FROM grados WHERE grado_id!='".$_SESSION['id']."' AND grado_id!='0' ORDER BY grado_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(grado_id) FROM grados WHERE grado_id!='".$_SESSION['id']."' AND grado_id!='0'";

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
                        <th class=" col text-center">Grado</th>                        
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
							<td class="text-nowrap">'.$rows['grado_nombre'].'</td>
														
							<td>					
							
							 <a href="'.SERVER_URL.'src/edit-grade/'.$rows['grado_id'].'/" class="btn btn-warning ">Actualizar</a>
						</td>
			                <td>
			                	<form class="FormularioAjax" action="'.SERVER_URL.'src/ajax/userGradeAjax.php" method="POST" autocomplete="off" >

			                		<input type="hidden" name="modulo_grado" value="eliminar">
			                		<input type="hidden" name="grado_id" value="'.$rows['grado_id'].'">

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
				$tabla.='<p class="has-text-right">Mostrando grados <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorBootstrapp($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}


		/*----------  Controlador eliminar usuario  ----------*/
		public function eliminarGradoControlador() {
			$id = $this->cleanQuery($_POST['grado_id']);
		
			// Verificar si existe el grado
			$datos = $this->executeQuery(" SELECT * FROM grados WHERE grado_id = $id ");
			
			if ($datos->rowCount() <= 0) {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No hemos encontrado la grado en el sistema",
					"icono" => "error"
				];
				return json_encode($alerta);
			}
			$datos = $datos->fetch();
		
			// Intentar eliminar el grado
			$eliminarGrado = $this->deleteData("grados", "grado_id", $id);
		
			// Procesar el resultado de la eliminación
			if ($eliminarGrado->rowCount() >= 1) {
				// Eliminar la foto del materia, si existe
				
		
				$alerta = [
					"tipo" => "recargar",
					"titulo" => "grado eliminada",
					"texto" => "El grado " . $datos['grado_nombre'] . " " . "ha sido eliminado del sistema correctamente",
					"icono" => "success"
				];
			} else {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No hemos podido eliminar el grado " . $datos['grado_nombre'] . " " . "del sistema, por favor intente nuevamente",
					"icono" => "error"
				];
			}
		
			return json_encode($alerta);
		}

		
		/*----------  Controlador actualizar usuario  ----------*/
		public function actualizarGradoControlador(){

			$id=$this->cleanQuery($_POST['grado_id']);

			# Verificando grado #
		    $datos=$this->executeQuery("SELECT * FROM grados WHERE grado_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado el grado en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		   

			# Almacenando datos#
		    $nombre=$this->cleanQuery($_POST['grado_nombre']);		   
		    
		    # Verificando campos obligatorios #
		    if($nombre=="" ){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }

		   

            $grado_datos_up=[
				[
					"campo_nombre"=>"grado_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				]				
			];

			$condicion=[
				"condicion_campo"=>"grado_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->updateData("grados",$grado_datos_up,$condicion)){

				if($id==$_SESSION['id']){
					$_SESSION['nombre']=$nombre;
					
				}

				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"grado actualizada",
					"texto"=>"Los datos del grado ".$datos['grado_nombre']." "."se actualizaron correctamente",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido actualizar los datos del grado ".$datos['grado_nombre'].", por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}


	

	}

	?>