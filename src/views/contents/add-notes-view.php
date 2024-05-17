<?php

use models\mainModel;

$mainModel = new mainModel();
$estudiantes = $mainModel->getEstudiantes();
$grados = $mainModel->getGrados();
$materias = $mainModel->getMaterias();

?>
<!-- Agregar estudiante -->
<div class="container">
    <button type="button" class="btn btn-primary btn-modal" data-bs-toggle="modal" data-bs-target="#agregarUsuarioModal">
        Agregar Nota
    </button>

    <div class="modal fade mt-5" id="agregarUsuarioModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class=" text-center modal-header">
                    <h5 class="modal-title">Agregar Nuevo Nota</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">



                    <form class="FormularioAjax" action="<?php echo SERVER_URL ?>src/ajax/userNotesAjax.php" method="post" autocomplete="off">
                        <input type="hidden" name="modulo_nota" value="registrar">

                        <div class="form-group">
                            <label for="nota_fecha">Fecha:</label>
                            <input type="date" class="form-control" name="nota_fecha" required>
                        </div>
                        <div class="form-group">
                            <label for="nota_p_academico">Periodo escolar:</label>
                            <select class="form-control" name="nota_p_academico" required>
                                <option value="">Selecciona </option>
                                <option value="primero">Primer periodo</option>
                                <option value="segundo">Segundo periodo</option>
                                <option value="tercero">Tercer periodo</option>
                                <option value="cuarto">Cuarto periodo</option>
                            </select>
                            <div class="form-group">
                                <label for="estudiante_id">Estudiante:</label>
                                <select class="form-control" name="estudiante_id" required>
                                    <option value="">Selecciona un estudiante</option>
                                    <?php foreach ($estudiantes as $estudiante) { ?>
                                        <option value="<?php echo $estudiante['estudiante_id']; ?>">
                                            <?php echo $estudiante['estudiante_nombre'] . " " . $estudiante['estudiante_apellido']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="grado_id">Grado:</label>
                                <select class="form-control" name="grado_id" required>
                                    <option value="">Selecciona un grado</option>
                                    <?php foreach ($grados as $grado) { ?>
                                        <option value="<?php echo $grado['grado_id']; ?>">
                                            <?php echo $grado['grado_nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="materia_id">Materia:</label>
                                <select class="form-control" name="materia_id" required>
                                    <option value="">Selecciona una materia</option>
                                    <?php foreach ($materias as $materia) { ?>
                                        <option value="<?php echo $materia['materia_id']; ?>">
                                            <?php echo $materia['materia_nombre']; ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nota_n1">Nota 1:</label>
                                <input type="number" step="0.01" class="form-control" name="nota_n1" min="0" max="10" required>
                            </div>
                            <div class="form-group">
                                <label for="nota_n2">Nota 2:</label>
                                <input type="number" step="0.01" class="form-control" name="nota_n2" min="0" max="10" required>
                            </div>
                            <div class="form-group">
                                <label for="nota_n3">Nota 3:</label>
                                <input type="number" step="0.01" class="form-control" name="nota_n3" min="0" max="10" required>
                            </div>
                            <button type="reset" class="btn btn-info mt-4">Limpiar</button>
                            <button type="submit" class="btn btn-primary mt-4 mb-4">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>