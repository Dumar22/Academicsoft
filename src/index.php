<?php
/**
 * Punto de entrada de la aplicación
 */

require_once './config/App.php';
require_once './autoload.php';
require_once './views/inc/Sesion_start.php';


if (isset($_GET['views'])) {
    $url = explode("/",$_GET['views']);    
}else{
    $url = ["login"];
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
	<?php require_once "./views/inc/Head.php"; ?>
</head>
<body>
    
<?php
   use controllers\viewsController;
   use controllers\loginController;

   $instLogin = new loginController();
   

   $viewsController = new viewsController();
   $view = $viewsController->get_views_controller($url[0]);
  
  
   if ($view == "login" || $view == "404") {
       require_once "./views/contents/" . $view . "-view.php";
   } else {

     # Proteje rutas si quiere ingresar por url #
     # Cierra sesión #
     if((!isset($_SESSION['id']) || $_SESSION['id']=="") || (!isset($_SESSION['usuario']) || $_SESSION['usuario']=="")){
        $instLogin->cerrarSesionControlador();
        exit();
      }

    require_once "./views/inc/Navbar.php";
    require_once "./views/inc/Container-info-user.php";    
       require_once $view;
       
   }


require_once "./views/inc/Script.php";

?>
</body>
</html>

