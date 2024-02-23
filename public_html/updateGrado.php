<?php
	
	require 'conexion.php';

		$Id_grado = $_POST['id'];
        $Curso = $_POST['Curso'];
        
	$sql = "UPDATE Grado SET Id_grado= $Id_grado, Curso='$Curso' WHERE Id_grado= '$Id_grado'";
	$resultado = $mysqli->query($sql);
	
	 echo '<script>
      window.location = "../mostrarGrado2.php";
    </script>';
    
?>