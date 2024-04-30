<?php

namespace controllers;

use models\viewsModel;

class viewsController extends viewsModel{
 
/*------ Controlador para obtener vistas ------ */
     public function get_views_controller($view){
      // echo $view;
        if ($view!="") {
          $res=$this->get_views_model($view);
        }else{
            $res="login"; 
        }
        return $res;
     }
}

?>