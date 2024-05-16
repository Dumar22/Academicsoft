   <!-- Lista de Grados-->
   <div class="c-welcome d-flex justify-content-start">


<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Grados</h3>
  </div>

  <!-- Agregar geados -->
  <?php require_once "./views/contents/add-grade-view.php"; ?>
 
  
  

<?php
  use controllers\gradesController;

  $instGuardian = new gradesController();

  echo $instGuardian->listarGradoControlador($url[1],15,$url[0],"");
 
  
?>
</div>
