<?php
	
	require 'conexion.php';
	
	    $Id_profesor = $_POST['Id_profesor'];
        $Nombres = $_POST['Nombres'];
        $Apellidos = $_POST['Apellidos'];
        $Password = $_POST['Password'];
        $Correo = $_POST['Correo'];
        $Telefono = $_POST['Telefono'];
       
       
	$sql = "UPDATE profesor SET Id_profesor=$Id_profesor, Nombres='$Nombres', Apellidos='$Apellidos', Password='$Password', Correo='$Correo', Telefono=$Telefono WHERE Id_profesor =$Id_profesor";
	$resultado = $mysqli->query($sql);
	

	 echo '<script>
     window.location = "../mostrarProfesor2.php";
    </script>';
    
?>