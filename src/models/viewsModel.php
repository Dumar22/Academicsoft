<?php

namespace models;

class viewsModel{
/*------ Obtener Vistas del Modelo -------*/   
protected static function get_views_model($view){    
    $whiteList=["dashboard","list-user-admin","list-guardians", "edit-user-admin", "report", "list-students","list-materias","list-notes","list-notes-user", "list-grades", "list-teachers","edit-student","edit-grade", "edit-guardian","edit-materia", "edit-notes","edit-teacher","logOut","user-profile"];

    if (in_array($view, $whiteList)) {
        if (is_file("./views/contents/".$view."-view.php")) {
             $content="./views/contents/".$view."-view.php";
          
        }else{
            $content="404";
        }
    }elseif($view=="login" || $view=="index"){
      $content="login";
    }else{
        $content="404";
    }
    return $content;
}
}

?>