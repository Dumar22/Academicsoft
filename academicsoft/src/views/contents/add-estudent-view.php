 <!-- Agregar Estudiante -->
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
          <form>
            <div class="form-group">
              <label for="nombre">Identificación:</label>
              <input type="text" class="form-control" id="identificacion">
            </div>
            <div class="form-group">
              <label for="nombre">Nombre:</label>
              <input type="text" class="form-control" id="nombre">
            </div>
            <div class="form-group">
              <label for="apellidos">Apellidos:</label>
              <input type="text" class="form-control" id="apellidos">
            </div>
            <div class="form-group">
              <label for="usuario">Usuario:</label>
              <input type="text" class="form-control" id="usuario">
            </div>
            <div class="form-group">
              <label for="direccion">Dirección:</label>
              <input type="text" class="form-control" id="direccion">
            </div>
            <div class="form-group">
              <label for="correo">Correo:</label>
              <input type="email" class="form-control" id="correo">
            </div>
            <div class="form-group">
              <label for="telefono">Teléfono:</label>
              <input type="text" class="form-control" id="telefono">
            </div>
            <div class="form-group">
              <label for="telefono">Contraseña:</label>
              <input type="password" class="form-control" id="password">
            </div>
            <div class="form-group">
              <label for="grado">Grado:</label>
              <div>
                <select class="form-select" aria-label="Default select example" id="grado">
                  <option selected>Grado</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label for="acudiente">Acudiente:</label>
              <div>
                <select class="form-select" aria-label="Default select example" id="acudiente">
                  <option selected>Acudiente</option>
                  <option value="1">One</option>
                  <option value="2">Two</option>
                  <option value="3">Three</option>
                </select>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-4">Guardar</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- fin Agregar estudiante -->