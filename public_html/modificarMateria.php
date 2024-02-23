<?php
	require 'conexion.php';
	 
	$id = $_GET['id'];
	$sql = "SELECT * FROM Materia WHERE Id_materia = '$id'";
	$resultado = $mysqli->query($sql);
	$row = $resultado->fetch_array(MYSQLI_ASSOC);
	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/menu.css">
    <title>Actualizar materia</title>
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
  <body>
    <div class="container">
      <div class="container">
            <h2>Actualizar las materias</h2>
            <h3>Digite los datos de la materia </h3>
            <hr />
            <br />
              <table class="formulario" align="center">
                <form action="updateMateria.php" method="post" >
                  <tr>
                    <td>Materia: </td>
                    <td>Intensidad horaria: </td>
                  </tr>
                  <tr>
                    <input id="id" name="id" type="hidden" value="<?php echo $id;?>" />
                    <td><input value="<?php echo $row['Materia']; ?>" type="text" name="Materia" placeholder="Ingrese el nombre de la materia" required></td>
                    <td><input value="<?php echo $row['Intensidad_horaria']; ?>" type="text" name="Intensidad horaria" placeholder="Ingrese las horas" required></td>
                  </tr>
                  <table align="center">
                    <tr>
                      <td><input type="submit"  value="ACTUALIZAR"></td>
                      <td><input type="reset" value="LIMPIAR"></td>
                    </tr>
                  </table>  
                </form>
              </table>
      </div>
   </body>
</html>