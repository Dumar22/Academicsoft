   <!-- Lista de Usuarios -->
   <div class="container c-welcome d-flex justify-content-center">


<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Administradores del sistema</h3>
  </div>

  <!-- Agregar usuario -->
  <?php require_once "./views/contents/add-user-admin-view.php"; ?>
 
  
  <div class="container">

<div class="form-rest mb-6 mt-6"></div>

<?php
  use controllers\adminController;

  $instUsuario = new adminController();

  echo $instUsuario->listarUsuarioControlador($url[1],15,$url[0],"");
 
  
?>
</div>

