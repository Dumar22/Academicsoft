<?php
	require 'conexion.php';
	
// 	var_dump($_POST['Id_estudiante']);
//     var_dump($_POST['Nombre']);
//     var_dump($_POST['Apellido']);
//     var_dump($_POST['Direccion']);
//     var_dump($_POST['Correo']);
//     var_dump($_POST['Telefono']);
//     var_dump($_POST['Id_grado']);
//     var_dump($_POST['Id_acudiente']);
//     var_dump($_POST['Password']);
	
	$Id_estudiante = $_POST['Id_estudiante'];
    $Nombre = $_POST['Nombre'];
    $Apellido = $_POST['Apellido'];
    $Direccion = $_POST['Direccion'];
    $Correo = $_POST['Correo'];
    $Telefono = $_POST['Telefono'];
    $Id_grado = $_POST['Id_grado'];
    $Id_acudiente = $_POST['Id_acudiente'];
    $Password = $_POST['Password'];
       
    $sql = "UPDATE estudiante SET Nombre='$Nombre', Apellido='$Apellido', Direccion='$Direccion', Correo='$Correo', Telefono='$Telefono', Id_grado=$Id_grado, Id_acudiente=$Id_acudiente, Password='$Password' WHERE Id_estudiante = '$Id_estudiante'";
    
	$resultado = $mysqli->query($sql);

	if ($resultado) {
	    echo "Los datos se han actualizado correctamente.";
	} else {
	    echo "Error al actualizar los datos: " . $mysqli->error;
	}
	
	echo '<script>
     window.location = "../mostrarEstudiante2.php";
    </script>';
?>