     <!-- Lista de Estudiantes -->
     <div class="container c-welcome d-flex justify-content-center">


<div class="container">
  <div class="text-center">
    <h3 class="mt-5 mb-5">ESTUDIANTES</h3>
  </div>

    <!-- Agregar estudiante -->
    <?php require_once "./views/contents/add-estudent-view.php"; ?>
 
 <div class="table-responsive">
  <table id="tablaUsuarios" class="table table-bordered table-hover">
    <thead>
      <tr class="table-primary">
        <th class="col">Identificación</th>
        <th class="col">Nombres</th>
        <th class="col">Apellidos</th>
        <th class="col">Dirección</th>
        <th class="col">Correo</th>
        <th class="col">Teléfono</th>
        <th class="col">Grado</th>
        <th class="col">Acudiente</th>
        <th class="col">Usuario</th>
        <th class="col">Editar</th>
        <th class="col">Eliminar</th>
        
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Identificación1</td>
        <td>Nombre1</td>
        <td>Apellidos1</td>
        <td>Dirección1</td>
        <td>Correo1</td>
        <td>Teléfono1</td>
        <td>Grado1</td>
        <td>Acudiente1</td>
        <td>Usuario1</td>
        <td><button class="btn btn-primary"><i class="bi bi-pencil"></i></button></td>
         <td><button class="btn btn-danger"><i class="bi bi-trash"></i> </button></td>

      </tr>
      <!-- Agrega más filas según sea necesario -->
    </tbody>
  </table>
 </div>
    
   
  <nav aria-label="Page navigation example">
    <ul class="pagination justify-content-center">
      <li class="page-item disabled">
        <a class="page-link">Previous</a>
      </li>
      <li class="page-item"><a class="page-link" href="#">1</a></li>
      <li class="page-item"><a class="page-link" href="#">2</a></li>
      <li class="page-item"><a class="page-link" href="#">3</a></li>
      <li class="page-item">
        <a class="page-link" href="#">Next</a>
      </li>
    </ul>
  </nav>
</div>
</div>    
</div>