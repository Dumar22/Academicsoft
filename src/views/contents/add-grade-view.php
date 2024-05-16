 <!-- Agregar Grado -->
 <div class="container">
   <button type="button" class="btn btn-primary btn-modal" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">
     Agregar Grado
   </button>

   <div class="modal fade mt-5" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class=" text-center modal-header">
           <h5 class="modal-title">Agregar Nueva Grado</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

           <form class="FormularioAjax" action="<?php echo SERVER_URL ?>src/ajax/userGradeAjax.php" method="post" autocomplete="off" enctype="multipart/form-data">

             <input type="hidden" name="modulo_grado" value="registrar">
             <div class="form-group">
               <label for="nombre">Grado:</label>
               <input type="text" class="form-control" name="grado_nombre" maxlength="40" required>
             </div>             
             <button type="reset" class="btn btn-info mt-4">Limpiar</button>
             <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar</button>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- fin Agregar profesor -->