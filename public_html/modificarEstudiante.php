<?php
	require 'conexion.php';
	 
	$Id_estudiante = $_GET['id'];
	$sql = "SELECT * FROM estudiante WHERE Id_estudiante = $Id_estudiante";
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
    <title>Actualizar administrador</title>
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
    </header><body>
    
    <div class="container">
<div class="container">
            <h2>Actualizar datos de los estudiantes</h2>
            <h3>Digite los datos personales del acudiente</h3>
            <hr />
            <br />

    <table class="formulario" align="center">
        <form action="updateEstudiante.php" method="post" >
            <tr>
                        <td>N. Identificación:</td>
                        <td>Grado:</td>
                    </tr>
                    <tr>
                        <td> <input value="<?php echo $row['Id_estudiante']; ?>" type="number" name="Id_estudiante" placeholder="Ingrese el número de identificación" required onkeypress='return event.charCode >= 48 && event.charCode <= 57' /></td>
                        <?php
                        include 'conexion.php';
                        $consultaGrado="SELECT *FROM Grado";
                        $resultado=mysqli_query($mysqli,$consultaGrado);
                        ?>
                        <td>
                        <select name="Id_grado" required>
        <?php
        foreach ($resultado as $option) {
            if ($option['Id_grado'] == $row['Id_grado']) {
                echo "<option value='" . $option['Id_grado'] . "' selected>" . $option['Curso'] . "</option>";
            } else {
                echo "<option value='" . $option['Id_grado'] . "'>" . $option['Curso'] . "</option>";
            }
        }
        ?>
    </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Nombres:</td>
                        <td>Apellidos:</td>
                    </tr>
                    <tr>
                        <td> <input value="<?php echo $row['Nombre']; ?>" type="text" name="Nombre" placeholder="Digita Los nombres" required /> </td>
                        <td> <input value="<?php echo $row['Apellido']; ?>" type="text" name="Apellido" placeholder="Digita los apellidos" required /> </td>
                    </tr>
                    <tr>
                        <td>Correo electrónico</td>
                        <td>Telefono:</td>
                    </tr>
                    <tr>
                        <td> <input value="<?php echo $row['Correo']; ?>" type="email" name="Correo" placeholder="Digita el correo" required /> </td>
                        <td> <input value="<?php echo $row['Telefono']; ?>" type="number" name="Telefono" placeholder="Digita el numero de teléfono" required /> </td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td>Acudiente:</td>
                    </tr>
                    <tr>
                        <td> <input value="<?php echo $row['Direccion']; ?>" type="text" name="Direccion" placeholder="Digita la dirección" required /> </td>
                        <td>   <?php
                        include 'conexion.php';
                        $consultaAcudiente="SELECT Id_acudiente, Nombre, Apellido FROM acudiente";
                        $resultado=mysqli_query($mysqli,$consultaAcudiente);
                        ?>
                        <select name="Id_acudiente" required>
    <?php
    foreach ($resultado as $option) {
        if ($option['Id_acudiente'] == $row['Id_acudiente']) {
            echo "<option value='" . $option['Id_acudiente'] . "' selected>" . $option['Nombre'] . ' ' . $option['Apellido'] . "</option>";
        } else {
            echo "<option value='" . $option['Id_acudiente'] . "'>" . $option['Nombre'] . ' ' . $option['Apellido'] . "</option>";
        }
    }
    ?>
</select>
                        </td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td>Repetir contraseña:</td>
                    </tr>
                    <tr>
                        <td> <input value="<?php echo $row['Password']; ?>" type="password" name="Password" placeholder="Digita la contraseña" required /> </td>
                        <td> <input value="<?php echo $row['Password']; ?>" type="password" name="Password2" placeholder="Repite la contraseña" required /> </td>
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