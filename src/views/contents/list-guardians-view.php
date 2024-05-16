   <!-- Lista de Usuarios -->
   <div class="c-welcome d-flex justify-content-start">


<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Acudientes</h3>
  </div>

  <!-- Agregar usuario -->
  <?php require_once "./views/contents/add-guardian-view.php"; ?>
 
  
  

<?php
  use controllers\guardianController;

  $instGuardian = new guardianController();

  echo $instGuardian->listarAcudienteControlador($url[1],15,$url[0],"");
 
  
?>
</div>
