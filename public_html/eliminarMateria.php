<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="css/loader.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <title>Eliminar usuarios administradores</title>
  </head>
  <body>
    <div class="loader-section" >
      <span class="loader"></span>
    </div>
  </body>
</html>

<?php
    require 'conexion.php';
	$Id_materia = $_GET['id'];
	$sql = "DELETE FROM Materia WHERE Id_materia = $Id_materia";
	$resultado = $mysqli->query($sql);
	 echo '
    <script>
     window.location = "../mostrarMateria.php";
    </script>
    ';?>
