   <!-- Lista de Usuarios -->
   <div class="c-welcome d-flex justify-content-start">


<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Estudiantes</h3>
  </div>

  <!-- Agregar usuario -->
  <?php require_once "./views/contents/add-student-view.php"; ?>
 
  
  

<?php
  use controllers\studentController;

  $instEstudent = new studentController();

  echo $instEstudent->listarEstudianteControlador($url[1],15,$url[0],"");
 
  
?>
</div>
