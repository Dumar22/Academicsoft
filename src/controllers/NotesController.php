<?php

   namespace controllers; 
	use models\mainModel;

	class notesController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarNotaControlador(){

			# Almacenando datos#
		    $nombre=$this->cleanQuery($_POST['materia_nombre']);
		    $ih=$this->cleanQuery($_POST['materia_intensidad_horaria']);

		    


		    # Verificando campos obligatorios #
		    if($nombre=="" || $ih==""){
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

		  


		    $materia_datos_reg=[
			
				[
					"campo_nombre"=>"materia_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"materia_intensidad_horaria",
					"campo_marcador"=>":Intensidad horaria",
					"campo_valor"=>$ih
                ]
                ];

			$registrar_materia=$this->saveData("materias",$materia_datos_reg);

			if($registrar_materia->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"materia registrada",
					"texto"=>"La materia ".$nombre." "." se registro con exito",
					"icono"=>"success"
				];
				return json_encode($alerta);
		                exit();
			}else{
								
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar la materia, por favor intente nuevamente",
					"icono"=>"error"
				];
				return json_encode($alerta);
		                exit();
			}

			

		}

		/*----------  Controlador listar usuario  ----------*/
		public function listarNotaControlador($pagina,$registros,$url,$busqueda){

			$pagina=$this->cleanQuery($pagina);
			$registros=$this->cleanQuery($registros);

			$url=$this->cleanQuery($url);
			$url=SERVER_URL."src/".$url."/";
		    
			$busqueda=$this->cleanQuery($busqueda);
			
			$tabla="";
			
			$pagina = (isset($pagina) && $pagina>0) ? (int) $pagina : 1;

			$inicio = ($pagina>0) ? (($pagina * $registros)-$registros) : 0;

			if(isset($busqueda) && $busqueda!=""){
				$consulta_datos="SELECT * FROM materias WHERE ((materia_id!='".$_SESSION['id']."' AND materia_id!='0') AND (materia_nombre LIKE '%$busqueda%')) ORDER BY materia_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(materia_id) FROM materias WHERE ((materia_id!='".$_SESSION['id']."' AND materia_id!='0') AND (materia_nombre LIKE '%$busqueda%'))";

			}else{

				$consulta_datos="SELECT * FROM materias WHERE materia_id!='".$_SESSION['id']."' AND materia_id!='0' ORDER BY materia_nombre ASC LIMIT $inicio,$registros";

				$consulta_total="SELECT COUNT(materia_id) FROM materias WHERE materia_id!='".$_SESSION['id']."' AND materia_id!='0'";

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
                        <th class=" col text-center">Nombre Completo</th>
                        <th class=" col text-center">Intensidad horaria</th>
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
							<td class="text-nowrap">'.$rows['materia_nombre'].'</td>
							<td class="text-nowrap">'.$rows['materia_intensidad_horaria'].'</td>							
							<td>					
							
							 <a href="'.SERVER_URL.'src/edit-materia/'.$rows['materia_id'].'/" class="btn btn-warning ">Actualizar</a>
						</td>
			                <td>
			                	<form class="FormularioAjax" action="'.SERVER_URL.'src/ajax/userMateriasAjax.php" method="POST" autocomplete="off" >

			                		<input type="hidden" name="modulo_materia" value="eliminar">
			                		<input type="hidden" name="materia_id" value="'.$rows['materia_id'].'">

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
				$tabla.='<p class="has-text-right">Mostrando materias <strong>'.$pag_inicio.'</strong> al <strong>'.$pag_final.'</strong> de un <strong>total de '.$total.'</strong></p>';

				$tabla.=$this->paginadorBootstrapp($pagina,$numeroPaginas,$url,7);
			}

			return $tabla;
		}


		/*----------  Controlador eliminar usuario  ----------*/
		public function eliminarNotaControlador() {
			$id = $this->cleanQuery($_POST['materia_id']);
		
			// Verificar si existe el materia
			$datos = $this->executeQuery(" SELECT * FROM materias WHERE materia_id = $id ");
			
			if ($datos->rowCount() <= 0) {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No hemos encontrado la materia en el sistema",
					"icono" => "error"
				];
				return json_encode($alerta);
			}
			$datos = $datos->fetch();
		
			// Intentar eliminar el materia
			$eliminarMateria = $this->deleteData("materias", "materia_id", $id);
		
			// Procesar el resultado de la eliminación
			if ($eliminarMateria->rowCount() >= 1) {
				// Eliminar la foto del materia, si existe
				
		
				$alerta = [
					"tipo" => "recargar",
					"titulo" => "materia eliminada",
					"texto" => "La materia " . $datos['materia_nombre'] . " " . "ha sido eliminado del sistema correctamente",
					"icono" => "success"
				];
			} else {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No hemos podido eliminar la materia " . $datos['materia_nombre'] . " " . "del sistema, por favor intente nuevamente",
					"icono" => "error"
				];
			}
		
			return json_encode($alerta);
		}

		
		/*----------  Controlador actualizar usuario  ----------*/
		public function actualizarNotaControlador(){

			$id=$this->cleanQuery($_POST['materia_id']);

			# Verificando materia #
		    $datos=$this->executeQuery("SELECT * FROM materias WHERE materia_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado la materia en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		   

			# Almacenando datos#
		    $nombre=$this->cleanQuery($_POST['materia_nombre']);
		    $ih=$this->cleanQuery($_POST['materia_intensidad_horaria']);
		    
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

		    

            $materia_datos_up=[
				[
					"campo_nombre"=>"materia_nombre",
					"campo_marcador"=>":Nombre",
					"campo_valor"=>$nombre
				],
				[
					"campo_nombre"=>"materia_intensidad_horaria",
					"campo_marcador"=>":Intensidad",
					"campo_valor"=>$ih
				]				
			];

			$condicion=[
				"condicion_campo"=>"materia_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->updateData("materias",$materia_datos_up,$condicion)){

				if($id==$_SESSION['id']){
					$_SESSION['nombre']=$nombre;
					
				}

				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"materia actualizada",
					"texto"=>"Los datos de materia ".$datos['materia_nombre']." "."se actualizaron correctamente",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido actualizar los datos del materia ".$datos['materia_nombre'].", por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}


	

	}

	?>