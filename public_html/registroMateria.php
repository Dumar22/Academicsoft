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
          <h2>Registro de materias</h2>
          <h3>Digite la materia y su intensidad horaria</h3>
          <hr />
          <br />
        </header>
        <table class="formulario" align="center">
           <form action="registroMateria.php" method="post" >
              <tr>
                <td>Materia:</td>
                <td>Intensidad horaria: </td>
              </tr>
              <tr>
                <td><input type="text" name="Materia" placeholder="Ingrese el nombre de la materia" required></td>
                <td><input type="text" name="Intensidad_horaria" placeholder="Ingrese las horas"></td>
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
  $Materia=(isset($_POST['Materia']))? $_POST['Materia']:"";
  $Intensidad_horaria=(isset($_POST['Intensidad_horaria']))? $_POST['Intensidad_horaria']:"";
 
  $insertar="INSERT INTO Materia (Materia,Intensidad_horaria) VALUES ('$Materia','$Intensidad_horaria')";
  $resultado=mysqli_query($mysqli , $insertar);
  if(!$resultado){
   //echo 'Error al Registrarse';   
  }
  else{
    echo '
    <script>
    alert ("Materia registrada exitosamente");
    window.location = "../registroMateria.php";
    </script>
    ';
  }
  mysqli_close($mysqli);
}
?>
   </body>
</html>