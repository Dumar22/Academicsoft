<?php
/**
 * Punto de entrada de la aplicación
 */

require_once './config/App.php';
require_once './autoload.php';
require_once '../src/views/inc/Sesion_start.php';


if (isset($_GET['views'])) {
    $url = explode("/",$_GET['views']);    
}else{
    $url = ["login"];
}

?>

<?php
   use controllers\viewsController;
   use controllers\loginController;

   $instLogin = new loginController();
   

   $viewsController = new viewsController();
   $view = $viewsController->get_views_controller($url[0]);
  
  
   if ($view == "login" || $view == "404") {
       require_once "./views/contents/" . $view . "-view.php";
   } 
   ?>
  
