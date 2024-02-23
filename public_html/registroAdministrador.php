<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
    </header><body>
    
    <div class="container">
<div class="container">
            <h2>Registrar administradores del sistema</h2>
            <h3>Digite los datos personales del administrador</h3>
            <hr />
            <br />

    <table class="formulario" align="center">
        <form action="registroAdministrador.php" method="post" >
            <tr>
                <td>N.identificación: </td>
                <td>Nombres: </td>
             </tr>
            <tr>
                <td><input type="text" name="Identificacion" placeholder="Ingrese el número de identificación" required onkeypress='return event.charCode >= 48 && event.charCode <= 57'></td>
                 <td><input type="search" name="Nombres" placeholder="Ingrese el nombre" required></td>
                 
            </tr>
            <tr>
                <td>Apellidos: </td>
                <td>Dirección: </td>
            </tr>
               <td><input  type="text" name="Apellidos" placeholder="Ingrese el apellido" required></td>
                <td><input type="text" name="Direccion" placeholder="Ingrese la dirección"></td>
            <tr>
             <td>Teléfono: </td>
              <td>Correo electrónico: </td>
            </tr>
                <td><input  type="text" name="Telefono" placeholder="Ingrese el teléfono" required></td>
                <td><input  type="text" name="Correo" placeholder="Ingrese el correo electrónico" required></td>
            <tr>
                <td>Usuario: </td>
                <td>Contraseña:</td>
            </tr>
            <tr>
                <td><input type="text" name="Usuario" placeholder="Ingrese el nombre de usuario"></td>
                <td><input type="password" name="Clave" placeholder="Ingrese su contraseña" required></td>
            </tr> 
              <table align="center">
            <tr>
                <td><input type="submit"  value="REGISTRAR"></td>
                <td><input type="reset" value="LIMPIAR"></td>
            </tr>
            </table>  
        </form>
    </table>
</div>

<?php
//Insertar datos personales del administrador
include 'conexion.php';
if($_POST){
  $Identificacion=(isset($_POST['Identificacion']))? $_POST['Identificacion']:"";
  $Nombres=(isset($_POST['Nombres']))? $_POST['Nombres']:"";
  $Apellidos=(isset($_POST['Apellidos']))? $_POST['Apellidos']:"";
   $Direccion=(isset($_POST['Direccion']))? $_POST['Direccion']:"";
  $Correo=(isset($_POST['Correo']))? $_POST['Correo']:"";
   $Telefono=(isset($_POST['Telefono']))? $_POST['Telefono']:"";
  $Usuario=(isset($_POST['Usuario']))? $_POST['Usuario']:"";
  $Clave=(isset($_POST['Clave']))? $_POST['Clave']:"";
 
  $insertar="INSERT INTO Administrador (Identificacion,Nombres,Apellidos,Direccion,Correo,Telefono,Usuario,Clave) VALUES ($Identificacion,'$Nombres','$Apellidos','$Direccion','$Correo',$Telefono,'$Usuario','$Clave')";
  $resultado=mysqli_query($mysqli , $insertar);
  if(!$resultado){
   //echo 'Error al Registrarse';   
  }
  else{
    echo '
    <script>
    alert ("Usuarios registrado satisfactoriamente");
    window.location = "../registroAdministrador.php";
    </script>
    ';
  }
  mysqli_close($mysqli);
}
?>
</body>
</html>