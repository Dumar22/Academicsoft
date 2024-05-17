<?php
use models\mainModel;

$mainModel = new mainModel();
$estudiantes = $mainModel->getEstudiantes();
$grados = $mainModel->getGrados();
$materias = $mainModel->getMaterias();

?>

<div class="container c-welcome d-flex justify-content-center">
    <div class="container mb-4">
        <div class="text-center">
            <h3 class="mt-2 text-uppercase">Editar Nota</h3>
        </div>

        <?php

        include "./views/inc/btn_back.php";

        $id = $instLogin->cleanQuery($url[1]);

        $datos = $instLogin->selectedData("Unico", "notas", "nota_id", $id);
       
        if ($datos->rowCount() == 1) {
            $datos = $datos->fetch();
        ?>
            <form class="FormularioAjax" action="<?php echo SERVER_URL ?>src/ajax/userNotesAjax.php" method="post" autocomplete="off">
                <input type="hidden" name="modulo_nota" value="actualizar">
                <input type="hidden" name="nota_id" value="<?php echo $datos['nota_id']; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="estudiante_id">Estudiante:</label>
                            <select class="form-control" name="estudiante_id" required>
                                <option value="">Selecciona un estudiante</option>
                                <?php foreach ($estudiantes as $estudiante) { ?>
                                    <option value="<?php echo $estudiante['estudiante_id']; ?>" <?php if ($datos['estudiante_id'] == $estudiante['estudiante_id']) echo 'selected'; ?>>
                                        <?php echo $estudiante['estudiante_nombre'] . ' ' . $estudiante['estudiante_apellido']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="materia_id">Materia:</label>
                            <select class="form-control" name="materia_id" required>
                                <option value="">Selecciona una materia</option>
                                <?php foreach ($materias as $materia) { ?>
                                    <option value="<?php echo $materia['materia_id']; ?>" <?php if ($datos['materia_id'] == $materia['materia_id']) echo 'selected'; ?>>
                                        <?php echo $materia['materia_nombre']; ?>
                                    </option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="grado_id">Grado:</label>
                            <select class="form-control" name="grado_id" required>
                                <option value="">Selecciona una materia</option>
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
                            <label for="nota">Nota1:</label>
                            <input type="number" step="0.01" class="form-control" name="nota_n1" value="<?php echo $datos['nota_n1']; ?>" min="0" max="10" required>
                        </div>
                        <div class="form-group">
                            <label for="nota">Nota2:</label>
                            <input type="number" step="0.01" class="form-control" name="nota_n2" value="<?php echo $datos['nota_n2']; ?>" min="0" max="10" required>
                        </div>
                        <div class="form-group">
                            <label for="nota">Nota3:</label>
                            <input type="number" step="0.01" class="form-control" name="nota_n3" value="<?php echo $datos['nota_n3']; ?>" min="0" max="10" required>
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
