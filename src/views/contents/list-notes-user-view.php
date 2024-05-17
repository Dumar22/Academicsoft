<div class="c-welcome d-flex justify-content-start">
<?php 
$usuario_rol = $_SESSION['rol'];
?>

<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Notas</h3>
  </div>


 
  
  

<?php
  use controllers\notesController;

  $instGuardian = new notesController();

 // Verificar el rol del usuario y llamar al controlador correspondiente

  echo  $instGuardian->listarNotaUsuarioControlador($url[1], 15, $url[0], "");

 
  
?>
</div>