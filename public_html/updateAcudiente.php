<?php
	
	require 'conexion.php';
	
			$Id_acudiente = $_POST['Id_acudiente'];
        $Nombre = $_POST['Nombre'];
        $Apellido = $_POST['Apellido'];
        $Direccion = $_POST['Direccion'];
        $Correo = $_POST['Correo'];
        $Telefono= $_POST['Telefono'];
       
       
	$sql = "UPDATE acudiente SET Id_acudiente=$Id_acudiente, Nombre='$Nombre', Apellido='$Apellido', Direccion='$Direccion', Correo='$Correo', Telefono=$Telefono WHERE Id_acudiente =$Id_acudiente";
	$resultado = $mysqli->query($sql);
	

	 echo '<script>
     window.location = "../mostrarAcudiente2.php";
    </script>';
    
?>