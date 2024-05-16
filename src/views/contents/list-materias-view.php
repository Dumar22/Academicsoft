   <!-- Lista de Materia -->
   <div class="c-welcome d-flex justify-content-start">


<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Materias</h3>
  </div>

  <!-- Agregar materia -->
  <?php require_once "./views/contents/add-materia-view.php"; ?>
 
  
  

<?php
  use controllers\materiasController;

  $instGuardian = new materiasController();

  echo $instGuardian->listarMateriaControlador($url[1],15,$url[0],"");
 
  
?>
</div>
