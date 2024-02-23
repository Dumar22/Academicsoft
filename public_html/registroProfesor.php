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
    </header>

<body>
    <div class="container">
    <header>
        <h2>Registro de profesores</h2>
        <h3>Digite los datos personales del profesor</h3>
        <hr />
        <br />
    </header>
    <table class="formulario" align="center">
        <form action= "registroProfesor.php" method="post" >
            <tr>
                <td>N.identificación: </td>
                <td>Teléfono: </td>
            </tr>
            <tr>
                <td><input type="text" name="Id_profesor" placeholder="Ingrese la identificación del profesor" required></td>
                 <td><input type="number" name="Telefono" placeholder="Ingrese el teléfono del profesor"></td>
            </tr>
            <tr>
                <td>Nombres: </td>
                <td>Contraseña: </td>
                
            </tr>
            <td><input type="search" name="Nombres" placeholder="Ingrese los nombres del profesor" required></td>
            <td><input type="password" name="Password" placeholder="Ingrese la contraseña" required></td>
            <tr>
              <td>Apellidos: </td>
              <td>Comprobar contraseña: </td>
            </tr>
                <td><input type="search" name="Apellidos" placeholder="Ingrese los apellidos del profesor" required></td>
                <td><input type="password" name="Password2" placeholder="Repita la contraseña" required></td>
            <tr>
                <td>Correo electrónico: </td>
            </tr>
            <tr>
                <td><input type="text" name="Correo" placeholder="Ingrese el correo del profesor"></td>
            </tr> 
                <table align="center">
            <tr>
                <td><input type="submit" value="REGISTRAR"></td>
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
  $Id_profesor=(isset($_POST['Id_profesor']))? $_POST['Id_profesor']:"";
  $Password=(isset($_POST['Password']))? $_POST['Password']:"";
  $Nombres=(isset($_POST['Nombres']))? $_POST['Nombres']:"";
  $Apellidos=(isset($_POST['Apellidos']))? $_POST['Apellidos']:"";
  $Correo=(isset($_POST['Correo']))? $_POST['Correo']:"";
  $Telefono=(isset($_POST['Telefono']))? $_POST['Telefono']:"";
 
  $insertar="INSERT INTO profesor (Id_profesor,Password,Nombres,Apellidos,Correo,Telefono) VALUES ($Id_profesor,'$Password','$Nombres','$Apellidos','$Correo',$Telefono)";
  $resultado=mysqli_query($mysqli , $insertar);
  if(!$resultado){
   //echo 'Error al Registrarse';   
  }
  else{
    echo '
    <script>
    alert ("Profesor registrado satisfactoriamente");
    window.location = "../registroProfesor.php";
    </script>
    ';
  }
  mysqli_close($mysqli);
}
?>
</body>
</html>