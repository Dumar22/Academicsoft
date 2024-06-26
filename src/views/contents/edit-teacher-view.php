<!-- Editar usuario -->



<div class="container c-welcome d-flex justify-content-center">
    <div class="container">
        <div class="text-center">
            <?php

            $id = $instLogin->cleanQuery($url[1]);

            if ($id == $_SESSION['id']) {
            ?>
                <h3 class="mt-5 text-uppercase">Editar Profesor</h3>
            <?php } else { ?>
            <?php } ?>
            <h3 class="mt-5 text-uppercase">Editar datos Profesor</h3>


        </div>

        <?php

        include "./views/inc/btn_back.php";

        $datos = $instLogin->selectedData("Unico", "profesores", "profesor_id", $id);
       
        if ($datos->rowCount() == 1) {
            $datos = $datos->fetch();
        ?>
            <form class="FormularioAjax" action="<?php echo SERVER_URL ?>src/ajax/userTeacherAjax.php" method="post" autocomplete="off" enctype="multipart/form-data">
                <input type="hidden" name="modulo_profesor" value="actualizar">
                <input type="hidden" name="profesor_id" value="<?php echo $datos['profesor_id']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="nombre">Identificación:</label>
                            <input type="text" class="form-control" name="profesor_identificacion" value="<?php echo $datos['profesor_identificacion']; ?>" pattern="[0-9]{5,20}" maxlength="40">
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="text" class="form-control" name="profesor_nombre" value="<?php echo $datos['profesor_nombre']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos:</label>
                            <input type="text" class="form-control" name="profesor_apellido" value="<?php echo $datos['profesor_apellido']; ?>" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{3,40}" maxlength="40" required>
                        </div>
                        <div class="form-group">
                            <label for="profesor">Usuario:</label>
                            <input type="text" class="form-control" name="profesor_usuario" value="<?php echo $datos['profesor_usuario']; ?>" pattern="[a-zA-Z0-9]{4,20}" maxlength="20" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="profesor_rol">Tipo de Usuario:</label>
                            <select class="form-control" name="profesor_rol" required>
                                <option value="">Selecciona un tipo de usuario</option>
                                <option value="administrador" <?php if ($datos['profesor_rol'] == 'administrador') echo 'selected'; ?>>Administrador</option>
                                <option value="estudiante" <?php if ($datos['profesor_rol'] == 'estudiante') echo 'selected'; ?>>Estudiante</option>
                                <option value="acudiente" <?php if ($datos['profesor_rol'] == 'acudiente') echo 'selected'; ?>>Acudiente</option>
                                <option value="profesor" <?php if ($datos['profesor_rol'] == 'profesor') echo 'selected'; ?>>Profesor</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="direccion">Dirección:</label>
                            <input type="text" class="form-control" name="profesor_direccion" value="<?php echo $datos['profesor_direccion']; ?>" pattern="[a-zA-Z0-9]+[a-zA-Z0-9,#\- ]{3,50}" maxlength="50" required>
                        </div>
                        <div class="form-group">
                            <label for="correo">Correo:</label>
                            <input type="email" class="form-control" name="profesor_email" value="<?php echo $datos['profesor_email']; ?>" maxlength="70" required>
                        </div>
                        <div class="form-group">
                            <label for="telefono">Teléfono:</label>
                            <input type="text" class="form-control" name="profesor_telefono" value="<?php echo $datos['profesor_telefono']; ?>" pattern="[0-9]{5,20}" maxlength="40" required>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-center flex-wrap mb-4">
                    <div class="col-sm-10 col-md-6 col-lg-4 m-4">
                        <button type="reset" class="btn btn-info btn-block mt-4 mr-2">Limpiar</button>
                    </div>
                    <div class="col-sm-10 col-md-6 col-lg-4 m-4">
                        <button type="submit" class="btn btn-primary btn-block mt-4">Guardar</button>
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