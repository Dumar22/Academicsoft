   <!-- Lista de Materia -->
   <div class="c-welcome d-flex justify-content-start">
<?php 
$usuario_rol = $_SESSION['rol'];
?>

<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Notas</h3>
  </div>

  <!-- Agregar materia -->
  <?php
  
  // Verificar el rol del usuario y llamar al controlador correspondiente
 
    require_once "./views/contents/add-notes-view.php";  

  
  ?>
 
  
  

<?php
  use controllers\notesController;

  $instGuardian = new notesController();

 // Verificar el rol del usuario y llamar al controlador correspondiente

  echo $instGuardian->listarNotaControlador($url[1],15,$url[0],"");

  
?>
</div>