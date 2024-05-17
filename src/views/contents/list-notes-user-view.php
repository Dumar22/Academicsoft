<div class="c-welcome d-flex justify-content-start">

<div class="container">
  <div class="text-center">
    <h3 class="mt-5">Notas</h3>
  </div>


 
  
  

<?php
  use controllers\notesController;

  $instNotasUser = new notesController();

 // Verificar el rol del usuario y llamar al controlador correspondiente

  echo  $instNotasUser->listarNotaUsuarioControlador($url[1],15,$url[0],"");

 
  
?>
</div>