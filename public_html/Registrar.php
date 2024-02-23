<?php


include 'conexion.php';
if($_POST){
  print_r($_POST);
  $Identificacion=(isset($_POST['Identificacion']))? $_POST['Identificacion']:"";
  $Nombres=(isset($_POST['Nombres']))? $_POST['Nombres']:"";
  $Apellidos=(isset($_POST['Apellidos']))? $_POST['Apellidos']:"";
  
  echo "Holaaaaaaaaaaaaa";
  echo $Identificacion;
  echo $Nombres;
  echo $Apellidos;
  
  $insertar="INSERT INTO Administrador (Identificacion,Nombres,Apellidos) VALUES ($Identificacion,'$Nombres','$Apellidos')";
  $resultado=mysqli_query($mysqli , $insertar);
  if(!$resultado){
   echo 'Error al Registrarse';   
  }
  else{
    
    Header("Location: mostrar.php");
  }

  mysqli_close($mysqli);
  
}
?>