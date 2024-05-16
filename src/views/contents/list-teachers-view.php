   <!-- Lista de Usuarios -->
   <div class="c-welcome d-flex justify-content-start">


<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Profesores</h3>
  </div>

  <!-- Agregar usuario -->
  <?php require_once "./views/contents/add-teacher-view.php"; ?>
 
  
  

<?php
  use controllers\teacherController;

  $instEstudent = new teacherController();

  echo $instEstudent->listarProfesorControlador($url[1],15,$url[0],"");
 
  
?>
</div>
