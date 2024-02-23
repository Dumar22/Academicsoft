<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilo.css">
    <link rel="stylesheet" href="css/estilo.css">
      <link rel="stylesheet" href="css/menu.css">
    <title>Administrador</title>
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
    
   <body>

        <div class="container">
            <h2>Matricular estudiantes</h2>
            <h3>Digite los datos personales del estudiante</h3>
            <hr />
            <br />

            <table class="formulario">
                <form action="registroEstudiante.php" method="post">
                    <tr>
                        <td>N. Identificación:</td>
                        <td>Grado:</td>
                    </tr>
                    <tr>
                        <td> <input type="number" name="Identificacion" placeholder="Digita el número de identificación" required /></td>
                        <?php
                        include 'conexion.php';
                        $consultaGrado="SELECT *FROM Grado";
                        $resultado=mysqli_query($mysqli,$consultaGrado);
                        ?>
                        <td><select name="Id_grad" required><?php
                   foreach ($resultado as $option) { ?>
                                            <option value="<?php echo $option['Id_grado'] ?>"><?php echo $option['Curso'] ?></option>
                                        <?php } 
                   ?>
                </select> </td>
                    </tr>
                    <tr>
                        <td>Nombres:</td>
                        <td>Apellidos:</td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="Nombre" placeholder="Digita Los nombres" required /> </td>
                        <td> <input type="text" name="Apellido" placeholder="Digita los apellidos" required /> </td>
                    </tr>
                    <tr>
                        <td>Correo electrónico</td>
                        <td>Telefono:</td>
                    </tr>
                    <tr>
                        <td> <input type="email" name="Correo" placeholder="Digita el correo" required /> </td>
                        <td> <input type="number" name="Telefono" placeholder="Digita el numero de teléfono" required /> </td>
                    </tr>
                    <tr>
                        <td>Dirección:</td>
                        <td>Acudiente:</td>
                    </tr>
                    <tr>
                        <td> <input type="text" name="Direccion" placeholder="Digita la dirección" required /> </td>
                        <td>   <?php
                        include 'conexion.php';
                        $consultaAcudiente="SELECT Id_acudiente, Nombre, Apellido FROM acudiente";
                        $resultado=mysqli_query($mysqli,$consultaAcudiente);
                        ?>
                        <select name="Id_acudiente" required><?php
                   foreach ($resultado as $option) { ?>
                                            <option value="<?php echo $option['Id_acudiente'] ?>"><?php echo $option['Nombre'].' '.$option['Apellido'] ?></option>
                                        <?php } 
                   ?>
                </select></td>
                    </tr>
                    <tr>
                        <td>Contraseña:</td>
                        <td>Repetir contraseña:</td>
                    </tr>
                    <tr>
                        <td> <input type="password" name="Clave" placeholder="Digita la contraseña" required /> </td>
                        <td> <input type="password" name="Repetir_clave" placeholder="Repite la contraseña" required /> </td>
                    </tr>

                    <table align="center">
                        <tr>

                            <td><input type="submit" value="Matricular"></td>
                            <td><input type="reset" value="Limpiar"></td>

                        </tr>

                </form>
            </table>
        </div>

<?php
//Insertar datos personales del administrador
    include 'conexion.php';
if($_POST){
  $Id_estudiante=(isset($_POST['Identificacion']))? $_POST['Identificacion']:"";
  $Password=(isset($_POST['Clave']))? $_POST['Clave']:"";
  $Nombre=(isset($_POST['Nombre']))? $_POST['Nombre']:"";
  $Apellido=(isset($_POST['Apellido']))? $_POST['Apellido']:"";
  $Direccion=(isset($_POST['Direccion']))? $_POST['Direccion']:"";
  $Correo=(isset($_POST['Correo']))? $_POST['Correo']:"";
  $Telefono=(isset($_POST['Telefono']))? $_POST['Telefono']:"";
  $Id_grado=(isset($_POST['Id_grad']))? $_POST['Id_grad']:"";
 $Id_acudiente=(isset($_POST['Id_acudiente']))? $_POST['Id_acudiente']:"";
 
  $insertar="INSERT INTO estudiante (Id_estudiante,Password,Nombre,Apellido,Direccion,Correo,Telefono,Id_grado,Id_acudiente) VALUES ($Id_estudiante,'$Password','$Nombre','$Apellido','$Direccion','$Correo',$Telefono,$Id_grado,$Id_acudiente)";
  $resultado=mysqli_query($mysqli , $insertar);
  if(!$resultado){
   //echo 'Error al Registrarse';   
  }
  else{
    echo '
    <script>
    alert ("Estudiante registrado satisfactoriamente");
    window.location = "../registroEstudiante.php";
    </script>
    ';
  }
  mysqli_close($mysqli);
}
?>

    </body>

</html>