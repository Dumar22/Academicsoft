<?php
	namespace models;
	use \PDO, PDOException, Exception;
	

	if(file_exists(__DIR__."/../config/server.php")){
		require_once __DIR__."/../config/server.php";
	}

	const SERVER="roundhouse.proxy.rlwy.net";
	const DB_NAME="railway";
	const DB_USER="root";
	const DB_PASS="nYcaOMxrboReQeXzysXtrTrqpqFnqGAJ";
	const DB_PORT="54913";

	class mainModel{

		private $server=SERVER;
		private $db=DB_NAME;
		private $user=DB_USER;
		private $pass=DB_PASS;
		private $port=DB_PORT;


		/*----------  Funcion conectar a BD  ----------*/
		protected function conect(){
			try {
				$connection = new PDO("mysql:host=" . $this->server . ";port=" . $this->port . ";dbname=" . $this->db, $this->user, $this->pass);
				$connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$connection->exec("SET CHARACTER SET utf8");
				return $connection;
			} catch (PDOException $e) {
				$errorJson = $this->handleConnectionError($e);
				header('Content-Type: application/json');
				echo $errorJson;
				exit;
			}
		}


		protected function handleConnectionError($exception) {
			
			$error = [
				'message' => "Error de conexión a la base de datos: " . $exception->getMessage(),
				'code' => $exception->getCode(),
				'file' => $exception->getFile(),
				'line' => $exception->getLine()
			];
		
			return json_encode($error);
			// lanzar una excepción personalizada si lo necesitas
			throw new Exception("Error de conexión a la base de datos");
		}
		/*----------  Funcion ejecutar consultas  ----------*/
		protected function executeQuery($query){
			try {
				$sql = $this->conect()->prepare($query);
				$sql->execute();
				return $sql;
			} catch (PDOException $e) {
				// Manejar el error de ejecución de la consulta
				$this->handleQueryError($e, $query);
				$error = [
					'message' => "Error al ejecutar la consulta",
					'query' => $query,
					'code' => $e->getCode(),
					'file' => $e->getFile(),
					'line' => $e->getLine()
				];
				echo json_encode(['error' => $error]);
				exit();
			}
		}

		protected function handleQueryError($exception, $query) {
			// Aquí puedes implementar la lógica para manejar el error de ejecución de la consulta
			// Por ejemplo, puedes registrar el error en un archivo de log, mostrar un mensaje de error al usuario, etc.
			error_log("Error al ejecutar la consulta: " . $exception->getMessage());
  		    error_log("Consulta: " . $query);
            error_log("Código de error: " . $exception->getCode());
            error_log("Archivo: " . $exception->getFile());
            error_log("Línea: " . $exception->getLine());
			// Puedes lanzar una excepción personalizada si lo necesitas
			return false;
		}

		/*----------  Funcion limpiar cadenas evitar inyección sql ----------*/
		public function cleanQuery($text){

			$words=["<script>","</script>","<script src","<script type=","SELECT * FROM","SELECT "," SELECT ","DELETE FROM","INSERT INTO","DROP TABLE","DROP DATABASE","TRUNCATE TABLE","SHOW TABLES","SHOW DATABASES","<?php","?>","--","^","<",">","==","=",";","::"];

			$text=trim($text);
			$text=stripslashes($text);

			foreach($words as $word){
				$text=str_ireplace($word, "", $text);
			}

			$text=trim($text);
			$text=stripslashes($text);

			return $text;
		}


		/*---------- Funcion verificar datos (expresion regular) ----------*/
		protected function verifyData($filter,$text){
			if(preg_match("/^".$filter."$/", $text)){
				return false;
            }else{
                return true;
            }
		}


		/*----------  Funcion para ejecutar una consulta INSERT preparada  ----------*/
		protected function saveData($table, $data){
			try {
				$query = "INSERT INTO $table (";
		
				$C = 0;
				foreach ($data as $key){
					if ($C >= 1) { 
						$query .= ","; 
					}
					$query .= $key["campo_nombre"];
					$C++;
				}
				
				$query .= ") VALUES(";
		
				$C = 0;
				foreach ($data as $key){
					if ($C >= 1) { 
						$query .= ","; 
					}
					$query .= $key["campo_marcador"];
					$C++;
				}
		
				$query .= ")";
				$sql = $this->conect()->prepare($query);
		
				foreach ($data as $key){
					$sql->bindParam($key["campo_marcador"], $key["campo_valor"]);
				}
		
				$sql->execute();
		
				return $sql;
			} catch (PDOException $e) {
				// Manejar el error de ejecución de la consulta
				$error = [
					'message' => "Error al guardar los datos",
					'query' => $query,
					'code' => $e->getCode(),
					'file' => $e->getFile(),
					'line' => $e->getLine()
				];
				echo json_encode(['error' => $error]);
				exit();
			}
		}
		

		/*---------- Funcion seleccionar datos ----------*/
        public function selectedData($type,$table,$camp,$id){
			$type=$this->cleanQuery($type);
			$table=$this->cleanQuery($table);
			$camp=$this->cleanQuery($camp);
			$id=$this->cleanQuery($id);

            if($type=="Unico"){
                $sql=$this->conect()->prepare("SELECT * FROM $table WHERE $camp=:ID");
                $sql->bindParam(":ID",$id);
            }elseif($type=="Normal"){
                $sql=$this->conect()->prepare("SELECT $camp FROM $table");
            }
            $sql->execute();

            return $sql;
		}


		/*----------  Funcion para ejecutar una consulta UPDATE preparada  ----------*/
		protected function updateData($table,$data,$condicion){
			
			$query="UPDATE $table SET ";

			$C=0;
			foreach ($data as $clave){
				if($C>=1){ $query.=","; }
				$query.=$clave["campo_nombre"]."=".$clave["campo_marcador"];
				$C++;
			}

			$query.=" WHERE ".$condicion["condicion_campo"]."=".$condicion["condicion_marcador"];

			$sql=$this->conect()->prepare($query);

			foreach ($data as $clave){
				$sql->bindParam($clave["campo_marcador"],$clave["campo_valor"]);
			}

			$sql->bindParam($condicion["condicion_marcador"],$condicion["condicion_valor"]);

			$sql->execute();

			return $sql;
		}


		/*---------- Funcion eliminar registro ----------*/
        protected function deleteData($table,$camp,$id){
            $sql=$this->conect()->prepare("DELETE FROM $table WHERE $camp=:id");
            $sql->bindParam(":id",$id);
            $sql->execute();
            
            return $sql;
        }


		/*---------- Paginador de tablas ----------*/
		protected function paginadorTablas($pagina,$numeroPaginas,$url,$botones){
	        $tabla='<nav class="pagination is-centered is-rounded" role="navigation" aria-label="pagination">';

	        if($pagina<=1){
	            $tabla.='
	            <a class="pagination-previous is-disabled" disabled >Anterior</a>
	            <ul class="pagination-list">
	            ';
	        }else{
	            $tabla.='
	            <a class="pagination-previous" href="'.$url.($pagina-1).'/">Anterior</a>
	            <ul class="pagination-list">
	                <li><a class="pagination-link" href="'.$url.'1/">1</a></li>
	                <li><span class="pagination-ellipsis">&hellip;</span></li>
	            ';
	        }


	        $ci=0;
	        for($i=$pagina; $i<=$numeroPaginas; $i++){

	            if($ci>=$botones){
	                break;
	            }

	            if($pagina==$i){
	                $tabla.='<li><a class="pagination-link is-current" href="'.$url.$i.'/">'.$i.'</a></li>';
	            }else{
	                $tabla.='<li><a class="pagination-link" href="'.$url.$i.'/">'.$i.'</a></li>';
	            }

	            $ci++;
	        }


	        if($pagina==$numeroPaginas){
	            $tabla.='
	            </ul>
	            <a class="pagination-next is-disabled" disabled >Siguiente</a>
	            ';
	        }else{
	            $tabla.='
	                <li><span class="pagination-ellipsis">&hellip;</span></li>
	                <li><a class="pagination-link" href="'.$url.$numeroPaginas.'/">'.$numeroPaginas.'</a></li>
	            </ul>
	            <a class="pagination-next" href="'.$url.($pagina+1).'/">Siguiente</a>
	            ';
	        }

	        $tabla.='</nav>';
	        return $tabla;
	    }

	protected function paginadorBootstrapp($pagina, $numeroPaginas, $url, $botones) {
		$tabla = '<nav aria-label="Page navigation">';
		$tabla .= '<ul class="pagination justify-content-center">';

		if ($pagina <= 1) {
			$tabla .= '
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Anterior</a>
        </li>
        ';
		} else {
			$tabla .= '
        <li class="page-item">
            <a class="page-link" href="' . $url . ($pagina - 1) . '/">Anterior</a>
        </li>
        ';
		}

		$ci = 0;
		for ($i = $pagina; $i <= $numeroPaginas; $i++) {
			if ($ci >= $botones) {
				break;
			}

			if ($pagina == $i) {
				$tabla .= '
            <li class="page-item active" aria-current="page">
                <a class="page-link" href="' . $url . $i . '/">' . $i . '</a>
            </li>
            ';
			} else {
				$tabla .= '
            <li class="page-item">
                <a class="page-link" href="' . $url . $i . '/">' . $i . '</a>
            </li>
            ';
			}

			$ci++;
		}

		if ($pagina == $numeroPaginas) {
			$tabla .= '
        <li class="page-item disabled">
            <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Siguiente</a>
        </li>
        ';
		} else {
			$tabla .= '
        <li class="page-item">
            <a class="page-link" href="' . $url . ($pagina + 1) . '/">Siguiente</a>
        </li>
        ';
		}

		$tabla .= '</ul>';
		$tabla .= '</nav>';

		return $tabla;
	}

	    
	}

	?>