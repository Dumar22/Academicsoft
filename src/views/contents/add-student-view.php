 <!-- Agregar estudiante -->
 <div class="container">
   <button type="button" class="btn btn-primary btn-modal" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">
     Agregar Estudiante
   </button>

   <div class="modal fade mt-5" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
     <div class="modal-dialog">
       <div class="modal-content">
         <div class=" text-center modal-header">
           <h5 class="modal-title">Agregar Nuevo Estudiante</h5>
           <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
         </div>
         <div class="modal-body">

           <form class="FormularioAjax" action="<?php echo SERVER_URL ?>src/ajax/userStudentAjax.php" method="post" autocomplete="off" enctype="multipart/form-data">

             <input type="hidden" name="modulo_estudiante" value="registrar">

             <div class="form-group">
               <label for="nombre">Identificación:</label>
               <input type="text" class="form-control" name="estudiante_identificacion" pattern="[0-9]{5,20}" maxlength="40">
             </div>
             <div class="form-group">
               <label for="nombre">Nombre:</label>
               <input type="text" class="form-control" name="estudiante_nombre" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
             </div>
             <div class="form-group">
               <label for="apellidos">Apellidos:</label>
               <input type="text" class="form-control" name="estudiante_apellido" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
             </div>
             <div class="form-group">
               <label for="estudiante">Usuario:</label>
               <input type="text" class="form-control" name="estudiante_usuario" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
             </div>
             <div class="form-group">
               <label for="estudiante_rol">Tipo de Usuario:</label>
               <select class="form-control" name="estudiante_rol" required>
                 <option value="">Selecciona un tipo de usuario</option>
                 <option value="administrador">Administrador</option>
                 <option value="estudiante">Estudiante</option>
                 <option value="acudiente">Acudiente</option>
                 <option value="profesor">Profesor</option>
               </select>
             </div>
             <div class="form-group">
               <label for="direccion">Dirección:</label>
               <input type="text" class="form-control" name="estudiante_direccion" pattern="[a-zA-Z0-9]+[a-zA-Z0-9,#\- ]{3,50}" maxlength="50" required>
             </div>
             <div class="form-group">
               <label for="correo">Correo:</label>
               <input type="email" class="form-control" name="estudiante_email" maxlength="70" required>
             </div>
             <div class="form-group">
               <label for="telefono">Teléfono:</label>
               <input type="text" class="form-control" name="estudiante_telefono" pattern="[0-9]{5,20}" maxlength="40" required>
             </div>
             <div class="form-group">
               <label for="telefono">Contraseña:</label>
               <input type="password" class="form-control" name="estudiante_clave_1" pattern="[^\>\<]{7,100}" maxlength="100" required>
             </div>
             <div class="form-group">
               <label for="telefono">Repetir Contraseña:</label>
               <input type="password" class="form-control" name="estudiante_clave_2" pattern="[^\>\<]{7,100}" maxlength="100" required>
             </div>
             <div class="form-group">
               <label for="foto">Foto de perfil:</label>
               <input type="file" class="form-control" name="estudiante_foto" accept="image/jpg, image/jpeg, image/png" >
               <small class="form-text text-danger">Formatos permitidos: JPG, JPEG, PNG. Tamaño máximo: 5MB</small>
             </div>
             <button type="reset" class="btn btn-info mt-4">Limpiar</button>
             <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar</button>
           </form>
         </div>
       </div>
     </div>
   </div>
 </div>
 <!-- fin Agregar estudiante -->