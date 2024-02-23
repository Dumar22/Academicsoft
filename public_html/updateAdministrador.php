<?php
	
	require 'conexion.php';

		$Identificacion = $_POST['Identificacion'];
        $Nombres = $_POST['Nombres'];
        $Apellidos = $_POST['Apellidos'];
        $Direccion = $_POST['Direccion'];
        $Correo = $_POST['Correo'];
        $Telefono= $_POST['Telefono'];
        $Usuario= $_POST['Usuario'];
        $Clave=(isset($_POST['Clave']))? $_POST['Clave']:"";
       
	$sql = "UPDATE Administrador SET Identificacion =$Identificacion, Nombres='$Nombres', Apellidos='$Apellidos', Direccion='$Direccion', Correo='$Correo', Telefono=$Telefono, Usuario='$Usuario', Clave='$Clave' WHERE Identificacion = '$Identificacion'";
	$resultado = $mysqli->query($sql);
	
	 echo '<script>
     window.location = "../mostrarAdministrador2.php";
    </script>';
    
?>