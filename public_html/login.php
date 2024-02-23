<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/estilos-login.css">
        <link rel="stylesheet" href="css/estilosBotones.css">
    <script src="https://kit.fontawesome.com/6f60a6f89e.js" crossorigin="anonymous"></script>
    <title>Iniciar sesión</title>
      <style>
      a {color: rgb(252, 252, 253)}
      </style>
      <style>
        <!--
        a{text-decoration:none}
     
        </style>
</head>
<body bgcolor=red>
    <div class="contenedor">  
       <form class="formulario" method="post" action="login.php">
            <h1><img src="imagenes/banner-negro.png" height="80"><br>Iniciar Sesión</h1>
            <div class="input-contenedor">
            <i class="fas fa-user icon"></i>
            <input type="text" placeholder="Nombre de usuario" name="Usuario">
            </div>
            <div class="input-contenedor">
            <i class="fas fa-key icon"></i>
            <input ID="txtPassword" type="password" placeholder="Contraseña" name="Clave">
            </div>
            <table align=center>
                    <tr align=center><td><a class="fcc-btn" href="index.html">Inicio</a></td>
                        <td><input type="submit" value="Ingresar" name ="Ingresar" class="button"></td><td></td>
                    </tr>
                    <tr >
                        <td colspan =3><a href="recuperarCredenciales.html" target="_blank"><font color =black><pre>¿Olvidó su usuario o contraseña?</pre></font></a></td>
                    </tr>
            </table>
            <h1> </h1>
        </form>
    </div> 
<?php
include 'conexion.php';
if($_POST){
$Usuario=$_POST['Usuario'];
$Clave=$_POST['Clave'];
session_start();
$_SESSION['Usuario']=$Usuario;
//Buscar administrador
$consulta="SELECT *FROM Administrador where Usuario='$Usuario' and Clave='$Clave'";
$resultado=mysqli_query($mysqli,$consulta);
$ejecutar=mysqli_fetch_array($resultado);
if($ejecutar['Usuario']==$Usuario && $ejecutar['Clave']==$Clave){ //administrador
echo '
    <script>
     window.location = "../menuAdministrador.php";
    </script>
    ';
}

//Buscar profesor
$consulta2="SELECT *FROM profesor where Id_profesor='$Usuario' and Password='$Clave'";
$resultado2=mysqli_query($mysqli,$consulta2);
$ejecutar2=mysqli_fetch_array($resultado2);
if($ejecutar2['Id_profesor']==$Usuario && $ejecutar2['Password']==$Clave){ 
echo '
    <script>
     window.location = "../menuProfesor.php";
    </script>
    ';
}

//Buscar estudiante
$consulta3="SELECT *FROM estudiante where Id_estudiante='$Usuario' and Password='$Clave'";
$resultado3=mysqli_query($mysqli,$consulta3);
$ejecutar3=mysqli_fetch_array($resultado3);
if($ejecutar3['Id_estudiante']==$Usuario && $ejecutar3['Password']==$Clave){ 
echo '
    <script>
     window.location = "../menuEstudiante.php";
    </script>
    ';
}
else{
    echo '
    <script>
    alert ("usuario no existe , por favor consulte con el administrador");
    window.location = "../login.php";
    </script>
    ';
    exit;
}
mysqli_free_result($resultado);
mysqli_close($conexion);
}
?>       
</body>
</html>