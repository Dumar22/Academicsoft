<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
     <link rel="stylesheet" href="css/loader.css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <title>Eliminar Acudiente</title>
  </head>
  <body>
   <div class="loader-section" >
     <span class="loader"></span>
  </div>
 </body>
</html>

<?php
    require 'conexion.php';
	$Id_acudiente = $_GET['Id_acudiente'];
	$sql = "DELETE FROM acudiente WHERE Id_acudiente = $Id_acudiente";
	$resultado = $mysqli->query($sql);
	 echo '
    <script>
     window.location = "../mostrarAcudiente.php";
    </script>
    ';?>