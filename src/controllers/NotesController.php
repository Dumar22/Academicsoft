<?php

   namespace controllers; 
	use models\mainModel;

	class notesController extends mainModel{

		/*----------  Controlador registrar usuario  ----------*/
		public function registrarNotaControlador(){

			# Almacenando datos#
		    $fecha=$this->cleanQuery($_POST['nota_fecha']);
		    $p_escolar=$this->cleanQuery($_POST['nota_p_academico']);
		    $estudiante=$this->cleanQuery($_POST['estudiante_id']);
		    $grado=$this->cleanQuery($_POST['grado_id']);
		    $materia=$this->cleanQuery($_POST['materia_id']);
		    $n1=$this->cleanQuery($_POST['nota_n1']);
		    $n2=$this->cleanQuery($_POST['nota_n2']);
		    $n3=$this->cleanQuery($_POST['nota_n3']);

		    


		    # Verificando campos obligatorios #
		    if($fecha=="" || $estudiante=="" || $grado=="" || $materia=="" || $n1=="" || $n2=="" || $n3==""){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return  json_encode($alerta);
		        exit();
		    }

			if( $n1<0 || $n2<0 || $n3<0){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"las notas no pueden ser Menor que 0 ",
					"icono"=>"error"
				];
				return  json_encode($alerta);
		        exit();
		    }
		    
		    $notas_datos_reg=[
			
				[
					"campo_nombre"=>"nota_fecha",
					"campo_marcador"=>":Fecha",
					"campo_valor"=>$fecha
				],
				[
					"campo_nombre"=>"nota_p_academico",
					"campo_marcador"=>":Periodo",
					"campo_valor"=>$p_escolar
				],
				[
					"campo_nombre"=>"estudiante_id",
					"campo_marcador"=>":Estudiante",
					"campo_valor"=>$estudiante
                ],
				[
					"campo_nombre"=>"grado_id",
					"campo_marcador"=>":Grado",
					"campo_valor"=>$grado
                ],
				[
					"campo_nombre"=>"materia_id",
					"campo_marcador"=>":Materia",
					"campo_valor"=>$materia
                ],
				[
					"campo_nombre"=>"nota_n1",
					"campo_marcador"=>":Nota1",
					"campo_valor"=>$n1
                ],
				[
					"campo_nombre"=>"nota_n2",
					"campo_marcador"=>":Nota2",
					"campo_valor"=>$n2
                ],
				[
					"campo_nombre"=>"nota_n3",
					"campo_marcador"=>":Nota3",
					"campo_valor"=>$n3
                ],
                ];

				
			$registrar_materia=$this->saveData("notas",$notas_datos_reg);

			if($registrar_materia->rowCount()==1){
				$alerta=[
					"tipo"=>"limpiar",
					"titulo"=>"Nota registrada",
					"texto"=>"Las notas se registraron con exito",
					"icono"=>"success"
				];
				return json_encode($alerta);
		                exit();
			}else{
								
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No se pudo registrar la nota, por favor intente nuevamente",
					"icono"=>"error"
				];
				return json_encode($alerta);
		                exit();
			}

			

		}

		/*----------  Controlador listar usuario  ----------*/
		public function listarNotaControlador($pagina, $registros, $url, $busqueda)
{
    $pagina = $this->cleanQuery($pagina);
    $registros = $this->cleanQuery($registros);
    $url = $this->cleanQuery($url);
    $url = SERVER_URL . "src/" . $url . "/";
    $busqueda = $this->cleanQuery($busqueda);

    $tabla = "";

    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

    if (isset($busqueda) && $busqueda != "") {
        $consulta_datos = "SELECT notas.*, 
            estudiantes.estudiante_nombre, 
            estudiantes.estudiante_apellido, 
            grados.grado_nombre, 
            materias.materia_nombre 
            FROM notas
            LEFT JOIN estudiantes ON notas.estudiante_id = estudiantes.estudiante_id
            LEFT JOIN grados ON notas.grado_id = grados.grado_id
            LEFT JOIN materias ON notas.materia_id = materias.materia_id
            WHERE (notas.estudiante_id!='" . $_SESSION['id'] . "' AND notas.estudiante_id!='0') 
            AND (estudiantes.estudiante_nombre LIKE '%$busqueda%' OR estudiantes.estudiante_apellido LIKE '%$busqueda%' 
            OR materias.materia_nombre LIKE '%$busqueda%' OR grados.grado_nombre LIKE '%$busqueda%')
            ORDER BY notas.nota_fecha DESC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(notas.nota_id) 
            FROM notas
            LEFT JOIN estudiantes ON notas.estudiante_id = estudiantes.estudiante_id
            LEFT JOIN grados ON notas.grado_id = grados.grado_id
            LEFT JOIN materias ON notas.materia_id = materias.materia_id
            WHERE (notas.estudiante_id!='" . $_SESSION['id'] . "' AND notas.estudiante_id!='0')
            AND (estudiantes.estudiante_nombre LIKE '%$busqueda%' OR estudiantes.estudiante_apellido LIKE '%$busqueda%' 
            OR materias.materia_nombre LIKE '%$busqueda%' OR grados.grado_nombre LIKE '%$busqueda%')";
    } else {
        $consulta_datos = "SELECT notas.*, 
            estudiantes.estudiante_nombre, 
            estudiantes.estudiante_apellido, 
            grados.grado_nombre, 
            materias.materia_nombre 
            FROM notas
            LEFT JOIN estudiantes ON notas.estudiante_id = estudiantes.estudiante_id
            LEFT JOIN grados ON notas.grado_id = grados.grado_id
            LEFT JOIN materias ON notas.materia_id = materias.materia_id
            WHERE notas.estudiante_id!='" . $_SESSION['id'] . "' AND notas.estudiante_id!='0' 
            ORDER BY notas.nota_fecha DESC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(nota_id) 
            FROM notas
            WHERE notas.estudiante_id!='" . $_SESSION['id'] . "' AND notas.estudiante_id!='0'";
    }

    $datos = $this->executeQuery($consulta_datos);
    $datos = $datos->fetchAll();

    $total = $this->executeQuery($consulta_total);
    $total = (int) $total->fetchColumn();

    $numeroPaginas = ceil($total / $registros);

    $tabla .= '
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th class="col text-center">Fecha</th>
                        <th class="col text-center">Estudiante</th>
                        <th class="col text-center">Grado</th>
                        <th class="col text-center">Materia</th>
                        <th class="col text-center">Nota 1</th>
                        <th class="col text-center">Nota 2</th>
                        <th class="col text-center">Nota 3</th>
                        <th class="col text-center">Promedio</th>
                        <th class="col text-center">Editar</th>
                        <th class="col text-center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
        ';

    if ($total >= 1 && $pagina <= $numeroPaginas) {
        $contador = $inicio + 1;
        $pag_inicio = $inicio + 1;
        foreach ($datos as $rows) {
            $promedio = ($rows['nota_n1'] + $rows['nota_n2'] + $rows['nota_n3']) / 3;
            $tabla .= '
                    <tr class="has-text-centered">
                        <td class="text-nowrap">' . date("d-m-Y", strtotime($rows['nota_fecha'])) . '</td>
                        <td class="text-nowrap">' . $rows['estudiante_nombre'] . ' ' . $rows['estudiante_apellido'] . '</td>
                        <td class="text-nowrap">' . $rows['grado_nombre'] . '</td>
                        <td class="text-nowrap">' . $rows['materia_nombre'] . '</td>
                        <td class="text-nowrap">' . $rows['nota_n1'] . '</td>
                        <td class="text-nowrap">' . $rows['nota_n2'] . '</td>
                        <td class="text-nowrap">' . $rows['nota_n3'] . '</td>
                        <td class="text-nowrap">' . number_format($promedio, 2) . '</td>
                        <td>
                            <a href="' . SERVER_URL . 'src/edit-notes/' . $rows['nota_id'] . '/" class="btn btn-warning">Actualizar</a>
                        </td>
                        <td>
                            <form class="FormularioAjax" action="' . SERVER_URL . 'src/ajax/userNotesAjax.php" method="POST" autocomplete="off">
                                <input type="hidden" name="modulo_nota" value="eliminar">
                                <input type="hidden" name="nota_id" value="' . $rows['nota_id'] . '">
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                ';
            $contador++;
        }
        $pag_final = $contador - 1;
    } else {
        if ($total >= 1) {
            $tabla .= '
                    <tr class="has-text-centered">
                        <td colspan="10">
                            <a href="' . $url . '1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
        } else {
            $tabla .= '
                    <tr class="has-text-centered">
                        <td colspan="10">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
        }
    }

    $tabla .= '</tbody></table></div>';

    if ($total > 0 && $pagina <= $numeroPaginas) {
        $tabla .= '<p class="has-text-right">Mostrando notas <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
        $tabla .= $this->paginadorBootstrapp($pagina, $numeroPaginas, $url, 7);
    }

    return $tabla;
}


public function listarNotaUsuarioControlador($pagina, $registros, $url, $busqueda)
{
    $pagina = $this->cleanQuery($pagina);
    $registros = $this->cleanQuery($registros);
    $url = $this->cleanQuery($url);
    $url = SERVER_URL . "src/" . $url . "/";
    $busqueda = $this->cleanQuery($busqueda);

    $tabla = "";

    $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
    $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

    // Obtener el ID del estudiante logueado
    $estudiante_id = $_SESSION['id'];

    if (isset($busqueda) && $busqueda != "") {
        $consulta_datos = "SELECT notas.*, 
            estudiantes.estudiante_nombre, 
            estudiantes.estudiante_apellido, 
            grados.grado_nombre, 
            materias.materia_nombre 
            FROM notas
            LEFT JOIN estudiantes ON notas.estudiante_id = estudiantes.estudiante_id
            LEFT JOIN grados ON notas.grado_id = grados.grado_id
            LEFT JOIN materias ON notas.materia_id = materias.materia_id
            WHERE notas.estudiante_id='$estudiante_id' 
            AND (estudiantes.estudiante_nombre LIKE '%$busqueda%' OR estudiantes.estudiante_apellido LIKE '%$busqueda%' 
            OR materias.materia_nombre LIKE '%$busqueda%' OR grados.grado_nombre LIKE '%$busqueda%')
            ORDER BY notas.nota_fecha DESC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(notas.nota_id) 
            FROM notas
            LEFT JOIN estudiantes ON notas.estudiante_id = estudiantes.estudiante_id
            LEFT JOIN grados ON notas.grado_id = grados.grado_id
            LEFT JOIN materias ON notas.materia_id = materias.materia_id
            WHERE notas.estudiante_id='$estudiante_id'
            AND (estudiantes.estudiante_nombre LIKE '%$busqueda%' OR estudiantes.estudiante_apellido LIKE '%$busqueda%' 
            OR materias.materia_nombre LIKE '%$busqueda%' OR grados.grado_nombre LIKE '%$busqueda%')";
    } else {
        $consulta_datos = "SELECT notas.*, 
            estudiantes.estudiante_nombre, 
            estudiantes.estudiante_apellido, 
            grados.grado_nombre, 
            materias.materia_nombre 
            FROM notas
            LEFT JOIN estudiantes ON notas.estudiante_id = estudiantes.estudiante_id
            LEFT JOIN grados ON notas.grado_id = grados.grado_id
            LEFT JOIN materias ON notas.materia_id = materias.materia_id
            WHERE notas.estudiante_id='$estudiante_id' 
            ORDER BY notas.nota_fecha DESC LIMIT $inicio, $registros";

        $consulta_total = "SELECT COUNT(nota_id) 
            FROM notas
            WHERE notas.estudiante_id='$estudiante_id'";
    }

    $datos = $this->executeQuery($consulta_datos);
    $datos = $datos->fetchAll();

    $total = $this->executeQuery($consulta_total);
    $total = (int) $total->fetchColumn();

    $numeroPaginas = ceil($total / $registros);

    $tabla .= '
        <div class="table-responsive">
            <table class="table table-bordered table-hover">
                <thead>
                    <tr class="table-primary">
                        <th class="col text-center">Fecha</th>
                        <th class="col text-center">Estudiante</th>
                        <th class="col text-center">Grado</th>
                        <th class="col text-center">Materia</th>
                        <th class="col text-center">Nota 1</th>
                        <th class="col text-center">Nota 2</th>
                        <th class="col text-center">Nota 3</th>
                        <th class="col text-center">Promedio</th>
                    </tr>
                </thead>
                <tbody>
        ';

    if ($total >= 1 && $pagina <= $numeroPaginas) {
        $contador = $inicio + 1;
        $pag_inicio = $inicio + 1;
        foreach ($datos as $rows) {
            $promedio = ($rows['nota_n1'] + $rows['nota_n2'] + $rows['nota_n3']) / 3;
            $tabla .= '
                    <tr class="has-text-centered">
                        <td class="text-nowrap">' . date("d-m-Y", strtotime($rows['nota_fecha'])) . '</td>
                        <td class="text-nowrap">' . $rows['estudiante_nombre'] . ' ' . $rows['estudiante_apellido'] . '</td>
                        <td class="text-nowrap">' . $rows['grado_nombre'] . '</td>
                        <td class="text-nowrap">' . $rows['materia_nombre'] . '</td>
                        <td class="text-nowrap">' . $rows['nota_n1'] . '</td>
                        <td class="text-nowrap">' . $rows['nota_n2'] . '</td>
                        <td class="text-nowrap">' . $rows['nota_n3'] . '</td>
                        <td class="text-nowrap">' . number_format($promedio, 2) . '</td>
                    </tr>
                ';
            $contador++;
        }
        $pag_final = $contador - 1;
    } else {
        if ($total >= 1) {
            $tabla .= '
                    <tr class="has-text-centered">
                        <td colspan="8">
                            <a href="' . $url . '1/" class="button is-link is-rounded is-small mt-4 mb-4">
                                Haga clic acá para recargar el listado
                            </a>
                        </td>
                    </tr>
                ';
        } else {
            $tabla .= '
                    <tr class="has-text-centered">
                        <td colspan="8">
                            No hay registros en el sistema
                        </td>
                    </tr>
                ';
        }
    }

    $tabla .= '</tbody></table></div>';

    if ($total > 0 && $pagina <= $numeroPaginas) {
        $tabla .= '<p class="has-text-right">Mostrando notas <strong>' . $pag_inicio . '</strong> al <strong>' . $pag_final . '</strong> de un <strong>total de ' . $total . '</strong></p>';
        $tabla .= $this->paginadorBootstrapp($pagina, $numeroPaginas, $url, 7);
    }

    return $tabla;
}



		/*----------  Controlador eliminar usuario  ----------*/
		public function eliminarNotaControlador() {
			$id = $this->cleanQuery($_POST['nota_id']);
		
			// Verificar si existe el nota
			$datos = $this->executeQuery(" SELECT * FROM notas WHERE nota_id = $id ");
			
			if ($datos->rowCount() <= 0) {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No hemos encontrado la nota en el sistema",
					"icono" => "error"
				];
				return json_encode($alerta);
			}
			$datos = $datos->fetch();
		
			// Intentar eliminar el nota
			$eliminarNota = $this->deleteData("notas", "nota_id", $id);
		
			// Procesar el resultado de la eliminación
			if ($eliminarNota->rowCount() >= 1) {
				// Eliminar la foto del materia, si existe
				
		
				$alerta = [
					"tipo" => "recargar",
					"titulo" => "Nota eliminada",
					"texto" => "La materia ha sido eliminada del sistema correctamente",
					"icono" => "success"
				];
			} else {
				$alerta = [
					"tipo" => "simple",
					"titulo" => "Ocurrió un error inesperado",
					"texto" => "No hemos podido eliminar la nota del sistema, por favor intente nuevamente",
					"icono" => "error"
				];
			}
		
			return json_encode($alerta);
		}

		
		/*----------  Controlador actualizar usuario  ----------*/
		public function actualizarNotaControlador(){

			$id=$this->cleanQuery($_POST['nota_id']);

			# Verificando nota #
		    $datos=$this->executeQuery("SELECT * FROM notas WHERE nota_id='$id'");
		    if($datos->rowCount()<=0){
		        $alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos encontrado la nota en el sistema",
					"icono"=>"error"
				];
				return json_encode($alerta);
		        exit();
		    }else{
		    	$datos=$datos->fetch();
		    }

		   

			# Almacenando datos#
		  
		    $estudiante=$this->cleanQuery($_POST['estudiante_id']);
		    $grado=$this->cleanQuery($_POST['grado_id']);
		    $materia=$this->cleanQuery($_POST['materia_id']);
		    $n1=$this->cleanQuery($_POST['nota_n1']);
		    $n2=$this->cleanQuery($_POST['nota_n2']);
		    $n3=$this->cleanQuery($_POST['nota_n3']);
		    
		    # Verificando campos obligatorios #
		     # Verificando campos obligatorios #
			 if($estudiante=="" || $grado=="" || $materia=="" || $n1=="" || $n2=="" || $n3==""){
		    	$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No has llenado todos los campos que son obligatorios",
					"icono"=>"error"
				];
				return  json_encode($alerta);
		        exit();
		    }

		    
		    

			$notas_datos_reg=[
				[
					"campo_nombre"=>"estudiante_id",
					"campo_marcador"=>":Estudiante",
					"campo_valor"=>$estudiante
                ],
				[
					"campo_nombre"=>"grado_id",
					"campo_marcador"=>":Grado",
					"campo_valor"=>$grado
                ],
				[
					"campo_nombre"=>"materia_id",
					"campo_marcador"=>":Materia",
					"campo_valor"=>$materia
                ],
				[
					"campo_nombre"=>"nota_n1",
					"campo_marcador"=>":Nota1",
					"campo_valor"=>$n1
                ],
				[
					"campo_nombre"=>"nota_n2",
					"campo_marcador"=>":Nota2",
					"campo_valor"=>$n2
                ],
				[
					"campo_nombre"=>"nota_n3",
					"campo_marcador"=>":Nota3",
					"campo_valor"=>$n3
                ],
                ];

				
			

			$condicion=[
				"condicion_campo"=>"nota_id",
				"condicion_marcador"=>":ID",
				"condicion_valor"=>$id
			];

			if($this->updateData("notas",$notas_datos_reg,$condicion)){


				$alerta=[
					"tipo"=>"recargar",
					"titulo"=>"materia actualizada",
					"texto"=>"Los datos de la nota se actualizaron correctamente",
					"icono"=>"success"
				];
			}else{
				$alerta=[
					"tipo"=>"simple",
					"titulo"=>"Ocurrió un error inesperado",
					"texto"=>"No hemos podido actualizar los datos de la nota, por favor intente nuevamente",
					"icono"=>"error"
				];
			}

			return json_encode($alerta);
		}


	

	}

	?>