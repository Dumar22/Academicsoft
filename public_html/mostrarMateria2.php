<?php
	require 'conexion.php';
	
	$where = "";
	
	if(!empty($_POST))
	{
		$valor = $_POST['campo'];
		if(!empty($valor)){

			if(is_numeric($valor)){
				$where = "WHERE Id = $valor";

			}else{

				$where = "WHERE Nombre LIKE '%$valor%'";
			}
			
		}else{
			echo 'campo de busqueda vacio';
		}
	}
	$sql = "SELECT * FROM Materia";
	$resultado = $mysqli->query($sql);
	
?>
<html lang="es">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link href="css1/bootstrap.min.css" rel="stylesheet">
		<link href="css1/bootstrap-theme.css" rel="stylesheet">
		<script src="js/jquery-3.1.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>	
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css" crossorigin="anonymous">
        <link rel="stylesheet" href="css/estiloen.css">
        <link rel="stylesheet" href="css/menu.css">
        <title>Eliminar</title>
	</head>
	<body>
	   <header>  
         <nav class="nav">
           <ul class="nav__menu">
             <li class="nav__menu-item"><a>ADMIN</a>
               <ul class="nav__submenu">
                 <li class="nav__submenu-item"> <a href="registroAdministrador.php" style="color:#f9f5f5;">Registrar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarAdministrador2.php" style="color:#f9f5f5;">Actualizar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarAdministrador.php" style="color:#f9f5f5;">Eliminar</a></li>
               </ul>
             </li>
             <li class="nav__menu-item"><a>ESTUDIANTE</a>
               <ul class="nav__submenu">
                 <li class="nav__submenu-item"> <a href="registroEstudiante.php" style="color:#f9f5f5;">Matricular</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarEstudiante2.php" style="color:#f9f5f5;">Actualizar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarEstudiante.php" style="color:#f9f5f5;">Eliminar</a></li>
               </ul>
             </li>
             <li class="nav__menu-item"><a>ACUDIENTE</a>
               <ul class="nav__submenu">
                 <li class="nav__submenu-item"> <a href="registroAcudiente.php" style="color:#f9f5f5;">Registrar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarAcudiente2.php" style="color:#f9f5f5;">Actualizar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarAcudiente.php" style="color:#f9f5f5;">Eliminar</a></li>
               </ul>
             </li>
             <li class="nav__menu-item"><a>PROFESOR</a>
               <ul class="nav__submenu">
                 <li class="nav__submenu-item"> <a href="registroProfesor.php" style="color:#f9f5f5;">Registrar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarProfesor2.php" style="color:#f9f5f5;">Actualizar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarProfesor.php" style="color:#f9f5f5;">Eliminar</a></li>
               </ul>
             </li>
             <li class="nav__menu-item"><a>MATERIA</a>
               <ul class="nav__submenu">
                 <li class="nav__submenu-item"> <a href="registroMateria.php" style="color:#f9f5f5;">Registrar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarMateria2.php" style="color:#f9f5f5;">Actualizar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarMateria.php" style="color:#f9f5f5;">Eliminar</a></li>
               </ul>
             </li>
             <li class="nav__menu-item"><a>GRADO</a>
               <ul class="nav__submenu">
                 <li class="nav__submenu-item"> <a href="registroGrado.php" style="color:#f9f5f5;">Registrar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarGrado2.php" style="color:#f9f5f5;">Actualizar</a></li>
                 <li class="nav__submenu-item"> <a href="mostrarGrado.php" style="color:#f9f5f5;">Eliminar</a></li>
               </ul>
             </li>
             <li class="nav__menu-item"><a>NOTAS</a>
               <ul class="nav__submenu">
                 <li class="nav__submenu-item"> <a href="registrarNotas.html" style="color:#f9f5f5;">Registrar</a></li>
                 <li class="nav__submenu-item"> <a href="eliminarNotas.html" style="color:#f9f5f5;">Eliminar</a></li>
               </ul>
             </li>
             <li class="nav__menu-item"><a>REPORTES</a>
               <ul class="nav__submenu">
                 <li class="nav__submenu-item"> <a href="boletinCalificaciones.html" style="color:#f9f5f5;">Boletín de calificaciones</a></li>
                 <li class="nav__submenu-item"> <a href="informeAcadémico.html" style="color:#f9f5f5;">Informe Académico</a></li>
               </ul>
             </li>
             <li class="nav__menu-item"><a href="index.html" style="color:#f9f5f5;">SALIR</a></li>
           </ul>
         </nav>
       </header>
       <div class="container">
         <br>
         <br>
         <br>
           <div class="row table-responsive">
	         <table class="table table-striped">
			   <thead>
			   	 <tr>
					<th>Id_materia</th>
					<th>Materia</th>
					<th>Intensidad_horaria</th>
					<th>Modificar</th>
				 </tr>
			   </thead>
			   <tbody>
			      <?php while($row = $resultado->fetch_array(MYSQLI_ASSOC)) { ?>
				      <tr>
					    <td><?php echo $row['Id_materia']; ?></td>
						<td><?php echo $row['Materia']; ?></td>
						<td><?php echo $row['Intensidad_horaria']; ?></td>
						<td><a href="modificarMateria.php?id=<?php echo $row['Id_materia']; ?>"><span class="glyphicon glyphicon-pencil"></span></a></td>
					  </tr>
				  <?php } ?>
			   </tbody>
		     </table>
	       </div>
       </div>
   </body>
</html>	