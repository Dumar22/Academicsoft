<!-- Editar usuario -->
<?php
use models\mainModel;

$mainModel = new mainModel();
$acudientes = $mainModel->getAcudientes();
$grados = $mainModel->getGrados();

?>


<div class="container c-welcome d-flex justify-content-center">
    <div class="container mb-4">
        <div class="text-center">
            <?php

            $id = $instLogin->cleanQuery($url[1]);

            if ($id == $_SESSION['id']) {
            ?>
                <h3 class="mt-2 text-uppercase">Editar mi cuenta</h3>
            <?php } else { ?>
            <?php } ?>
            <h3 class="mt-2 text-uppercase">Editar datos estudiante</h3>


        </div>

        <?php

        include "./views/inc/btn_back.php";

        $datos = $instLogin->selectedData("Unico", "estudiantes", "estudiante_id", $id);
       
        if ($datos->rowCount() == 1) {
            $datos = $datos->fetch();
        ?>
            <form class="FormularioAjax" action="<?php echo SERVER_URL ?>src/ajax/userStudentAjax.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="modulo_estudiante" value="actualizar">
                <input type="hidden" name="estudiante_id" value="<?php echo $datos['estudiante_id']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Identificación:</label>
                            <input type="text" class="form-control" name="estudiante_identificacion" value="<?php echo $datos['estudiante_identificacion']; ?>" pattern="[0-9]{5,20}" maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="estudiante_nombre" value="<?php echo $datos['estudiante_nombre']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" name="estudiante_apellido" value="<?php echo $datos['estudiante_apellido']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                        </div>
                        <div class="form-group">
                            <label for="estudiante">Usuario:</label>
                            <input type="text" class="form-control" name="estudiante_usuario" value="<?php echo $datos['estudiante_usuario']; ?>" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                        </div>
                        <div class="form-group">
                            <label for="grado_id">Grado:</label>
                            <select class="form-control" name="grado_id" required>
                                <option value="">Selecciona un grado</option>
                                <?php foreach ($grados as $grado) { ?>
                                    <option value="<?php echo $grado['grado_id']; ?>" <?php if ($datos['grado_id'] == $grado['grado_id']) echo 'selected'; ?>>
                                        <?php echo $grado['grado_nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estudiante_rol">Tipo de Usuario:</label>
                            <select class="form-control" name="estudiante_rol" required>
                                <option value="">Selecciona un tipo de usuario</option>
                                <option value="administrador" <?php if ($datos['estudiante_rol'] == 'administrador') echo 'selected'; ?>>Administrador</option>
                                <option value="estudiante" <?php if ($datos['estudiante_rol'] == 'estudiante') echo 'selected'; ?>>Estudiante</option>
                                <option value="acudiente" <?php if ($datos['estudiante_rol'] == 'acudiente') echo 'selected'; ?>>Acudiente</option>
                                <option value="profesor" <?php if ($datos['estudiante_rol'] == 'profesor') echo 'selected'; ?>>Profesor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" name="estudiante_direccion" value="<?php echo $datos['estudiante_direccion']; ?>" pattern="[a-zA-Z0-9]+[a-zA-Z0-9,#\- ]{3,50}" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" name="estudiante_email" value="<?php echo $datos['estudiante_email']; ?>" maxlength="70" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" name="estudiante_telefono" value="<?php echo $datos['estudiante_telefono']; ?>" pattern="[0-9]{5,20}" maxlength="40" required>
                        </div>
                        <div class="form-group">
                            <label for="acudiente_id">Acudiente:</label>
                            <select class="form-control" name="acudiente_id" required>
                                <option value="">Selecciona un acudiente</option>
                                <?php foreach ($acudientes as $acudiente) { ?>
                                    <option value="<?php echo $acudiente['acudiente_id']; ?>" <?php if ($datos['acudiente_id'] == $acudiente['acudiente_id']) echo 'selected'; ?>>
                                        <?php echo $acudiente['acudiente_nombre'] . ' ' . $acudiente['acudiente_apellido']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        
                    </div>
                </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center flex-wrap mb-1">
                    <div class="col-sm-10 col-md-6 col-lg-4 m-4">
                        <button type="reset" class="btn btn-info btn-block mt-1 mr-2">Limpiar</button>
                    </div>
                    <div class="col-sm-10 col-md-6 col-lg-4 m-4">
                        <button type="submit" class="btn btn-primary btn-block mt-1">Guardar</button>
                    </div>
                </div>
            </form>
        <?php
        } else {
            include "./views/inc/error_alert.php";
        }
        ?>
    </div>
</div>


<!-- fin Editar usuario -->